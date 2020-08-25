@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">View Content</h3>

            <div class="card-tools">
                <!-- <a href="{{ route('client.contents.edit',$content->id)}}">Edit</a> -->
                <a class="btn btn-primary btn-sm" href="{{ route('client.contents.edit',$content->id)}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </a>
                <a class="btn btn-danger btn-sm delete-confirm" href="{{route('client.contents.delete',$content->id)}}" data-text="Are you sure? want to Delete this Content and it's related data. ">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <label class="col-form-label col-sm-4" for=""> Category</label>
                <div class="col-sm-8">
                    {{ $content->category->name}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">Name</label>
                <div class="col-sm-8">
                    {{ $content->name}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">Banner Image</label>
                <div class="col-sm-8">
                    {{ $content->banner_image}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for=""> Language</label>
                <div class="col-sm-8">
                    {{ $content->language}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for=""> Genres</label>
                <div class="col-sm-8">
                    {{ $content->genres}}
                </div>
            </div>


            <div class="row">
                <label class="col-form-label col-sm-4" for="">Artist</label>
                <div class="col-sm-8">
                    {{ $content->artist}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">Cast & Crew </label>
                <div class="col-sm-8">
                    {{ $content->castandcrew}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for=""> Tags</label>
                <div class="col-sm-8">

                    <?php $tags = ($content->tags) ? implode(',', json_decode($content->tags)) : 'No Tags Available';
                    ?>
                    {{ $tags}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">Display Tags</label>
                <div class="col-sm-8">
                    <?php $display_tags = ($content->display_tags) ? implode(',', json_decode($content->display_tags)) : 'No Tags Available';
                    ?>
                    {{ $display_tags}}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for=""> Description</label>
                <div class="col-sm-8">
                    {!! $content->description !!}
                </div>
            </div>


        </div>

    </div>
    <!--------- Video Upload start ----->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Video File</h3>

            <div class="card-tools">
                @if($content->publish == 'no' && $content->content_link != '')

                <a class="btn btn-primary btn-sm" href="{{ route('client.contents.publish',$content->id)}}">
                    <i class="fas fa-eye">
                    </i>
                    Publish
                </a>
                @elseif($content->publish == 'yes' && $content->content_link != '')

                <a class="btn btn-danger btn-sm delete-confirm" href="{{ route('client.contents.unpublish',$content->id)}}" data-text="Are you sure? want to Unpublish this content." data-header='Unpublish'>
                    <i class="fas fa-eye-slash">
                    </i>
                    UnPublish
                </a>
                @endif
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>

        <div class="card-body">

            @if($content->content_link == '')
            @include('client.content.video_add')
            @else
            {{ $content->content_link}}
            @endif
            @if($content->publish == 'yes')
            @if($content->channel_content->number_of_slots < 2 ) <span style="color:red">({{$content->channel_content->number_of_slots}}) Slot is using</span>
                @else
                <span style="color:red">({{$content->channel_content->number_of_slots}}) Slots are using</span>
                @endif
                @endif
        </div>



    </div>
    <!--------- Vide upload end ------>
    <!----- settings section start ----->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Privacy Settings</h3>

            <div class="card-tools">

                <a class="btn btn-primary btn-sm" href="{{ route('client.contents.change_privacy',$content->id)}}">
                    <i class="fas fa-cogs">
                    </i>
                    Privacy Settings
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>

        <div class="card-body">
            @if(is_null($content->privacy_settings))
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    No Privacy Settings
                </label>

            </div>
            @else
            <?php $privacy_settings = json_decode($content->privacy_settings); ?>
            @foreach($privacy_settings as $key => $val)
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    <?php $key = str_replace('_', ' ', $key); ?>
                    {{ $key }}
                </label>
                <div class="col-sm-8">
                    <?php if (is_array($val)) $val = implode(',', $val); ?>
                    {{ $val}}
                </div>

            </div>
            @endforeach
            @endif
        </div>



    </div>
    <!----- settings section end --->
    <!----- Teasers section start ----->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Teasers</h3>

            <div class="card-tools">
                <a class="btn btn-primary btn-sm" href="{{ route('client.contents.teaser_add',$content->id)}}">
                    <i class="fas fa-video">
                    </i>
                    Add Teaser
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>

        <div class="card-body">

            @forelse($content->teasers as $teaser)
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    {{ $teaser->name }}
                </label>
                <div class="col-sm-4">
                    @if($teaser->status == 'active')
                    <span class="badge badge-success"> Active</span>
                    @else
                    <span class="badge badge-danger"> Inactive</span>
                    @endif
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-info btn-sm" href="{{route('client.contents.teaser_status',$teaser->id)}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Status
                    </a>
                    <a class="btn btn-danger btn-sm delete-confirm" href="{{route('client.contents.teaser_delete',$teaser->id)}}" data-text="Are you sure? want to Delete this teaser.">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </div>


            </div>
            @empty
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    No Teasers
                </label>

            </div>
            @endforelse
        </div>



    </div>
    <!------- Teasers  section end ---->
    <!------- Poster section start --->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Posters</h3>

            <div class="card-tools">
                <a class="btn btn-primary btn-sm" href="{{ route('client.contents.poster_add',$content->id)}}">
                    <i class="fas fa-images">
                    </i>
                    Add Poster
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>

        <div class="card-body">

            @forelse($content->photos as $poster)
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    {{ $poster->name }}
                </label>
                <div class="col-sm-4">
                    @if($poster->status == 'active')
                    <span class="badge badge-success">
                        Active
                    </span>
                    @else
                    <span class="badge badge-danger">
                        Inactive
                    </span>
                    @endif
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-info btn-sm" href="{{route('client.contents.poster_status',$poster->id)}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Status
                    </a>
                    <a class="btn btn-danger btn-sm delete-confirm" href="{{route('client.contents.poster_delete',$poster->id)}}" data-text="Are you sure? want to Delete this poster.">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </div>

            </div>
            @empty
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    No Posters
                </label>

            </div>
            @endforelse
        </div>



    </div>
    <!------- Poster section end --->
    <!------- Monetize section start ---->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Monetize</h3>
            <div class="card-tools">
                @if($content->monetize == 'no')
                <a class="btn btn-primary btn-sm" href="{{ route('client.contents.monetize_add',$content->id)}}">
                    <i class="fas fa-rupee-sign">
                    </i>
                    Monetize
                </a>
                @else
                <a class="btn btn-primary btn-sm" href="{{ route('client.contents.monetize_edit',$content->contentmonetize->id)}}">
                    <i class="fas fa-rupee-sign">
                    </i>
                    Change Price
                </a>
                @endif
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>

        <div class="card-body">

            @if($content->monetize == 'yes')

            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    Price
                </label>
                <div class="col-sm-8">
                    {{ $content->contentmonetize->price }}
                </div>

            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    Currency
                </label>
                <div class="col-sm-8">
                    {{ $content->contentmonetize->currency }}
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    Gift Coupon
                </label>
                <div class="col-sm-8">
                    {{ $content->contentmonetize->giftcoupon_image }}
                </div>

            </div>
            @else
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    Free Content
                </label>

            </div>
            @endif
        </div>



    </div>
    <!------- Monetize section end ---->




    </div>
</section>
@endsection
@section('deletescript')
<script>
    $(function() {
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            const text = $(this).attr('data-text');
            const unpublish = $(this).attr('data-header');
            if (unpublish != '' && unpublish != undefined) {
                $("#confirm .modal-title").text(unpublish + ' Confirmation');
                $("#confirm #delete-btn").text(unpublish);
            }
            $("#confirm .modal-body").text(text);
            $('#confirm').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                .on('click', '#delete-btn', function() {
                    $('#confirm').modal('hide');
                    window.location.href = url;
                });
        });
    });
</script>
@endsection