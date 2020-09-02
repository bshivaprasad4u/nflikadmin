@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Channel Details</h3>

            <div class="card-tools">
                <a class="btn btn-primary btn-sm" href="{{ route('client.channel.edit',$channel->id)}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <label class="col-form-label col-sm-4" for="">Name</label>
                <div class="col-sm-8">
                    {{ ($channel->name)??'Not Available' }}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">Banner Image</label>
                <div class="col-sm-8">
                    {{ ($channel->banner_image)??'Not Available'}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">Watermark</label>
                <div class="col-sm-8">
                    {{ ($channel->watermark)??'Not Available'}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for=""> Facebook Page Link</label>
                <div class="col-sm-8">
                    {{ ($channel->channel_FBpage)??'Not Available'}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for=""> Twitter Page Link</label>
                <div class="col-sm-8">
                    {{ ($channel->channel_Twitterpage)??'Not Available'}}
                </div>
            </div>


            <div class="row">
                <label class="col-form-label col-sm-4" for="">Instagram Page Link</label>
                <div class="col-sm-8">
                    {{ ($channel->channel_Instagrampage)??'Not Available'}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">Subdomain</label>
                <div class="col-sm-8">
                    {{ ($channel->subdomain)??'Not Available'}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for=""> Description</label>
                <div class="col-sm-8">
                    {{ ($channel->description)??'Not Available'}}
                </div>
            </div>



        </div>

    </div>






    </div>
</section>
@endsection