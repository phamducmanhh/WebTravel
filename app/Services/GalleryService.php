<?php

namespace App\Services;

use App\Repositories\GalleryRepositoryInterface;
use Illuminate\Support\Str;
use App\Repositories\RepositoryInterface;

class GalleryService
{
    protected $galleryRepository;

    public function __contruct(GalleryRepositoryInterface $galleryRepository){
        $this->galleryRepository = $galleryRepository;
    }

    public function getAllGallery(){
        return $this->galleryRepository = getAllGallery();
    }

    public function createGallery(array $data){
        return $this->galleryRepository = createGallery();
    }

    public function deleteGallery($id){
        return $this->galleryRepository = deleteGallery();
    }
}
