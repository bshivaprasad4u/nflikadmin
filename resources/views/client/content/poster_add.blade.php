@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Poster</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <form method="post" class="form-horizontal" action="{{route('client.contents.poster_store', $content->id)}}" enctype="multipart/form-data">
            <div class="card-body">
                @method('POST')
                @csrf
                <input type="hidden" name="content_id" value="{{$content->id}}">
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
                    <label class="col-form-label col-sm-4" for="">Poster File</label>
                    <div class="col-sm-8">

                        <div class="custom-file" id="result_div">
                            <input class="form-control" id="fileupload" name="file" placeholder="Select Poster" type="file">
                            <label class="custom-file-label" for="fileupload">Select Photo</label>

                        </div>
                        @error('file')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for=""> Description</label>
                    <div class="col-sm-8">
                        <input class="form-control" placeholder="Enter Description" type="text" name="description" value="{{ old('description') }}">
                        @error('description')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ URL::previous() }}"><button type="button" class="btn btn-default float-right ml-3">Cancel</button></a>
                <button class="btn btn-primary float-right" type="submit"> Submit</button>
            </div>
        </form>

    </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(function() {

        $('#fileupload').on('change', function(e) {
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>
@endsection