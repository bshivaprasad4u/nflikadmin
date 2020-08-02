@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Monetize</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <form method="post" class="form-horizontal" action="{{route('client.contents.monetize_store', $content->id)}}" enctype="multipart/form-data">
            <div class="card-body">
                @method('POST')
                @csrf
                <input type="hidden" name="content_id" value="{{$content->id}}">
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Price</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="price" placeholder="Enter Price" type="text" value="{{ old('price') }}">
                        @error('price')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row required">
                    <label class="col-form-label col-sm-4" for="">Currency</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="currency">
                            <?php sort($currencies); ?>
                            @foreach($currencies as $currency):
                            <option value="{{$currency}}">
                                {{ ucfirst($currency) }}
                            </option>
                            @endforeach
                        </select>
                        @error('currency')
                        <div class="alert-custome">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-4" for="">Coupon Image</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="coupon_image" name="file" type="file">
                                <label class="custom-file-label" for="exampleInputFile">Choose Coupon Image</label>
                            </div>
                        </div>
                        @error('file')
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

        $('#coupon_image').on('change', function(e) {
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>
@endsection