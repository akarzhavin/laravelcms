<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\CategoryDescription;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

/**
 * Class CategoryController
 * CRUD for category (/admin/categories).
 *
 * @category AppControllers
 *
 */
class CategoryController extends Controller
{
    /**
     * Paginated listing of shop categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('description')
            ->has('description')
            ->withTrashed()
            ->paginate(10);
        return view('admin_them.admin.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryTree = Category::tree();
        return view('admin_them.admin.categories-create', compact('categoryTree'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Redirect
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->filter();
        $this->validateParentId($data);

        //Save category
        $category = new Category;
        $category->fill($data);
        $category->save();

        //Set parent_id
        $idPath = $this->calculateIdPath($category->id, $data['parent_id']);
        $category->id_path = $idPath;
        $category->parent_id = $data['parent_id'];
        $category->level = count(explode('/', $idPath)) - 1;
        $category->save();

        //Save description.
        $description = new CategoryDescription;
        $description->category_id = $category->id;
        $description->fill($data);
        $description->save();

        $request->session()->flash('alert-success', 'Category added!');
        return redirect('admin/categories/');
    }

    /**
     * Display the specified category.
     * Not required - to be removed.
     *
     * @param int $id category id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id category id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::with('description')->withTrashed()->get();
        $category = $categories->where('id', $id)->first();
        $categoryTree = Category::tree($categories);

        return view('admin_them.admin.categories-edit', compact('category', 'categoryTree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest|Request $request update request
     * @param int $id category id
     * @return Redirect
     */
    public function update(CategoryRequest $request, $id)
    {
        //Redirect if id = 1
        $validator = $this->validateId($request->route('category'));
        if ($validator->fails()) {
            return redirect('admin/categories')->withErrors($validator)->withInput();
        }

        //Validate parent_id
        $this->validateParentId($data);

        //Get category
        $category = Category::where('id', $id)->withTrashed()->first();

        //Set parent_id
        $category->id_path = $this->calculateIdPath($category->id, $category->parent_id);

        //Update properties
        $category->update($request->filter());
        $category->description->update($request->filter());

        //Update status
        if($category->trashed()){
            $request->status != ('A') ?: $category->restore();
        } else {
            $request->status != ('H'||'D') ?: $category->delete();
        }

        $request->session()->flash('alert-success', 'Category name has been updated!');
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id category id
     * @return Redirect
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();
//        $category->update(['status' => 'D']);

        $request->session()->flash('alert-success', 'Category has been deleted!');
        return redirect('admin/categories/');
    }

    private function validateParentId(&$data)
    {
        //Check if parent_id is empty
        if(empty($data['parent_id'])){
            $data['parent_id'] = 1;
        }
    }

    private function validateId(int $category_id)
    {
        //Validate from id = 1
        return Validator::make(['id' => $category_id], ['id' => 'not_in:1']);
    }

    private function calculateIdPath(int $current_id, int $parent_id)
    {
        $parent = Category::where('id', $parent_id)->withTrashed()->first();
        $idPath = explode('/', $parent->id_path);
        $idPath[] = $current_id;
        $idPath = array_filter($idPath);
        return implode('/', $idPath);
    }
}
