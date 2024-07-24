<?php

namespace App\Repositories;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::orderBy('id', 'DESC')->get();
    }

    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory($id, array $data)
    {
        return Category::whereId($id)->update($data);
    }

    public function deleteCategory($id)
    {
        return Category::destroy($id);
    }

    public function getCategoriesProduct()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        $listCategory = [];
        Category::recursive($categories, $parent = 0, $level = 1, $listCategory);
        return $listCategory;
    }
}
