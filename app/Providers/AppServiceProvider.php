<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepositoryInterface;
use App\Services\CategoryService;
use View;
use App\Models\Category;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function getCategoriesProduct(){
        $categories = Category::orderBy('id', 'DESC')->get();
        $listCategory = [];
        Category::recursive($categories, $parent = 0, $level =1, $listCategory);
        return $listCategory;
    }
    
    public function register(): void
    {
        $this->app->bind(\App\Repositories\CategoryRepositoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Services\CategoryService::class, function ($app) {
            return new \App\Services\CategoryService($app->make(\App\Repositories\CategoryRepositoryInterface::class));
        });

        $this->app->bind(\App\Repositories\TourRepositoryInterface::class, \App\Repositories\TourRepository::class);
        $this->app->bind(\App\Services\TourService::class, function ($app) {
            return new \App\Services\TourService($app->make(\App\Repositories\TourRepositoryInterface::class));
        });

        $this->app->bind(\App\Repositories\GalleryRepositoryInterface::class, \App\Repositories\GalleryRepository::class);
        $this->app->bind(\App\Services\GalleryService::class, function ($app) {
            return new \App\Services\GalleryService($app->make(\App\Repositories\GalleryRepositoryInterface::class));
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function($view){
            $categories = $this -> getCategoriesProduct();
            $view->with('categories', $categories);
        });
        
    }
}
