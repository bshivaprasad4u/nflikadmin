@extends('layouts.app')
@section('content')
<section class="content">
    <form method="post" class="form-horizontal" action="{{route('client.contents.store')}}" enctype="multipart/form-data">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add Channel</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>

                </div>
            </div>
            <div class="card-body">
                @method('POST')
                @csrf

                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="name" placeholder="Enter Name" type="text" value="{{ old('name') }}">
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
                    <label class="col-form-label col-sm-4" for="">Watermark</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="watermark" name="watermark" type="file">
                                <label class="custom-file-label" for="watermark">Choose file</label>
                            </div>
                        </div>
                        @error('file')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Facebook Page</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="fbpage" placeholder="Enter Facebook page link" type="text" value="{{ old('fbpage') }}">
                        @error('fbpage')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Twitter Page</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="twitterpage" placeholder="Enter Twitter page link" type="text" value="{{ old('twitterpage') }}">
                        @error('twitterpage')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Instagram Page</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="instagrampage" placeholder="Enter Instagram page link" type="text" value="{{ old('instagrampage') }}">
                        @error('instagrampage')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>




                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for=""> Description</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" name="description" placeholder="Enter Description here....">{{ old('description') }}</textarea>
                        @error('description')
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
@section('script')
<script>
    $(function() {

        $('#banner_image').on('change', function(e) {
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        $('#watermark').on('change', function(e) {
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>
@endsection