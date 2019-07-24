
    <div class="card-body card-block">
        <form action="{{route('admin.post.profile')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{@csrf_field()}}
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i>
                     Thông tin người dùng
                </div>
                <div class="card-body card-block">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row form-group">
                        <div class="col-6">
                            @if (session('data'))
                                <img id="blah" src="{{asset('uploads/images/'. session('data'))}}"
                                     style="width: 100px;">
                            @else
                                <img id="blah" src="{{asset(auth()->user()->image)}}" style="width:100px; ">
                            @endif
                            <input id="profile_image" type="file" class="form-control" name="profile_image">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Tên người sử dụng</label></div>
                                <div class="col-8">
                                    @if(!empty(Session('nameP')))
                                        <input type="name" id="name" value="{{Session('nameP')}}" name="name"
                                                          placeholder="Nhập vào tên"
                                                          class="form-control" >
                                    @else

                                        <input type="name" id="name" value="{{$user->name}}" name="name"
                                                          placeholder="Nhập vào tên"
                                                          class="form-control" >
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
                                        @if(!empty(Session('emailP')))
                                        <input type="email" id="name" value="{{Session('emailP')}}" name="email"
                                                          placeholder="Nhập vào email"
                                                          class="form-control" >
                                    @else

                                        <input type="email" id="name" value="{{$user->email}}" name="email"
                                                          placeholder="Nhập vào email"
                                                          class="form-control" >
                                    @endif
                                </div>
                                </div>
                            </div>
                        </div>

                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Địa chỉ</label></div>
                                <div class="col-8">
                                    @if(!empty(Session('addressP')))
                                    <input type="address" id="address" name="address"
                                    placeholder="Nhập vào địa chỉ"
                                    value="{{Session('addressP')}}" class="form-control"   >
                                    @else
                                    <input type="address" id="address" name="address"
                                                          placeholder="Nhập vào địa chỉ"
                                                          value="{{$user->address}}" class="form-control">
                                    @endif
                                    </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4">
                                    <label for="exampleInputName2">Trạng thái</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="active" name="active" placeholder="Trạng thái "
                                           class="form-control"
                                           value="{{$user->active_flg==1?"Hoạt động":"Ngừng hoạt động"}}"
                                           disabled="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <div class="row form-group">
                                <div class="col-4"><label for="exampleInputName2">Quyền</label></div>
                                <div class="col-8"><input type="text" id="role" name="role" placeholder="Email"
                                                          class="form-control"
                                                          value="{{$user->role_id==1?"Admin":"Người dùng"}}"
                                                          disabled="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Chỉnh sửa
                </button>
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

