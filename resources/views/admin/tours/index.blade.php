@extends('layouts.app')

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">List tours</h3>
    </div>

    {{-- Thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- Kết thúc thông báo lỗi --}}
    <!-- /.card-header -->
    <!-- form start -->
    <div class="table table-responsive">
      <table class="table table-striped" id="myTable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Gallery</th>
            <th scope="col">Tiêu đề</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Giá</th>
            <th scope="col">Slug</th>
            <th scope="col">Phương tiện</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Ngày đi</th>
            <th scope="col">Ngày về</th>
            <th scope="col">Mã tour</th>
            <th scope="col">Nơi đi</th>
            <th scope="col">Nơi đến</th>
            <th scope="col">Tổng ngày</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Created date</th>
            <th scope="col">Update date</th>
            <th scope="col">Status</th>
            <th scope="col">Manage</th>
          </tr>
        </thead>
        <tbody>
            @foreach($tours as $key => $tour)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <th scope="row"><a href="{{route('gallery.edit', [$tour->id])}}">Thêm ảnh</a></th>
                    <td>{{$tour->title}}</td>
                    <td><img width="80px" height="80px" src="{{asset('uploads/tours/'.$tour->image)}}"></td>
                    <td>{{$tour->description}}</td>
                    <td>{{number_format($tour->price,0,', ','. ') }}VND</td>
                    <td>{{$tour->slug}}</td>
                    <td>{{$tour->vehicle}}</td>
                    <td>{{$tour->quantity}}</td>
                    <td>{{$tour->departure_date}}</td>
                    <td>{{$tour->return_date}}</td>
                    <td>{{$tour->tour_code}}</td>
                    <td>{{$tour->tour_from}}</td>
                    <td>{{$tour->tour_to}}</td>
                    <td>{{$tour->tour_time}}</td>
                    <td>{{ $tour->category->title}}</td>
                    <td>{{$tour->created_at}}</td>
                    <td>{{$tour->updated_at}}</td>
                    <td>
                        @if($tour->status==1)
                            <span class="text text-success">Active</span>
                        @else
                            <span class="text text-error">UnActive</span>
                        @endif
                    </td>
                    <td>
                        <a  width="68.81px" class="btn btn-warning" href="{{route('tours.edit',[$tour->id])}}">Edit</a>
                        <form onsubmit="return confirm('You definitely want to delete?');" action="{{route('tours.destroy',[$tour->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
@endsection
