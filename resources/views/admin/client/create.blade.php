@extends('layouts.app')
@section('content')
<section class="content">
    <form method="post" class="form-horizontal" action="{{route('admin.clients.store')}}">
        @method('POST')
        @csrf
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add Client</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>

                </div>
            </div>
            <div class="card-body">

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
                            @if($sub->id != 2)
                            <option value="{{$sub->id}}" {{ (old('subscription') == $sub->id) ? 'Selected' : ''}}>
                                {{ ucfirst($sub->name) }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for=""> Sub Domain</label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Sub Domain" type="text" name="subdomain" value="{{ old('subdomain') }}">
                        @error('subdomain')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for=""> Slot Duration</label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Slot Duration in minutes" type="text" name="slot_duration" value="{{ old('slot_duration') }}">
                        @error('slot_duration')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right" type="submit"> Submit</button>
            </div>

        </div>
    </form>
</section>
@endsection