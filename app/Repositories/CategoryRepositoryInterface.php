<?php

namespace App\Repositories;
use App\Services\CategoryService;
interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryById($id);
    public function createCategory(array $data);
    public function updateCategory($id, array $data);
    public function deleteCategory($id);
    public function getCategoriesProduct();
}
