<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Gallery;
//use App\Http\Models\Images;
use App\Facades\Images;
use App\Http\Requests\GalleryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        $gallery = Gallery::find($id);

        $images = array();
        foreach($gallery->images as $key => $image) {
            $images[$key] = $image->toArray();

            $storeImage = Images::where('dir', $image->path)->where('hash_name', $image->hash_name)->first();
            if($storeImage){
                $url = $storeImage->thumbnail(100, 100);
            } else {
                $url = Images::placeholder(100, 100);
            }

            $images[$key]['thumbnail'] = $url;
        }

        $data['gallery'] = $gallery;
        $data['images'] = $images;

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
        App::instance('gallery-model', $gallery);

        //Update product images
        $this->deleteImages($request);
        $this->updateImages($request);

        $gallery->update($data['properties']);

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

    /**
     * Delete images
     *
     * @param GalleryRequest $request
     * @return bool|null
     * @throws \Exception
     */
    private function deleteImages(GalleryRequest $request)
    {
        //Collecting the images ids to list
        $listGetId = array();

        foreach($request->images as $image){
            if(isset($image['id'])){
                $listGetId[] = $image['id'];
            }
        }

        //Delete other id
        $gallery = App::make('gallery-model');
        $status = $gallery->images()->sync($listGetId);
        return $status;
    }

    /**
     * Update all acquired images
     * and save uploaded images to server
     *
     * @param GalleryRequest $request
     */
    private function updateImages(GalleryRequest $request)
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
            $gallery = App::make('gallery-model');
            $gallery->images()->syncWithoutDetaching([
                $imageId => [
                    'order' => $order,
                    'main' => $main
                ]
            ]);
        }
    }
}
