@extends('layouts.main')
@section('sidebar')
    @include('user.main.sidebar')
@endsection
@section('content')
    <div class="card-body card-block">
        <form action="{{route('user.post',['id'=>$user->id])}}" method="post" class="form-horizontal">
            {{@csrf_field()}}
            <div class="card">
                <div class="card-header">
                    Chỉnh sửa thông tin người dùng
                </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <img src="{{asset(auth()->user()->image)}}" style="width: 100px; height: 100px; border-radius: 20px;">
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Tên người sử dụng</label></div>
                                <div class="col-8"><input type="name" id="name" value="{{$user->name}}" name="name" placeholder="Nhập vào tên"
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
                                           value="{{$user->email}}"  class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Địa chỉ</label></div>
                                <div class="col-8"><input type="address" id="address" name="address" placeholder="Nhập vào địa chỉ"
                                                          value="{{$user->address}}"  class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4">
                                    <label for="exampleInputName2">Trạng thái</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="active" name="active" placeholder="Trạng thái "
                                           class="form-control"  disabled value="{{$user->active_flg==1?"Hoạt động":"Ngừng hoạt động"}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Quyền</label></div>
                                <div class="col-8"><input type="text" id="role" name="role" placeholder="Email"
                                                          class="form-control" disabled value="{{$user->role_id==1?"Admin":"Người dùng"}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-footer">
            <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Chỉnh sửa
            </a>
        </div>
    </div>

    </div>
    </div>
    </div>
@endsection