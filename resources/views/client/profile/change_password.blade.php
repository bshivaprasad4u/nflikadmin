@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Change Password</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <form method="post" class="form-horizontal" action="{{route('client.change_password')}}">
            <div class="card-body">
                @method('POST')
                @csrf
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label">Current Password</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                        @error('current_password')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label">New Password</label>

                    <div class="col-md-8">
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                        @error('new_password')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label">New Confirm Password</label>

                    <div class="col-md-8">
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                        @error('new_confirm_password')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


            </div>
            <div class="card-footer">
                <a href="{{ URL::previous() }}"><button type="button" class="btn btn-default float-right ml-3">Cancel</button></a>
                <button class="btn btn-primary float-right" type="submit"> Change Password</button>
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