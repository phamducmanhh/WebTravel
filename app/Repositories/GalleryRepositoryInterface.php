<?php

namespace App\Repositories;
use App\Services\GalleryService;
interface GalleryRepositoryInterface
{
    public function getAllGallery();
    public function createGallery(array $data);
    public function deleteGallery($id);
}
