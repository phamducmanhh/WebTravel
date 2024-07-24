<?php

namespace App\Repositories;
use App\Services\CategoryService;
interface TourRepositoryInterface
{
    public function getAllTours();
    public function getTourById($id);
    public function createTours(array $data);
    public function updateTour($id, array $data);
    public function deleteTour($id);
}
