@extends('layouts.main')
@section('sidebar')
    @include('admin.main.sidebar')
@endsection
@section('content')
    <div class="card-body card-block">
        <form action="{{route('create')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{@csrf_field()}}
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-plus"></i>Thêm mới người dùng
                </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col-5">
                            <div class="row form-group">
                                <img src="{{asset('default-image.jpg')}}"
                                     style="width: 100px; height: 100px; border-radius: 20px;">
                                <input id="profile_image" type="file" class="form-control" name="profile_image">
                            </div>

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Tên người sử dụng</label></div>
                                <div class="col-8"><input type="name" id="name" name="name" placeholder="Nhập vào tên"
                                                          class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4">
                                    <label for="exampleInputName2">Email</label>
                                </div>
                                <div class="col-8">
                                    <input type="email" id="email" name="email" placeholder="Nhập vào email"
                                           class="form-control">
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
                                                          class="form-control">
                                </div>
                            </div>


                        </div>

                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Địa chỉ</label></div>
                                <div class="col-8"><input type="address" id="address" name="address"
                                                          placeholder="Nhập vào địa chỉ"
                                                          class="form-control"></div>
                            </div>
                        </div>


                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Quyền</label></div>
                                <div class="col-8">
                                    <select class="browser-default custom-select" name="role" id="role">
                                        <option value="Admin">Admin</option>
                                        <option value="Người dùng">Người dùng</option>
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
                                        <option value="Hoạt động">Hoạt động</option>
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
    </div>

    </div>
    </div>
    </div>
@endsection