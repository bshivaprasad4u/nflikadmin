@extends('layouts.app')
@section('content')
<section class="content">
    <form method="post" class="form-horizontal" action="{{route('client.contents.update',$content->id)}}" enctype="multipart/form-data">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Update Content</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>

                </div>
            </div>
            <div class="card-body">
                @method('POST')
                @csrf
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for=""> Category</label>
                    <div class="col-sm-8">
                        <select class="form-control select2bs4" name="category">
                            @foreach($categories as $sub):
                            <option value="{{$sub->id}}" {{($content->category_id == $sub->id)?'Selected':''}}>
                                {{ ucfirst($sub->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="name" placeholder="Enter Name" type="text" value="{{ old('name') ?? $content->name }}">
                        @error('name')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Video File</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="videofile" placeholder="Select Video" type="file">
                        @error('videofile')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div> -->
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Banner Image</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="banner_image" name="file" type="file">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('file')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for=""> Language</label>
                    <div class="col-sm-8">
                        <?php sort($languages); ?>
                        <select class="form-control" name="language">

                            @foreach($languages as $language):
                            <option value="{{$language}}" {{($content->language == $language)?'Selected':''}}>
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
                            <?php sort($genres); ?>
                            @foreach($genres as $genre):
                            <option value="{{$genre}}" {{($content->genres == $genre)?'Selected':''}}>
                                {{ ucfirst($genre) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Tags</label>
                    <div class="col-sm-8">
                        <?php $tags = ($content->tags) ? implode(',', json_decode($content->tags)) : '';
                        ?>
                        <input data-role="tagsinput" class="form-control" placeholder="Enter , seperated Tags" type="text" name="tags" value="{{ old('tags') ?? $tags }}" data-role="tagsinput">
                        @error('tags')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Display Tags</label>
                    <div class="col-sm-8">
                        <?php $display_tags = ($content->display_tags) ? implode(',', json_decode($content->display_tags)) : '';
                        ?>
                        <input class="form-control" placeholder="Enter , seperated Display Tags" type="text" name="display_tags" value="{{ old('display_tags')?? $display_tags }}" data-role="tagsinput">
                        @error('display_tags')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Artist</label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Artist Name" type="text" name="artist" value="{{ old('artist') ?? $content->artist }}">
                        @error('artist')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Cast & Crew </label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Cast & Crew" type="text" name="castandcrew" value="{{ old('castandcrew') ?? $content->castandcrew }}">
                        @error('castandcrew')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for=""> Description</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter Description here....">{{ old('description')??$content->description }}</textarea>
                        @error('description')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('client.contents.view',$content->id) }}"><button type="button" class="btn btn-default float-right ml-3">Cancel</button></a>
                <button class="btn btn-primary float-right" type="submit"> Submit</button>
            </div>
        </div>
    </form>
</section>
@endsection
@section('script')
<script src="{{ asset('adminlte/tags/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('adminlte/ckeditor/ckeditor/ckeditor.js')}}"></script>
<script>
    $(function() {

        $('#banner_image').on('change', function(e) {
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        //$('.select2bs4').select2();
        CKEDITOR.replace('description');
    });
</script>
@endsection