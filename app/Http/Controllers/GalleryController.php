<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Gallery;
use App\Services\TourService;
use App\Services\GalleryService;

class GalleryController extends Controller
{

    protected $galleryService;
    protected $tourService;

    public function __contruct(GalleryService $galleryService, TourService $tourService){
        $this->galleryService = $galleryService;
        $this->tourService = $tourService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gallery = $this->galleryService->getAlllGallery();
        return view('admin.galleries.create', compact('gallery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'tour_id' => 'required',
        ],[
            'title.required' => 'Yêu cầu nhập tiêu đề',
            'image.required' => 'Yêu cầu chọn thư viện ảnh',
        ]);

        

        //Thêm hình ảnh
        if($request->hasFile('image')){
            foreach($request->file('image') as $key => $gal){
                $gallery = new Gallery();
                $gallery->title = $data['title'];
                $gallery->tour_id = $data['tour_id'];
                $get_image = $gal;
                $path = 'uploads/galleries/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);

                $gallery->image = $new_image;
                $gallery->save();
            }
        }
        
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galleries = Gallery::where('tour_id', $id)->get();
        $tour = Tour::find($id);
        return view('admin.galleries.create', compact('tour', 'id', 'galleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galleries = Gallery::find($id);
        $galleries->delete();
        return redirect()->back();
    }
}
