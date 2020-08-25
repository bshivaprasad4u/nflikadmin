@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Privacy Settings</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <form method="post" class="form-horizontal" action="{{ route('client.contents.change_privacy',$content->id )}}">
            @method('POST')
            @csrf
            <div class="card-body">
                <?php
                if ($content->privacy_settings) {
                    $privacy_settings = json_decode($content->privacy_settings);
                    $comments = $privacy_settings->Allow_Comments;
                    $ratings = $privacy_settings->Allow_Ratings;
                    $child = $privacy_settings->Allow_Child;
                    $origins = $privacy_settings->Restricted_Origins;
                } else {
                    $comments = 'no';
                    $ratings = 'no';
                    $child = 'no';
                    $origins = '';
                }

                ?>

                <div id="privacy_settings_div">
                    <div class="form-group row required">
                        <label class="col-form-label col-sm-4" for="">Allow Comments</label>
                        <div class="col-sm-8">
                            <label><input type="radio" name="comments" value="yes" {{ ($comments == "yes")? "checked" : "" }}> Yes</label>
                            <label><input type="radio" name="comments" value="no" {{ ($comments == "no")? "checked" : "" }}> No</label>
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label class="col-form-label col-sm-4" for="">Allow Ratings</label>
                        <div class="col-sm-8">
                            <label><input type="radio" name="ratings" value="yes" {{ ($ratings == "yes")? "checked" : "" }}> Yes</label>
                            <label><input type="radio" name="ratings" value="no" {{ ($ratings == "no")? "checked" : "" }}> No</label>
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label class="col-form-label col-sm-4" for="">Allow Child</label>
                        <div class="col-sm-8">
                            <label><input type="radio" name="child" value="yes" {{ ($child=="yes")? "checked" : "" }}> Yes</label>
                            <label><input type="radio" name="child" value="no" {{ ($child=="no")? "checked" : "" }}> No</label>
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label class="col-form-label col-sm-4" for="">Restricted Origins</label>
                        <div class="col-sm-8">
                            <select class="select2" name="origins[]" multiple="multiple" data-placeholder="Select Countries to restrict access" style="width: 100%;">
                                @foreach($countries as $country)
                                @if(is_array($origins) && in_array($country, $origins))
                                <option value="{{ $country }}" selected="true">{{ $country }}</option>
                                @else
                                <option value="{{ $country }}">{{ $country }}</option>
                                @endif
                                @endforeach
                            </select>

                            @error('name')
                            <div class="alert-custome">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('client.contents.view',$content->id) }}"><button type="button" class="btn btn-default float-right ml-3">Cancel</button></a>
                <button class="btn btn-primary float-right" type="submit"> Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection
@section('script')
<script src="{{ asset('adminlte/tags/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('adminlte/select2/js/select2.js') }}"></script>
<script>
    $(function() {
        // console.log(<?php echo json_encode($countries); ?>);
        $('.select2').select2();
    });
</script>
@endsection