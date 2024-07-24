<?php

namespace App\Repositories;
use App\Services\GalleryService;
use App\Models\Gallery;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function  getAllGallery(){
        return Gallery::orderBy('id', 'DESC');
    }
    
    public function createGallery(array $data){
        return Gallery::create($data);
    }

    public function deleteGallery($id){
        return Gallery::destroy($id);
    }
}
