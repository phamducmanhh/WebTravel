<?php

namespace App\Services;

use App\Repositories\TourRepositoryInterface;
use Illuminate\Support\Str;
use App\Repositories\RepositoryInterface;

class TourService
{
    protected $tourRepository;

    public function __construct(TourRepositoryInterface $TourRepository)
    {
        $this->TourRepository = $TourRepository;
    }

    public function getAllTours()
    {
        return $this->TourRepository->getAllTours();
    }

    public function getTourById($id)
    {
        return $this->TourRepository->getTourById($id);
    }

    public function createTours(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        $data['tour_code'] = rand(0000, 9999);
        return $this->TourRepository->createTours($data);
    }

    public function updateTour($id, array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->TourRepository->updateTour($id, $data);
    }

    public function deleteTour($id)
    {
        return $this->TourRepository->deleteTour($id);
    }

}
