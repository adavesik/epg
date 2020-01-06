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
                <div class="col-xl-6 col-md-8">
                    <form class="form-elments1" action="{{ url('epg/build') }}" method="get">
                    <div class="card user-card2">
                        <div class="card-body text-center">
                            <h3 class="m-b-15">Total number of active channels</h3>
                            <div class="risk-rate">
                                <span><b>5</b></span>
                            </div>
                            <h6 class="m-b-15">&nbsp;</h6>
                            <a href="{{ route('channels') }}" class="text-c-green b-b-success">View Channels</a>
                            <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Select Date range</h5>
                                        </div>
                                        <div class="card-body">
                                            <input type="text" name="datefilter" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Download Overall EPG's XML file</button>
                    </div>
                    </form>
                </div>
                <!-- liveline-section end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    <!-- [ Main Content ] end -->
@stop
