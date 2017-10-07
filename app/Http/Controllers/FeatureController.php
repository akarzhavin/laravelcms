<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeatureRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Category;

use App\Http\Models\Feature as Feature;
use Illuminate\Support\Facades\App;
use App\Http\Models\FeatureValuesCollection;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::paginate(15);
        return view('admin_them.admin.features', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categoryTree'] = Category::tree();
        return view('admin_them.admin.features-add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FeatureRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureRequest $request)
    {
        $data = $request->filter();
        $feature = Feature::create($data['properties']);
        $feature->description()->create($data['description']);
        App::instance('feature-model', $feature);

        //Update Variants
        $this->saveValues($request);

        //Update categories
        $this->syncCategories($data['categories']);

        $request->session()->flash('alert-success', 'Feature has been added!');
        return redirect('admin/feature');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature = Feature::with('categories')->findOrFail($id);
        $feature->load('values');

        $data['feature'] = $feature;
        $data['values'] = $feature->values;
        $data['categoryTree'] = Category::tree();
        $data['productCategories'] = $feature->categories->pluck('id')->toArray();

        return view('admin_them.admin.features-edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FeatureRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureRequest $request, $id)
    {
        $data = $request->filter();

        $feature = Feature::with('categories', 'values')->where('id', $id)->first();

        //Set instance
        App::instance('feature-model', $feature);

        //Update data
        $feature->update($data['properties']);
        $feature->description()->update($data['description']);

        //Update Variants
        $this->deleteValues($request);
        $this->saveValues($request);

        //Update categories
        $this->syncCategories($data['categories']);

        $request->session()->flash('alert-success', 'Feature has been updated!');
        return redirect('admin/feature');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Feature::findOrfail($id)->delete();
        return redirect('admin/feature');
    }

    private function deleteValues(FeatureRequest $request)
    {
        //Collecting the values ids to list
        $listGetId = array();

        foreach($request->values as $value){
            if(isset($value['id'])){
                $listGetId[] = $value['id'];
            }
        }

        //Delete other id
        $model = App::make('feature-model');

        $values = $model->values;
        $existingIds = $values->pluck('id');
        $deletedIds = $existingIds->diff($listGetId);

        $deletedModels = $model->values()->whereIn('id', $deletedIds->toArray());
        foreach($deletedModels->cursor() as $deletedModel){
            $deletedModel->products()->detach();
            $deletedModel->delete();
        }
    }

    private function saveValues(Request $request)
    {
        //assembling new variants
        $listNewVariants = array();
        foreach($request->values as $value){
            if(!isset($value['id']) && !empty($value['value'])){
                $listNewVariants[] = $value;
            }
        }

        //Save
        if(count($listNewVariants)){
            $feature = App::make('feature-model');
            $collection = new FeatureValuesCollection();
            foreach($listNewVariants as $item){
                isset($item['order']) ?: $item['order'] = 0;
                isset($item['description']) ?: $item['description'] = null;
                $collection->addItem($feature->id, $feature->type, $item['value'], $item['order'], $item['description']);
            }
            $collection->save();
        }
    }

    private function syncCategories($categories)
    {
        //Convert to array if string given
        if(is_string($categories)){
            $categories = array($categories);
        }

        //Filter
        $listCategories = array_unique($categories);

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

        $feature = App::make('feature-model');
        $feature->categories()->sync($fullListCategories);
    }
}