@extends('layouts.admin')
@section('content')
<div class="element-wrapper" style="width: 90%;">
    <h6 class="element-header">
        Add Client
    </h6>
    <div class="element-box">
        <form method="post" action="{{route('admin.clients.store')}}">
            @method('POST')
            @csrf
            <h5 class="form-header">
                Add Client
            </h5>
            <div class="form-group row">
                <label class="col-form-label col-sm-4" for="">Name</label>
                <div class="col-sm-8">
                    <input class="form-control" name="name" placeholder="Enter Client Name" type="text" value="{{ old('name') }}">
                    @error('name')
                    <div class="alert-custome">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-4" for="">Email</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Enter email" type="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="alert-custome">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-4" for=""> Phone</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Phone Number" type="text" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                    <div class="alert-custome">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-sm-4" for=""> Subscription</label>
                <div class="col-sm-8">
                    <select class="form-control" name="subscription">
                        @foreach($subscriptions as $sub):
                        <option value="{{$sub->id}}">
                            {{$sub->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-buttons-w">
                <button class="btn btn-primary" type="submit"> Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection