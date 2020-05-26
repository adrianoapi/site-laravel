@extends('admin.master.layout')

@section('content')

<div class="wrapper">
    <h1><a href="index.html"><img src="img/logo-big.png" alt="" class='retina-ready' width="59" height="49">FLAT</a></h1>
    <div class="login-body">
        <h2>SIGN IN</h2>
        <form action="{{route('admin.login.do')}}" method='POST' class='form-validate' id="test">
            @csrf
            @if($errors->all())
                @foreach($errors->all() as $error)
                    {{$error}}
                    <br>
                @endforeach
            @endif
            <div class="control-group">
                <div class="email controls">
                    <input type="text" name='email' placeholder="Email address" class='input-block-level' data-rule-required="true" data-rule-email="true">
                </div>
            </div>
            <div class="control-group">
                <div class="pw controls">
                    <input type="password" name="password" placeholder="Password" class='input-block-level' data-rule-required="true">
                </div>
            </div>
            <div class="submit">
                <input type="submit" value="Autenticar" class='btn btn-primary'>
            </div>
        </form>
        <div class="forget">
            <a href="#"><span>Forgot password?</span></a>
        </div>
    </div>
</div>

@endsection