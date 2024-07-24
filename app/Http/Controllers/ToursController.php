<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Services\TourService;
    use App\Services\CategoryService;
    use Str;

    class ToursController extends Controller
    {
        protected $tourService;
        protected $categoryService;

        public function __construct(TourService $tourService, CategoryService $categoryService)
        {
            $this->tourService = $tourService;
            $this->categoryService = $categoryService;
        }

        public function index()
        {
            $tours = $this->tourService->getAllTours();
            return view('admin.tours.index', compact('tours'));
        }

        public function create()
        {
            $categories = $this->categoryService->getAllCategories();
            return view('admin.tours.create', compact('categories'));
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'title' => 'required|unique:tours|max:255',
                'quantity' => 'required',
                'description' => 'required',
                'price' => 'required',
                'vehicle' => 'required',
                'departure_date' => 'required',
                'return_date' => 'required',
                'tour_from' => 'required',
                'tour_to' => 'required',
                'tour_time' => 'required',
                'category_id' => 'required',
                'status' => 'required',
            ], [
                'title.required' => 'Yêu cầu nhập tiêu đề',
                'title.unique' => 'Tiêu đề đã có! Vui lòng không nhập trùng',
                'quantity.required' => 'Yêu cầu nhập số lượng',
                'description.required' => 'Yêu cầu nhập mô tả tour',
                'price.required' => 'Yêu cầu nhập giá tour',
                'vehicle.required' => 'Yêu cầu nhập phương tiện',
                'departure_date.required' => 'Yêu cầu nhập ngày đi',
                'return_date.required' => 'Yêu cầu nhập ngày về',
                'tour_from.required' => 'Yêu cầu nhập nơi đi',
                'tour_to.required' => 'Yêu cầu nhập nơi đến',
                'tour_time.required' => 'Yêu cầu tổng thời gian',
                'status.required' => 'Yêu cầu check status',
            ]);

            $get_image = $request->image;
            $path = 'uploads/tours/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $data['image'] = $new_image;
            $this->tourService->createTours($data);

            return redirect()->route('tours.index');
        }

        public function edit($id)
        {
            $categories = $this->categoryService->getAllCategories();
            $tour = $this->tourService->getTourById($id);
            return view('admin.tours.edit', compact('tour', 'categories'));
        }

        public function update(Request $request, $id)
        {
            $data = $request->validate([
                'title' => 'required|max:255|unique:tours,title,' . $id,
                'quantity' => 'required',
                'description' => 'required',
                'price' => 'required',
                'vehicle' => 'required',
                'departure_date' => 'required',
                'return_date' => 'required',
                'tour_from' => 'required',
                'tour_to' => 'required',
                'tour_time' => 'required',
                'status' => 'required',
                'category_id' => 'required',
            ], [
                'title.required' => 'Yêu cầu nhập tiêu đề',
                'title.unique' => 'Tiêu đề đã có! Vui lòng không nhập trùng',
                'quantity.required' => 'Yêu cầu nhập số lượng',
                'description.required' => 'Yêu cầu nhập mô tả tour',
                'price.required' => 'Yêu cầu nhập giá tour',
                'vehicle.required' => 'Yêu cầu nhập phương tiện',
                'departure_date.required' => 'Yêu cầu nhập ngày đi',
                'return_date.required' => 'Yêu cầu nhập ngày về',
                'tour_from.required' => 'Yêu cầu nhập nơi đi',
                'tour_to.required' => 'Yêu cầu nhập nơi đến',
                'tour_time.required' => 'Yêu cầu tổng thời gian',
                'status.required' => 'Yêu cầu check status',
            ]);

            if($request->image){
                $get_image = $request->image;
                $path = 'uploads/tours/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $data['image'] = $new_image;
            }
    
            $this->tourService->updateTour($id, $data);
            return redirect()->route('tours.index');
        }

        public function destroy($id)
        {
            $this->tourService->deleteTour($id);
            return redirect()->route('tours.index');
        }
    }
