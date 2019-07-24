@extends('layouts.main')
@section('sidebar')
    @include('admin.main.sidebar')
@endsection
@section('content')
    <div class="card-body card-block">
        <form action="{{route('admin.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{@csrf_field()}}
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-plus"></i>Thêm mới người dùng
                </div>
                <div class="card-body card-block">

                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                @if (session('data'))
                                    <img id="blah" src="{{asset('uploads/fails_images/'. session('data'))}}"
                                         style="width: 100px;">
                                @else
                                    <img id="blah" src="{{asset('default-image.jpg')}}" style="width:100px; ">

                                @endif

                                <input id="profile_image" type="file" class="form-control" name="profile_image"
                                       value="{{old('profile_image')}}">
                                       @if ($errors->has('profile_image'))
                                       <div class="alert alert-danger">
                                           <p>
                                                 {{$errors->first('profile_image')}}
                                           <p>
                                       </div>
                                   @endif
                            </div>

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Tên người sử dụng</label></div>
                                <div class="col-8"><input type="name" id="name" name="name" placeholder="Nhập vào tên"
                                                          class="form-control"
                                                          value="{{old('name')}}">
                                                          @if ($errors->has('name'))
                                                          <div class="alert alert-danger">
                                                              <p>
                                                                    {{$errors->first('name')}}
                                                              <p>
                                                          </div>
                                                      @endif
                                                        </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4">
                                    <label for="exampleInputName2">Email</label>
                                </div>
                                <div class="col-8">
                                    <input type="email" id="email" name="email" placeholder="Nhập vào email"
                                           value="{{old('email')}}" class="form-control">
                                           @if ($errors->has('email'))
                                                          <div class="alert alert-danger">
                                                              <p>
                                                                    {{$errors->first('email')}}
                                                              <p>
                                                          </div>
                                                      @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">

                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Password</label></div>
                                <div class="col-8"><input type="password" id="password" name="password"
                                                          placeholder="Password"
                                                          value="{{old('password')}}" class="form-control">
                                                          @if ($errors->has('password'))
                                                          <div class="alert alert-danger">
                                                              <p>
                                                                    {{$errors->first('password')}}
                                                              <p>
                                                          </div>
                                                      @endif
                                </div>
                            </div>


                        </div>

                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Địa chỉ</label></div>
                                <div class="col-8"><input type="address" id="address" name="address"
                                                          placeholder="Nhập vào địa chỉ"
                                                          class="form-control" value="{{old('address')}}">
                                                          @if ($errors->has('address'))
                                                          <div class="alert alert-danger">
                                                              <p>
                                                                    {{$errors->first('address')}}
                                                              <p>
                                                          </div>
                                                      @endif
                                                        </div>
                            </div>
                        </div>


                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Quyền</label></div>
                                <div class="col-8">
                                    <select class="browser-default custom-select" name="role" id="role">
                                        <option value="1">Admin</option>
                                        <option value="2">Người dùng</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4">
                                    <label for="exampleInputName2">Trạng thái</label>
                                </div>
                                <div class="col-8">
                                    <select class="browser-default custom-select" name="active" id="active">
                                        <option value="1">Hoạt động</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i>Đăng kí
                </button>
            </div>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#profile_image").change(function () {
                readURL(this);
            });
        </script>
    </div>

@endsection
