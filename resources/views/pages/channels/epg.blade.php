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
                                <h5 class="m-b-10">{{$channel[0]->display_name_am}} Channel EPG</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
            <div class="col-xl-9 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-3 bg-c-red user-profile-side">
                            <div class="card-body text-center text-white">
                                <div class="m-b-25">
                                    <img src="{{ "data:image/" . $channel[0]->channel_logo . ";base64," . $channel[0]->channel_logo }}" class="img-radius img-fluid w-50" alt="User-Profile-Image">
                                </div>
                                <h6 class="f-w-600 text-white">Some Useful Information</h6>
                                <p>Goes Here...</p>
                                <div class="col-md-12 col-xl-12">
                                    <div class="card bg-c-yellow order-card">
                                        <div class="card-body">
                                            <h6 class="text-white">Next date to fill is:</h6>
                                            <h3 class="text-white">{{ $nextFillabelDate }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="card-body">
                                <!--/* for textarea */-->
                                <form class="form-elments1" action="javascript:;" method="post">
                                    <div class="form-group" id="total">

                                        <textarea class="lined" rows="36"></textarea>

                                    </div>

                                    <input type="hidden" name="channel_id" id="channel_id" value="{{$channel[0]->channel_id}}">
                                    <input type="hidden" name="uploaded-prog-date" id="uploaded-prog-date" value="{{ $nextFillabelDate }}">

                                    <button type="button" class="btn  btn-success btn-sm" id="pnotify-success" style="display: none"><i class="feather icon-bell"></i> Click here!</button>
                                    <button type="button" class="btn btn-outline-primary btn-block waves-effect" id="check-prog-list">Check for Correction</button>
                                    <button type="button" class="btn btn-outline-success btn-block waves-effect" id="send-prog-list-to-db" disabled>Accept & Send to Database</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card task-card ">
                    <div class="card-header">
                        <h5>Programs for the last 7 days</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled task-list">
                            <li>
                                <i class="feather icon-check f-w-600 task-icon bg-c-green"></i>
                                <p class="m-b-5">{{ $prev7Days[0] }}</p>
                                <h6 class="text-muted">Call to customer <span class="text-c-blue"> <a href="#!" data-toggle="modal" data-title="Death" data-target="#programList" class="text-c-blue">Jacob</a> </span> and discuss the</h6>
                            </li>
                            <li>
                                <i class="task-icon bg-c-blue"></i>
                                <p class="m-b-5">{{ $prev7Days[1] }}</p>
                                <h6 class="text-muted">Design mobile Application</h6>
                            </li>
                            <li>
                                <i class="task-icon bg-c-red"></i>
                                <p class="m-b-5">{{ $prev7Days[2] }}</p>
                                <h6 class="text-muted"><span class="text-c-blue"><a href="#!" class="text-c-blue">Jeny</a></span> assign you a task <span class="text-c-blue"><a href="#!" class="text-c-blue">Mockup Design.</a></span></h6>
                            </li>
                            <li>
                                <i class="task-icon bg-c-yellow"></i>
                                <p class="m-b-5">{{ $prev7Days[3] }}</p>
                                <h6 class="text-muted mb-3">Design logo</h6>
                            </li>
                            <li>
                                <i class="task-icon bg-c-blue"></i>
                                <p class="m-b-5">{{ $prev7Days[4] }}</p>
                                <h6 class="text-muted mb-3">Design logo</h6>
                            </li>
                            <li>
                                <i class="task-icon bg-c-yellow"></i>
                                <p class="m-b-5">{{ $prev7Days[5] }}</p>
                                <h6 class="text-muted mb-3">Design logo</h6>
                            </li>
                            <li>
                                <i class="task-icon bg-c-green"></i>
                                <p class="m-b-5">{{ $prev7Days[6] }}</p>
                                <h6 class="text-muted mb-3">Design logo</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    <div id="programSuccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Check Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0" id="programSuccessModalText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <div id="programError" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Check Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0" id="programErrorModalText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <div id="programList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Check Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="card task-board-left">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-top-0">
                                        <div class="float-right">231.65</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-bitcoin text-c-yellow"></i> Bitcoin </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">113.05</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-cloudsmith text-c-green"></i>DASH </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">341.22</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-ethereum text-c-red"></i>Litecoin </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">241.68</div>
                                        <div class="d-flex align-items-center"><i class="f-24 m-r-10 fab fa-asymmetrik text-c-blue"></i>NEO</div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">231.65</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-bitcoin text-c-yellow"></i> ANC </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">113.05</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-cloudsmith text-c-green"></i>ARK </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">341.22</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-ethereum text-c-red"></i>BTA </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">241.68</div>
                                        <div class="d-flex align-items-center"><i class="f-24 m-r-10 fab fa-asymmetrik text-c-blue"></i>ETH</div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">113.05</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-cloudsmith text-c-green"></i>NEO </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">341.22</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-ethereum text-c-red"></i>XMR </div>
                                    </li>
                                    <li class="list-group-item border-bottom-0">
                                        <div class="float-right">241.68</div>
                                        <div class="d-flex align-items-center"><i class="f-24 m-r-10 fab fa-asymmetrik text-c-blue"></i>XRP</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="card task-board-left">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-top-0">
                                        <div class="float-right">231.65</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-bitcoin text-c-yellow"></i> Bitcoin </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">113.05</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-cloudsmith text-c-green"></i>DASH </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">341.22</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-ethereum text-c-red"></i>Litecoin </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">241.68</div>
                                        <div class="d-flex align-items-center"><i class="f-24 m-r-10 fab fa-asymmetrik text-c-blue"></i>NEO</div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">231.65</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-bitcoin text-c-yellow"></i> ANC </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">113.05</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-cloudsmith text-c-green"></i>ARK </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">341.22</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-ethereum text-c-red"></i>BTA </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">241.68</div>
                                        <div class="d-flex align-items-center"><i class="f-24 m-r-10 fab fa-asymmetrik text-c-blue"></i>ETH</div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">113.05</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-cloudsmith text-c-green"></i>NEO </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-right">341.22</div>
                                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab fa-ethereum text-c-red"></i>XMR </div>
                                    </li>
                                    <li class="list-group-item border-bottom-0">
                                        <div class="float-right">241.68</div>
                                        <div class="d-flex align-items-center"><i class="f-24 m-r-10 fab fa-asymmetrik text-c-blue"></i>XRP</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>

                $(function() {
                    $(".lined").linedtextarea(
                        {
                        }
                    );
                });

        </script>
        <script type="text/javascript" src="{{ asset('js/jquery-linedtextarea/jquery-linedtextarea.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/channels.js') }}"></script>
    @endpush
    <!-- [ Main Content ] end -->
@stop
