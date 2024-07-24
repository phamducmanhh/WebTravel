<?php

namespace App\Http\Controllers;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoriesController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->categoryService->getCategoriesProduct();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'description' => 'required',
            'image' => 'required',
            'status' => 'required',
            'category_parent' => 'required',
        ],[
            'title.required' => 'Yêu cầu nhập tiêu đề',
            'description.required' => 'Yêu cầu nhập mô tả',
            'image.required' => 'Yêu cầu chọn hình ảnh',
            'status.required' => 'Yêu cầu check status',
            'category_parent.required' => 'Yêu cầu chọn danh mục',
        ]);

        $get_image = $request->image;
        $path = 'uploads/categories/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $data['image'] = $new_image;
        $this->categoryService->createCategory($data);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $categories = $this->categoryService->getCategoriesProduct();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'description' => 'required',
            'status' => 'required',
            'category_parent' => 'required',
        ],[
            'title.required' => 'Yêu cầu nhập tiêu đề',
            'description.required' => 'Yêu cầu nhập mô tả',
            'status.required' => 'Yêu cầu check status',
        ]);

        if($request->image){
            $get_image = $request->image;
            $path = 'uploads/categories/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $data['image'] = $new_image;
        }

        $this->categoryService->updateCategory($id, $data);
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('categories.index');
    }
}
