@extends('front.include.layouts')
@section('title') Login Register Pages @endsection

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
            <li class="active">DELIVERY ADDRESS</li>
        </ul>
        <h3>{{ $title }}</h3>
        @if(session()->has('message'))
            <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
        @endif
        <hr class="soft"/>

        <div class="row">
            <div class="span4">
                <div class="well">
                    Enter your Delivery Address details.<br/><br/>
                    <form id="deliveryAddressForm"
                          @if(empty($address['id']))
                          action="{{ url('/add-edit-delivery-address') }}"
                          @else
                          action="{{ url('/add-edit-delivery-address/'.$address['id']) }}"
                          @endif
                          method="POST"> @csrf
                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input class="span3" @if(isset($address['name'])) value="{{ $address['name'] }}"
                                       @else value="{{ old('name') }}" @endif name="name" type="text" id="name"
                                       placeholder="Enter Name">
                            </div>
                            @error('name') <span class="text-danger font-italic"
                                                 style="color:red;">{{$message}}</span> @enderror
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">Address</label>
                            <div class="controls">
                                <input class="span3" name="address"
                                       @if(isset($address['address'])) value="{{ $address['address'] }}"
                                       @else value="{{ old('address') }}" @endif type="text" id="address"
                                       placeholder="Enter Address">
                            </div>
                            @error('address') <span class="text-danger font-italic"
                                                    style="color: red;">{{$message}}</span> @enderror
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="city">City</label>
                            <div class="controls">
                                <input class="span3" @if(isset($address['city'])) value="{{ $address['city'] }}"
                                       @else value="{{ old('city') }}" @endif name="city" type="text" id="city"
                                       placeholder="Enter City">
                            </div>
                            @error('city') <span class="text-danger font-italic"
                                                 style="color:red;">{{$message}}</span> @enderror
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="state">State</label>
                            <div class="controls">
                                <input class="span3" name="state" type="text"
                                       @if(isset($address['state'])) value="{{ $address['state'] }}"
                                       @else value="{{ old('state') }}" @endif id="state" placeholder="Enter State">
                            </div>
                            @error('state') <span class="text-danger font-italic"
                                                  style="color:red;">{{$message}}</span> @enderror
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="country">Country</label>
                            <div class="controls">
                                <select name="country" id="country" style="width: 82%;">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['country_name']}}"
                                                @if($country['country_name']==$address['country']) selected="" @elseif($country['country_name']==old('country')) selected="" @endif>{{$country['country_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('country') <span class="text-danger font-italic"
                                                    style="color:red;">{{$message}}</span> @enderror
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pincode">Pin code</label>
                            <div class="controls">
                                <input class="span3" @if(isset($address['pincode'])) value="{{ $address['pincode'] }}"
                                       @else value="{{ old('pincode') }}" @endif name="pincode" type="text" id="pincode"
                                       placeholder="Enter Pincode">
                            </div>
                            @error('pincode') <span class="text-danger font-italic"
                                                    style="color:red;">{{$message}}</span> @enderror
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="mobile">Mobile</label>
                            <div class="controls">
                                <input class="span3" name="mobile"
                                       @if(isset($address['mobile'])) value="{{ $address['mobile'] }}"
                                       @else value="{{ old('mobile') }}" @endif type="text" id="mobile"
                                       placeholder="Enter Mobile">
                            </div>
                            @error('mobile') <span class="text-danger font-italic"
                                                   style="color: red;">{{$message}}</span> @enderror
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn block">Submit</button>
                            <a href="{{ url('/checkout') }}" class="btn block">Back</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
