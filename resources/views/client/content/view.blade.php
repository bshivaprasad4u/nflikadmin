@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View Content</h3>

            <div class="card-tools">
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
                <label class="col-form-label col-sm-4" for="">Video File</label>
                <div class="col-sm-8">
                    {{ $content->content_link}}
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
                <label class="col-form-label col-sm-4" for=""> Description</label>
                <div class="col-sm-8">
                    {{ $content->description}}
                </div>
            </div>

        </div>
        <div class="card-footer">

        </div>
    </div>
    <!----- settings section start ----->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Privacy Settings</h3>

            <div class="card-tools">
                <a href="{{ route('client.contents.change_privacy',$content->id)}}">Change Privacy Settings</a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>

        <div class="card-body">
            @if($content->privacy == 'no')
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    No Privacy Settings
                </label>

            </div>
            @else
            <?php $privacy_settings = json_decode($content->privacy_parameters); ?>
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Teasers</h3>

            <div class="card-tools">
                <a href="{{ route('client.contents.teaser_add',$content->id)}}">Add Teaser</a>
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
                <div class="col-sm-8">
                    @if($teaser->status == 'active')
                    <span class="badge badge-success"> Active</span>
                    @else
                    <span class="badge badge-info"> Inactive</span>
                    @endif
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Posters</h3>

            <div class="card-tools">
                <a href="{{ route('client.contents.poster_add',$content->id)}}">Add Poster</a>
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
                <div class="col-sm-8">
                    @if($poster->status == 'active')
                    <span class="badge badge-success"> Active</span>
                    @else
                    <span class="badge badge-info"> Inactive</span>
                    @endif
                </div>

            </div>
            @empty
            <div class="row">
                <label class="col-form-label col-sm-4" for="">
                    No Poster
                </label>

            </div>
            @endforelse
        </div>



    </div>
    <!------- Poster section end --->




    </div>
</section>
@endsection