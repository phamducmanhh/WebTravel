<?php

namespace App\Repositories;
use App\Services\CategoryService;
use App\Models\Category;
use App\Models\Tour;
use App\Services\TourService;

class TourRepository implements TourRepositoryInterface
{
    public function getAllTours()
    {
        return Tour::orderBy('id', 'DESC')->get();
    }

    public function getTourById($id)
    {
        return Tour::find($id);
    }

    public function createTours(array $data)
    {
        return Tour::create($data);
    }

    public function updateTour($id, array $data)
    {
        return Tour::whereId($id)->update($data);
    }

    public function deleteTour($id)
    {
        return Tour::destroy($id);
    }

    
}
