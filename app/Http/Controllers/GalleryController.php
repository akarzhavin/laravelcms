<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Gallery;
use App\Http\Requests\GalleryRequest;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::paginate(15);
        return view('admin_them.admin.galleries', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_them.admin.gallery-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->filter();
        $gallery = Gallery::create($data['properties']);

        $request->session()->flash('alert-success', 'Feature has been added!');
        return redirect('admin/gallery');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $data['gallery'] = Gallery::find($id);
        return view('admin_them.admin.gallery-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GalleryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $data = $request->filter();
        $gallery = Gallery::where('id', $id)->first();
        $gallery->fill($data['properties']);
        $gallery->save();

        return redirect('admin/gallery');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::destroy($id);
        return redirect('admin/gallery');
    }
}
