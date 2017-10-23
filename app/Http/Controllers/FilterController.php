<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Feature;
use App\Http\Models\Filter;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Filter::withTrashed()->paginate(15);
        return view('admin_them.admin.filters-list', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $features = Feature::all()->pluck('description.title', 'id')->toArray();

        $data['features'] = $features;
        $data['categoryTree'] = Category::tree();

        return view('admin_them.admin.filter-add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilterRequest $request)
    {
        $filter = new Filter;
        $properties = $request->filter('properties');
        $this->validateValue($properties);
        $filter->fill($properties);
        $filter->save();

        if(
            isset($properties['status']) &&
            $properties['status'] == 'D'
        ) {
            $filter->delete();
        }


        $filter->categories()->attach($request->filter('categories'));

        return redirect('admin/filter');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function show(Filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $filter = Filter::with('categories')->findOrFail($id);
        $features = Feature::all()->pluck('description.title', 'id')->toArray();

        $data['filter'] = $filter;
        $data['filterCategories'] = $filter->categories->pluck('id')->toArray();
        $data['features'] = $features;
        $data['categoryTree'] = Category::tree();

        return view('admin_them.admin.filter-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FilterRequest $request, int $id)
    {
        $filter = Filter::with('categories')->findOrFail($id);
        $filter->categories()->sync($request->filter('categories'));

        $properties = $request->filter('properties');
        $this->validateValue($properties);
        $filter->fill($properties);
        $filter->save();

        if(
            isset($properties['status']) &&
            $properties['status'] == 'D'
        ) {
            $filter->delete();
        }

        return redirect('admin/filter');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $filter = Filter::with('categories')->findOrFail($id);
        $filter->categories()->detach();
        $filter->forceDelete();

        return redirect('admin/filter');
    }

    private function validateValue(array &$properties)
    {
        $tmp = $properties;
        $properties['feature_id'] = null;
        $properties['other'] = null;

        switch($properties['type']){
            case 'feature':
                $properties['feature_id'] = $tmp['feature_id'];
                break;
            case 'price':
                $properties['other']['round_to'] = $tmp['other']['round_to'];
                break;
        }
    }
}
