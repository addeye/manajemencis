@extends('layouts.master')

@section('content')
    <div class="row">
        @include('layouts.alert')
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ url('images/'.$data->path) }}"
                         alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $data->name }}</h3>

                    <p class="text-muted text-center">{{ $data->roles->name }}</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Data Login</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="settings">
                        <form method="post" class="form-horizontal" action="{{ url('/profile/'.$data->id.'/update') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{$data->name}}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ $data->email }}">
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input name="password" type="password" class="form-control" id="inputEmail" placeholder="New Password">
                                    <p class="help-block">* Kosongi Jika Tidak Diganti</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input name="confirm_password" type="password" class="form-control" id="inputEmail" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Ganti Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" name="images">
                                    <p class="help-block">* Maksimal 1 MB</p>
                                    <p class="text-danger">{{ $errors->first('images') }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Upadate</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection