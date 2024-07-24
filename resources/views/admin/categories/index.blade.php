@extends('layouts.app')

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">List category</h3>
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
    <table class="table table-striped" id="myTable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Slug</th>
            <th scope="col">Created date</th>
            <th scope="col">Update date</th>
            <th scope="col">Status</th>
            <th scope="col">Manage</th>
          </tr>
        </thead>
        <tbody>
            @foreach($categories as $key => $cate)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$cate->title}}</td>
                    <td><img width="80px" height="80px" src="{{asset('uploads/categories/'.$cate->image)}}"></td>
                    <td>{{$cate->description}}</td>
                    <td>{{$cate->slug}}</td>
                    <td>{{$cate->created_at}}</td>
                    <td>{{$cate->updated_at}}</td>
                    <td>
                        @if($cate->status==1)
                            <span class="text text-success">Active</span>
                        @else
                            <span class="text text-error">UnActive</span>
                        @endif
                    </td>
                    <td>
                        <a  width="68.81px" class="btn btn-warning" href="{{route('categories.edit',[$cate->id])}}">Edit</a>
                        <form onsubmit="return confirm('You definitely want to delete?');" action="{{route('categories.destroy',[$cate->id])}}" method="POST">
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
@endsection
