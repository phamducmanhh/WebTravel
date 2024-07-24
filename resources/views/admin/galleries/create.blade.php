@extends('layouts.app')

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Gallery</h3>
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
    <form method="POST" action="{{route('gallery.store')}}" enctype="multipart/form-data">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter title">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Image</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="form-control-flie" required multiple name="image[]" id="exampleInputFile">
              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Tour</label>
            
              <select class="form-control" name="tour_id" id="">
                
                  <option value="{{$tour->id}}">{{$tour->title}}</option>
                
              </select>
            
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
    <table class="table table-striped" id="myTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Image</th>
          <th scope="col">Manage</th>
        </tr>
      </thead>
      <tbody>
          @foreach($galleries as $key => $gal)
              <tr>
                  <th scope="row">{{$key}}</th>
                  <td>{{$gal->title}}</td>
                  <td ><img width="80px" height="80px" src="{{asset('uploads/galleries/'.$gal->image)}}"></td>
                  <td>
                      <form onsubmit="return confirm('You definitely want to delete?');" action="{{route('gallery.destroy',[$gal->id])}}" method="POST">
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
