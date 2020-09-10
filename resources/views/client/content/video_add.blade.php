<div id="fileupload_success">
    <form method="post" id="video_form" class="form-horizontal" action="{{route('client.contents.video_store', $content->id)}}" enctype="multipart/form-data">
        <div class="card-body">
            @method('POST')
            @csrf
            <input type="hidden" name="content_id" value="{{$content->id}}">

            <div class="form-group row">
                <label class="col-form-label col-sm-4" for="">Video File</label>
                <div class="col-sm-8">
                    <div class="custom-file" id="result_div">
                        <input type="file" name="videofile" require class="custom-file-input file-upload" id="fileupload" data-link="{{route('client.contents.video_store', $content->id)}}">
                        <label class="custom-file-label" for="fileupload">Select Video</label>
                        <div id="error" class="alert-custome"></div>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">&nbsp;</div>
                        </div>
                        
                    </div>

                    </br>

                    @error('videofile')
                    <div class="alert-custome">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </form>
</div>
@section('script')

<!-- <script src="{{ asset('adminlte/video/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('adminlte/video/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('adminlte/video/js/jquery.fileupload.js') }}"></script> -->
<script src="{{ asset('adminlte/plugins/fileUpload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
<!-- <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.fileupload-process.js') }}"></script> -->
<script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.fileupload-video.js') }}"></script>
<script>
    $(function() {

        $('#fileupload').on('change', function(e) {
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('.file-upload').each(function() {
            var $this = $(this);
            var $parent = $(this).parent();
            $(this).fileupload({
                //limitMultiFileUploads: 1,
                //maxChunkSize: 10000000, // 10 mb
                dataType: 'json',
                formData: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                start: function (e) {
                    $('#error').text('uploading please wait......');
                },
                done: function(e, data) {
                    $('#fileupload_success').html(data.result.file);
                    location.reload();
                    // $('#loading').text('');
                    $('.progress-bar').hide().css(
                        'width',
                        '0%'
                    );
                },
                fail:function(e,data){
                    $('#error').html(data.jqXHR.responseJSON.data.messages.videofile);
                    $('.progress-bar').hide().css(
                                    'width',
                                    '0%'
                                );
                }
            }).on('fileuploadprogress', function(e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                //console.log(progress);
                $('.progress-bar').show().css(
                    'width',
                    progress + '%'
                );
            });
        });
    });
</script>
@endsection