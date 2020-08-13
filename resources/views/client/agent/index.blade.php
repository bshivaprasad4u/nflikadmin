@extends('layouts.app')
@section('content')
<section class="content">
    <div class="card card-info">
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
                            <th>Agent Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <!-- <th>Verified</th> -->
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($agents as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <!-- <td>
                                @if($client->email_verified_at)
                                <span class="badge badge-success">Verified</span>
                                @else
                                <span class="badge badge-info"> Not Verified</span>
                                @endif
                            </td> -->
                            <td class="text-center">
                                @if($client->status == 'active')
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
                                <a class="btn btn-primary btn-sm">
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
                        @empty
                        <tr>
                            <td colspan="6" align="center"> No Agents Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
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
                // null,
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
@endsection