@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card">
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

                if ($content->privacy_parameters) {

                    $privacy_settings = json_decode($content->privacy_parameters);
                    $comments = $privacy_settings->Allow_Comments;
                    $ratings = $privacy_settings->Allow_Ratings;
                    $child = $privacy_settings->Allow_Child;
                    $origins = implode(',', $privacy_settings->Restricted_Origins);
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
                            <input class="form-control" name="origins" placeholder="Enter Countries to restrict access" type="text" value="{{ (old('origns')) ? old('origins') : $origins }}">
                            @error('name')
                            <div class="alert-custome">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <a href="{{ URL::previous() }}"><button type="button" class="btn btn-default float-right ml-3">Cancel</button></a>
                <button class="btn btn-primary float-right" type="submit"> Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection