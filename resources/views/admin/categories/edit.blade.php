@extends('layouts.app')

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update category</h3>
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
    <form method="POST" action="{{route('categories.update',[$category->id])}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" value="{{$category->title}}"class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter title">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <input type="text" value="{{$category->description}}" class="form-control" name="description" id="exampleInputPassword1" placeholder="Enter description">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Image</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="form-control-flie" name="image" id="exampleInputFile">
              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <img width="80px" height="80px" src="{{asset('uploads/categories/'.$category->image)}}">
          </div>
        </div>
        <div class="form-group">
          <label for="category_parent">Thuộc danh mục</label>
          <select class="form-control" name="category_parent" id="category_parent">
            <option value="0">---Root---</option>
            @foreach($categories as $key => $val)
                <option  {{ $val->id == $category->category_parent ? 'selected' :  '' }} value="{{$val->id}}">
                  @php
                    $str = '';
                    for($i = 0; $i < $val->level; $i++) {
                      $str .= '-- ';
                    }
                  @endphp
                  {{ $str . $val->title }}
                </option>
            @endforeach 
          </select>
        </div>
        <div class="form-check">
          <input type="checkbox" value="1" {{$category->status ==1 ? 'checked' : '' }} class="form-check-input" name="status" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
@endsection
