@extends('front.include.layouts')
@section('title') Login Register Pages @endsection

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
            <li class="active">My Account</li>
        </ul>
        <h3>MY ACCOUNT</h3>
        @if(session()->has('message'))
            <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
        @endif
        <hr class="soft"/>

        <div class="row">
            <div class="span4">
                <div class="well">
                    <h5>CONTACT DETAILS</h5>
                    Enter your contact details.<br/><br/>
                    <form id="accountForm" action="{{ url('/account') }}" method="POST"> @csrf

                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input class="span3" name="name" value="{{ $userDetails['name'] }}" type="text" id="name" placeholder="Enter Name">
                            </div>
                            @error('name') <span class="text-danger font-italic">{{$message}}</span> @enderror
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">Address</label>
                            <div class="controls">
                                <input class="span3" name="address" value="{{ $userDetails['address'] }}" type="text" id="address" placeholder="Enter Address">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="city">City</label>
                            <div class="controls">
                                <input class="span3" name="city" value="{{ $userDetails['city'] }}" type="text" id="city" placeholder="Enter City">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="state">State</label>
                            <div class="controls">
                                <input class="span3" name="state" value="{{ $userDetails['state'] }}" type="text" id="state" placeholder="Enter State">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="country">Country</label>
                            <div class="controls">
                                <select name="country" id="country" style="width: 82%;">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['country_name']}}" @if($country['country_name'] == $userDetails['country']) selected="" @endif >{{$country['country_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pincode">Pin code</label>
                            <div class="controls">
                                <input class="span3" name="pincode" value="{{ $userDetails['pincode'] }}" type="text" id="pincode" placeholder="Enter Pincode">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="mobile">Mobile</label>
                            <div class="controls">
                                <input class="span3" name="mobile" value="{{ $userDetails['mobile'] }}" type="text" id="mobile" placeholder="Enter Mobile">
                            </div>
                            @error('mobile') <span class="text-danger font-italic">{{$message}}</span> @enderror
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email">E-mail address</label>
                            <div class="controls">
                                <input class="span3" id="email" readonly="" value="{{ $userDetails['email'] }}">
                            </div>
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn block">Update Account</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="span1">&nbsp;</div>
            <div class="span4">
                <div class="well">
                    <h5>UPDATE PASSWORD ?</h5>
                    <form id="updatePasswordForm" action="{{ url('/update-user-password') }}" method="POST">@csrf

                        <div class="control-group">
                            <label class="control-label" for="current_password">Current Password</label>
                            <div class="controls">
                                <input type="password" name="current_password" class="span3"  id="current_password" placeholder="Current Password">
                            </div>
                            <span id="checkPwd"></span>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="new_password">New Password</label>
                            <div class="controls">
                                <input type="password" name="new_password" class="span3"  id="new_password" placeholder="New Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="confirm_password">Confirm Password</label>
                            <div class="controls">
                                <input type="password" name="confirm_password" class="span3"  id="confirm_password" placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
