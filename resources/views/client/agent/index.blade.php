@extends('layouts.admin')
@section('content')
<div class="row" style="width: 90%;">
    <div class="col-sm-12">
        <div class="element-wrapper">
            <h6 class="element-header">
                Clients
            </h6>
            <div class="element-box-tp">
                <!--------------------
                      START - Controls Above Table
                      -------------------->
                <div class="controls-above-table">
                    <div class="row">
                        <div class="col-sm-6">
                            <a class="btn btn-sm btn-secondary" href="{{ route('admin.clients.create')}}">Add Client</a>
                            <!-- <a class="btn btn-sm btn-secondary" href="#">Archive</a>
                            <a class="btn btn-sm btn-danger" href="#">Delete</a> -->
                        </div>
                        <!-- <div class="col-sm-6">
                            <form class="form-inline justify-content-sm-end">
                                <input class="form-control form-control-sm rounded bright" placeholder="Search" type="text"><select class="form-control form-control-sm rounded bright">
                                    <option selected="selected" value="">
                                        Select Status
                                    </option>
                                    <option value="Pending">
                                        Pending
                                    </option>
                                    <option value="Active">
                                        Active
                                    </option>
                                    <option value="Cancelled">
                                        Cancelled
                                    </option>
                                </select>
                            </form>
                        </div> -->
                    </div>
                </div>
                <!--------------------
                      END - Controls Above Table
                      ------------------          -->
                <!--------------------
                      START - Table with actions
                      ------------------  -->
                <div class="table-responsive">
                    <table class="table table-bordered table-lg table-v2 table-striped">
                        <thead>
                            <tr>

                                <th>
                                    Client Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Phone
                                </th>
                                <th>
                                    Verified
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($clients)
                            @foreach($clients as $client)
                            <tr>

                                <td>
                                    {{ $client->name }}
                                </td>
                                <td>
                                    {{ $client->email }}
                                </td>
                                <td>
                                    {{ $client->phone }}
                                </td>
                                <td>
                                    {{ $client->verified_at }}
                                </td>
                                <td class="text-center">
                                    @if($client->status == 'active')
                                    <div class="status-pill green" data-title="Complete" data-toggle="tooltip"></div>
                                    @else
                                    <div class="status-pill red" data-title="Cancelled" data-toggle="tooltip"></div>
                                    @endif
                                </td>
                                <td class="row-actions">
                                    <a href="#"><i class="os-icon os-icon-ui-49"></i></a><a href="#"><i class="os-icon os-icon-grid-10"></i></a><a class="danger" href="#"><i class="os-icon os-icon-ui-15"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan='6'>No Clients Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                <!--------------------
                      END - Table with actions
                      ------------------            -->
                <!--------------------
                      START - Controls below table
                      ------------------  -->
                <!-- <div class="controls-below-table">
                    <div class="table-records-info">
                        Showing records 1 - 5
                    </div>
                    <div class="table-records-pages">
                        <ul>
                            <li>
                                <a href="#">Previous</a>
                            </li>
                            <li>
                                <a class="current" href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <!--------------------
                      END - Controls below table
                      -------------------->
            </div>
        </div>
    </div>
</div>

@endsection