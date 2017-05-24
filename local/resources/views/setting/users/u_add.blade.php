<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('/u') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" placeholder="Nama Pengguna.." value="{{ old('name') }}" required>
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Roles</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="role_id">
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $row)
                                        <option value="{{ $row->id }}" {{ $row->id==old('role_id')?'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('role_id') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-3">
                                <input type="email" name="email" class="form-control" placeholder="Email Address.." value="{{ old('email') }}" required>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-3">
                                <input type="password" name="password" class="form-control" placeholder="Password.." required>
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-3">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password.." required>
                                <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <a href="{{ url('u') }}" class="btn btn-default">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection