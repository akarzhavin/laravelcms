<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Events\ProcessPayment;
use App\Http\Models\Category;
use App\Http\Models\Filter;
use App\Http\Models\Invoice;
use App\Http\Models\InvoiceItem;
use App\Http\Models\Page;
use App\Http\Models\Product;
use App\Http\Traits\TelegramTrait;
use Gloudemans\Shoppingcart\Facades\Cart; // use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Input;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;

use Spatie\Newsletter\NewsletterFacade as Newsletter;
use Validator;
use View;

class ShopController extends Controller
{
//    use TelegramTrait;

    /**
     * Homepage.
     *
     * @return View
     */
    public function home()
    {
        return view('pages/home');
    }

    /**
     * Catalg page.
     *
     * @return View
     */
    public function catalog()
    {
        $products = Product::featured();

        return view('pages/catalog', compact('products'));
    }

    /**
     * Fetch product from product_id.
     *
     * @param string $category product_id
     *
     * @return View
     */
    public function productDetails($category, $productId)
    {
        $category = Category::where('id_path', $category)->with('description')->first();

        if(empty($category)){
            return view('errors.404');
        }

        $product = $category->products()->where('id', $productId)->with('images', 'featureValues.feature')->first();
        if(empty($product)){
            return view('errors.404');
        }


        return view('shop.product', compact('category', 'product'));
    }

    /**
     * Get all products belonging to the category based on category_id.
     *
     * @param string $category category_id
     *
     * @return View
     */
    public function category(Request $request, $category)
    {
        $category = Category::where('id_path', $category)->with('description', 'filters.feature.values')->first();

        if(empty($category)){
            return view('errors.404');
        }

        $featureFilters = $this->decodingFeatureFilters($request);
        $priceFilters = $this->decodingPriceFilters($request);

        /*
         * Get products
         */
        $query = $category->products();

        $this->queryMainProductImage($query);
        $this->queryMainCategory($query);
        $this->queryFeatureFilters($query, $featureFilters);
        $this->queryPriceFilters($query, $priceFilters['min'], $priceFilters['max']);
        $products = $query->paginate(5);

//        ->whereHas('roles', function ($query) { //filter by roles
//            $query->where('role_id', null);
//        })

        $filters = $category->filters;

        return view('shop.products', compact('products', 'category', 'filters'));
    }

    public function filterRedirect(Request $request, $category)
    {
        $parameters = $request->route()->parameters();
        $addition = $request->filter;
        if(is_array($addition)){
            $parameters = array_merge($parameters, $addition);
        }
        return redirect()->route('category', $parameters);
    }


    /**
     * Search utility.
     *
     * @return View
     */
    public function search()
    {
        $rules = [
            'q' => 'required|alpha_dash|min:2',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if (false) {
//            Newsletter::subscribe(Input::get('q'));
            Session::flash('alert-danger', 'Invalid search');
            return redirect('/');
        } else {
            $products = Product::search(Input::get('q'))->get();
            return view('shop/search', compact('products'));
        }
    }

    /*
    * Decoding filter by feature parameters
    */
    private function decodingFeatureFilters($request)
    {
        $arrKeys = array_keys($request->all());
        $filterKeys = preg_grep('/f\_[\d]+/', $arrKeys);
        if(is_array($filterKeys)){ //If exist filter
            $filters = array();
            foreach($filterKeys as $filterKey){ //Cycle by filters
                if(is_array($request->$filterKey)){
                    foreach($request->$filterKey as $value){ //Cycle by filter value
                        $filters[$filterKey][] = $value;
                    }
                }
            }
        } else {
            $filters = null;
        }

        return $filters;
    }

    /*
    * Decoding price filter
    */
    private function decodingPriceFilters($request)
    {
        $prices = array();
        $prices['min'] = $request->has('p_min') ? $request->p_min : null;
        $prices['max'] = $request->has('p_max') ? $request->p_max : null;

        //If min > max validate
        if(
            isset($prices['min']) &&
            isset($prices['max']) &&
            $prices['min'] > $prices['max']
        ) {
            $tmp = $prices['min'];
            $prices['min'] = $prices['max'];
            $prices['max'] = $tmp;
        }

        return $prices;
    }

    private function queryMainProductImage(&$query)
    {
        $query = $query->with([
            'images'=> function($query){
                $query->wherePivot('main', '1'); //get main image
            }]);
    }

    private function queryMainCategory(&$query)
    {
        $query = $query->with([
            'categories' => function($query){
                $query->wherePivot('link_type', 'M'); //for product URL
            }]);
    }

    private function queryFeatureFilters(&$query, $featureFilters)
    {
        if($featureFilters){
            $query =
                $query->whereHas('featureValues', function ($query) use ($featureFilters) { //filter by featureValues
                    foreach($featureFilters as $filter){
                        $query->whereIn('value_id', $filter);
                    }
                });
        }
    }

    private function queryPriceFilters(&$query, $min, $max)
    {
        if($min || $max){
            $query =
                $query->whereHas('prices', function ($query) use ($min, $max) { //filter by featureValues
                   empty($min) ?: $query->where('price', '>=', $min);
                   empty($max) ?: $query->where('price', '<=', $max);
                });
        }
    }
}
