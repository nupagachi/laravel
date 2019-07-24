<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->

        <div class="card">
            <div class="card-header">
                <i class="zmdi zmdi-account-calendar"></i> User data
                <span style="float: right"> <button onclick="window.location='{{route('admin.create')}}'" type="button"
                                                    class="btn btn-primary">Thêm mới</button></span>
            </div>
            <form action="{{route('admin.search')}}" method="get" class="form-horizontal">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Tên người sử dụng</label></div>
                                <div class="col-8"><input type="text" id="name" name="name"
                                                          value="{{\Illuminate\Support\Facades\Session::get('name')}}"
                                                          placeholder="Nhập vào tên"
                                                          class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4">
                                    <label for="exampleInputName2">Email</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="email" name="email" placeholder="Nhập vào email"
                                           value="{{\Illuminate\Support\Facades\Session::get('email')}}"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4">
                                    <label for="exampleInputName2">Quyền sử dụng</label>
                                </div>
                                <div class="col-8">
                                    <select class="browser-default custom-select" name="role" id="role">
                                        @foreach(config('rules.role') as $value=> $key)
                                            <option {{ \Illuminate\Support\Facades\Input::get('role') == $key ?"selected":'' }} value="{{$key}}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
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
                                        @foreach(config('rules.active') as $value=> $key)
                                            <option {{ \Illuminate\Support\Facades\Input::get('active') == $key ?"selected":'' }} value="{{$key}}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Tìm kiếm
                    </button>

                </div>
            </form>
            <hr/>
            <table class="table table-data2">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Quyền</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                @foreach($user as $users)
                    <tbody>
                    <tr class="tr-shadow">

                        <td>{{$loop->index+1}}</td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->email}}</td>
                        <td class="desc">{{$users->address}}</td>
                        <td>{{$users->active_flg==1 ? "Hoạt động" :"Không hoạt động"}}</td>
                        <td>
                            {{$users->role_id==1 ? "Admin" : "Người dùng"}}
                        </td>
                        <td>
                            <img src="{{asset($users->profile_image)}}"
                                 onerror="this.src='{{asset('default-image.jpg')}}'"
                                 style="width: 100px">
                        </td>
                        <td>
                            <a href="{{route('admin.edit',['id'=>$users->id])}}"><i class="far fa-edit"></i></a>
                            @if($users!=Auth::user())
                                <a href="{{route('admin.edit',['id'=>$users->id])}}"><i class="fa fa-trash"
                                                                                        style="color: red"
                                                                                        aria-hidden="true"></i></a>
                            @endif

                        </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
            {{ $user->links() }}

        </div>
        <?php
        \Illuminate\Support\Facades\Session::forget('name');
        \Illuminate\Support\Facades\Session::forget('email');
        ?>

    </div>
</div>
