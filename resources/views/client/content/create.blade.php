@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Content</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <form method="post" class="form-horizontal" action="{{route('client.contents.store')}}" enctype="multipart/form-data">
            <div class="card-body">
                @method('POST')
                @csrf
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for=""> Category</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="category">
                            @foreach($categories as $sub):
                            <option value="{{$sub->id}}">
                                {{ ucfirst($sub->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="name" placeholder="Enter Name" type="text" value="{{ old('name') }}">
                        @error('name')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Video File</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="videofile" placeholder="Select Video" type="file">
                        @error('videofile')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Banner Image</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="file" placeholder="Select File" type="file">
                        @error('file')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for=""> Language</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="language">
                            @foreach($languages as $language):
                            <option value="{{$language}}">
                                {{ ucfirst($language) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for=""> Genres</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="genres">
                            @foreach($genres as $genre):
                            <option value="{{$genre}}">
                                {{ ucfirst($genre) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Artist</label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Artist Name" type="text" name="artist" value="{{ old('artist') }}">
                        @error('artist')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Cast & Crew </label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Cast & Crew" type="text" name="castandcrew" value="{{ old('castandcrew') }}">
                        @error('castandcrew')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for=""> Description</label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Enter Short Description" type="text" name="description" value="{{ old('description') }}">
                        @error('description')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right" type="submit"> Submit</button>
            </div>
        </form>

    </div>
    </div>
</section>
@endsection