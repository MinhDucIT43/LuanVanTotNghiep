@extends('background.bgblack')

@section('content')
    <div class="login-form">
        <img src="resources/images/login/login.png" alt="Login" id="login-img">
        <form method="post" action="{{ route('auth.postLogin') }}"> @csrf
            <div class="form-group" id="top-form">
                <label>Số điện thoại</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{old('phone')}}" autofocus>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" value="{{old('password')}}">
            </div>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
            <a href="{{ route('repass.inputPhoneNumberAndReceiveCode') }}" id="inputPhoneNumberAndReceiveCode"><img src="resources/images/login/key.png" alt="Key" id="key"> Đổi mật khẩu</a>
        </form>
        <div class="error-messages">
            @if($errors->has('phone'))
            <span class="error-message"> * {{ $errors->first('phone') }} </span>
            @endif
            <br />
            @if($errors->has('password'))
            <span class="error-message"> * {{ $errors->first('password') }} </span>
            @endif
        </div>
    </div>
@endsection