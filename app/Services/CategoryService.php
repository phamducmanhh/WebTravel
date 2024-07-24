<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function createCategory(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->categoryRepository->createCategory($data);
    }

    public function updateCategory($id, array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->categoryRepository->updateCategory($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }

    public function getCategoriesProduct()
    {
        return $this->categoryRepository->getCategoriesProduct();
    }
}
