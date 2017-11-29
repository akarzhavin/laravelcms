<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Product;
use App\Http\Models\Feature;
use App\Http\Models\FeatureValue;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Facades\Images;

/**
 * Class ProductController.
 *
 * @category AppControllers
 *
 */
class ProductController extends Controller
{

    /**
     * Paginated listing of all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('description', 'prices')->paginate(10);
        return view('admin_them.admin.products', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryTree = Category::tree();
        $placeholder = Images::placeholder(100, 100);
        return view('admin_them.admin.products-add', compact('categoryTree', 'placeholder'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param ProductRequest $request Product Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //Check if exist record in database
        Category::findOrFail($request->category_main);

        $data = $request->filter();

        //Init model
        $product = new Product;

        //Update product model
        $product->fill($data['general'])->save();
        $product->description()->create($data['description']);

        App::instance('product-model', $product);
        App::instance('product-features', $product->features);

        //Save categories
        $this->syncCategories($data);

        //Update features
        $this->updateFeaturesValues($request);

        //Update product images
        $this->deleteImages($request);
        $this->updateImages($request);

        //Update default price
        $prices = $product->prices->where('role_id', null)->first();
        if(!empty($prices)){
            $prices->update($data['prices']['guest']);
        }

        $request->session()->flash('alert-success', 'Product has been added!');
        return redirect('/admin/products/');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param int $id product id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('images', 'featurePivot')->findOrFail($id);

        $images = array();
        foreach($product->images as $key => $image) {
            $images[$key] = $image->toArray();

            $storeImage = Images::where('dir', $image->path)->where('hash_name', $image->hash_name)->first();
            if($storeImage){
                $url = $storeImage->thumbnail(100, 100);
            } else {
                $url = Images::placeholder(100, 100);
            }

            $images[$key]['thumbnail'] = $url;
        }

        $mainCategoryId = $product->categories->where('pivot.link_type','M')->first();
        if(!empty($mainCategoryId)){
            $data['mainCategoryId'] = $mainCategoryId->id;
        } else {
            $data['mainCategoryId'] = 1;
        }

        $data['product'] = $product;
        $data['price'] = $product->prices->where('role_id', null)->first();
        $data['images'] = $images;
        $data['categoryTree'] = Category::tree();
        $data['placeholder'] = Images::placeholder(100, 100);
        $data['productCategories'] = $product->categories->pluck('id')->toArray();
        $data['features'] = $product->features->load('values');

        return view('admin_them.admin.products-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request product request
     * @param int $id product id
     *
     * @return Redirect
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->filter();

        //Init model
        $product = Product::findOrFail($id);

        App::instance('product-model', $product);
        App::instance('product-features', $product->features);

        //Update features
        $this->updateFeaturesValues($request);

        //Update product images
        $this->deleteImages($request);
        $this->updateImages($request);

        //Update product model
        $product->update($data['general']);
        $product->description->update($data['description']);

        //Update default price
        $prices = $product->prices->where('role_id', null)->first();
        if(!empty($prices)){
            $prices->update($data['prices']['guest']);
        }

        //Save categories
        $this->syncCategories($data);

        $request->session()->flash('alert-success', 'Product has been updated!');
        return redirect('admin/products');
    }

    /**
     * Display the specified product.
     *
     * @param int $id page id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified product from storage.
     *
     * @param int $id product id
     *
     * @param Request $request
     * @return Redirect
     */
    public function destroy($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->delete();

        $request->session()->flash('alert-success', 'Product has been deleted!');
        return redirect('admin/products');
    }


    /**
     * Update all acquired images
     * and save uploaded images to server
     *
     * @param ProductRequest $request
     */
    private function updateImages(ProductRequest $request)
    {
        if($request->has('images_main')){
            $main_key = $request->images_main;
        } else {
            $main_key = '0';
        }

        foreach($request->images as $key => $image){

            //Check file download
            if($request->hasFile('images.'. $key .'.file')) {
                $imageId = Images::storage($request->file('images.'. $key .'.file'))->id;
            } elseif(isset($image['id'])) {
                $imageId = $image['id']; //TODO if pass fake id ?!
            } else {
               continue;
            }

            //Check main image key
            if ($main_key == $key) {
                $main = true;
            } else {
                $main = false;
            }

            //Check order
            if (isset($image['order'])) {
                $order = (int) $image['order'];
            } else {
                $order = 0;
            }

            //Write data
            //Get model
            $product = App::make('product-model');
            $product->images()->syncWithoutDetaching([
                $imageId => [
                    'order' => $order,
                    'main' => $main
                ]
            ]);
        }
    }

    /**
     * Delete images
     *
     * @param ProductRequest $request
     * @return bool|null
     * @throws \Exception
     */
    private function deleteImages(ProductRequest $request)
    {
        //Collecting the images ids to list
        $listGetId = array();

        foreach($request->images as $image){
            if(isset($image['id'])){
                $listGetId[] = $image['id'];
            }
        }

        //Delete other id
        $product = App::make('product-model');
        $status = $product->images()->sync($listGetId);
        return $status;
    }

    private function syncCategories($data)
    {
        //Check if exist categories;
        if(isset($data['categories'])){
            $categories = $data['categories'];
        } else {
            $categories = array();
        }

        //Get main category
        $main = (int) $data['category_main'];

        //Validate $categories
        if(!is_array($categories)){
            $categories = array($categories);
        }

        //Add main category
        $categories[] = $main;

        //Filter
        $listCategories = array_filter(array_unique($categories));

        //Get categories
        $categories = Category::whereIn('id', $listCategories)->get();

        //Get subcategories
        $fullListCategories = array();
        foreach($categories as $category){
            $explode = explode('/', $category->id_path);
            $fullListCategories = array_merge($fullListCategories, $explode);
        }
        $fullListCategories = array_filter($fullListCategories);
        $fullListCategories = array_unique($fullListCategories);

        //Sync
        $product = App::make('product-model');
        $product->categories()->sync($fullListCategories);
        $product->categories()->updateExistingPivot($main, ['link_type' => 'M']);
    }

    private function updateFeaturesValues(ProductRequest $request)
    {
        $requestFeatures = collect($request->feature_values);

        $product = App::make('product-model');
        $productFeatures = App::make('product-features');

        $filterValues = array();
        foreach($productFeatures as $feature){
            $requestFeature = $requestFeatures->where('id', $feature->id)->first();
            $values = array();
            if(!empty($requestFeature['value_id'])){
                $values[] = $requestFeature['value_id'];
            } elseif (!empty($requestFeature['values_id'])){
                $values = array_merge($values, $requestFeature['values_id']);
            }

            foreach($values as $value){
                $filterValues[$value] = ['feature_id' => $feature->id];
            }
        }
        $product->featureValues()->sync($filterValues);
    }
}
