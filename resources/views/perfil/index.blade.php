@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">

        <div class="col-lg-7">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Basic form <small>Simple login form example</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>
                            <p>Sign in today for more expirience.</p>
                            <form action="{{route('perfil.update')}}" method="POST"role="form">
                                @csrf
                                @method('PUT')
                                <div class="form-group"><label>Email</label>
                                    <input type="email" name="email" value="{{$user[0]->email}}" placeholder="Enter email" class="form-control">
                                </div>
                                <div class="form-group"><label>Password</label>
                                    <input type="password" name="password" value="" placeholder="Password" class="form-control">
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Salvar</strong></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6"><h4>Not a member?</h4>
                            <p>You can create an account:</p>
                            <p class="text-center">
                                <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Rank de Despesas</h5> <small>Período de 30 dias</small>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    
                    //////////////

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
