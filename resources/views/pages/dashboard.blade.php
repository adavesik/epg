@extends('layouts.default')
@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Membership</a></li>
                                <li class="breadcrumb-item"><a href="#!">Coupons</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row justify-content-center">
                <!-- liveline-section start -->
                <div class="col-xl-10 col-md-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Recent Changes and Some Information</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Subject</th>
                                        <th>Department</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><label class="badge badge-light-success">open</label></td>
                                        <td>Website down for one week</td>
                                        <td>Support</td>
                                        <td>Today 2:00</td>
                                    </tr>
                                    <tr>
                                        <td><label class="badge badge-light-primary">progress</label></td>
                                        <td>Loosing control on server</td>
                                        <td>Support</td>
                                        <td>Yesterday</td>
                                    </tr>
                                    <tr>
                                        <td><label class="badge badge-light-danger">closed</label></td>
                                        <td>Authorizations keys</td>
                                        <td>Support</td>
                                        <td>27, Aug</td>
                                    </tr>
                                    <tr>
                                        <td><label class="badge badge-light-success">open</label></td>
                                        <td>Restoring default settings</td>
                                        <td>Support</td>
                                        <td>Today 9:00</td>
                                    </tr>
                                    <tr>
                                        <td><label class="badge badge-light-primary">progress</label></td>
                                        <td>Loosing control on server</td>
                                        <td>Support</td>
                                        <td>Yesterday</td>
                                    </tr>
                                    <tr>
                                        <td><label class="badge badge-light-success">open</label></td>
                                        <td>Restoring default settings</td>
                                        <td>Support</td>
                                        <td>Today 9:00</td>
                                    </tr>
                                    <tr>
                                        <td><label class="badge badge-light-primary">progress</label></td>
                                        <td>Loosing control on server</td>
                                        <td>Support</td>
                                        <td>Yesterday</td>
                                    </tr>
                                    <tr>
                                        <td><label class="badge badge-light-danger">closed</label></td>
                                        <td>Authorizations keys</td>
                                        <td>Support</td>
                                        <td>27, Aug</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- liveline-section end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    <!-- [ Main Content ] end -->
@stop
