@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $page_title ?? ''}}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <div class="card-body p-0">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table id="example2" class="projects table table-bordered table-hover" data-toggle="dataTable" data-form="deleteForm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Content</th>
                            <th>Publish</th>
                            <th>Go Live</th>
                            <th>Monetize</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($contents)
                        @foreach($contents as $content)
                        <tr>
                            <td>{{ $content->name }}</td>
                            <td>{{ $content->content_link ? 'Uploaded' : 'Not Uploaded'}}</td>
                            <td>@if($content->publish == 'yes')
                                <span class="badge badge-success">Published</span>
                                @else
                                <span class="badge badge-info"> Not Verified</span>
                                @endif
                            </td>
                            <td>
                                @if($content->go_live_status == 'yes')
                                <span class="badge badge-success">Live</span>
                                @else
                                <span class="badge badge-info"> Not in Live</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($content->monetize == 'yes')
                                <span class="badge badge-success"> Yes</span>
                                @else
                                <span class="badge badge-info"> No</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($content->status == 'active')
                                <span class="badge badge-success"> Active</span>
                                @else
                                <span class="badge badge-info"> Inactive</span>
                                @endif
                            </td>
                            <td class="project-actions text-right">
                                <!-- <a class="btn btn-info btn-sm" href="">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a> -->
                                <a class="btn btn-primary btn-sm" href="{{ route('client.contents.view',$content->id) }}">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                <!-- <a class="btn btn-danger btn-sm form-delete" " href=" javascript:void(0)">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a> -->

                            </td>
                        </tr>
                        @endforeach
                        <!-- @else
                                <tr>
                                    <td colspan="4" align="center"> No Records Found</td>
                                </tr>
                                @endif -->
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

@endsection
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    "orderable": false
                },
            ],
            "info": false,
            "autoWidth": false,
        });
        $(".alert").delay(4000).slideUp(500, function() {
            $(this).alert('close');
        });
        $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e) {
            e.preventDefault();
            //var $form=$(this);
            var form_id = $(this).attr('id');
            //var $form = $(this).closest("form");
            //cssssconsole.log($form);

            $('#confirm').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                .on('click', '#delete-btn', function() {
                    $('#delete_modal_' + form_id).submit();
                });
        });
    });
</script>