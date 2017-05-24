@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-3 control-label">E-Mail</label>

            <div class="col-md-9">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-primary">
                    Kirim Link Reset Password
                </button>
            </div>
        </div>
    </form>

    <a href="{{url('/')}}">Masuk Halaman Login</a><br>
    {{--<a href="#" class="text-center">Register a new membership</a>--}}
@endsection
