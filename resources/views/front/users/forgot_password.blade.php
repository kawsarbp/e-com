@extends('front.include.layouts')
@section('title') Login Register Pages @endsection

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
            <li class="active">Login / Register</li>
        </ul>
        <h3>Forgot Password</h3>
        @if(session()->has('message'))
            <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
        @endif
        <hr class="soft"/>
        <div class="row">
            <div class="span4">
                <div class="well">
                    <h5>FORGOT PASSWORD ?</h5>
                    Enter your e-mail to get new password.<br/><br/>
                    <form id="forgotPasswordForm" action="{{ url('/forgot-password') }}" method="POST"> @csrf

                        <div class="control-group">
                            <label class="control-label" for="email">E-mail address</label>
                            <div class="controls">
                                <input class="span3" name="email" type="email" id="email" placeholder="Email" >
                            </div>
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn block">Submit</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
