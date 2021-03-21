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
                                <input type="hidden" class="programs-url" value="{{route('channel.programs',$channel[0]->id)}}">
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
                            @foreach($prev7Days as $day)
                                <li>
                                    <i class="feather icon-check f-w-600 task-icon bg-c-green"></i>
                                    <p class="m-b-5">{{ $day['date'] }}</p>
                                    <h6 class="text-muted">
                                        <span class="text-c-blue w-100 d-flex justify-content-between">
                                            <a href="#!"  data-toggle="modal" data-title="Death" data-target="#programList" data-date="{{$day['date']}}" class="text-c-blue show-programs">{{$day['day']}}</a>
                                            <form action="{{route('channel.delete-from',$channel[0]->id)}}" method="POST" class="delete-from-form" data-id="{{$loop->index}}">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="channel_id" value="{{$channel[0]->id}}">
                                                <input type="hidden" name="start_date" value="{{$day['date']}}">
                                                <a href="#" class="text-c-red" data-id="{{$loop->index}}" onClick="deleteFromDate('{{$loop->index}}','{{$day['date']}}')" >Delete From Here</a>
                                            </form>
                                        </span>
                                    </h6>
                                </li>
                            @endforeach

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
                    <h5 class="modal-title" id="exampleModalLiveLabel">Check Program  <span class="check-date badge badge-success"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="card task-board-left">
                                <ul class="list-group list-group-flush part-1">
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="card task-board-left">
                                <ul class="list-group list-group-flush part-2">
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
        <script type="text/javascript" src="{{ asset('js/epg.js') }}"></script>
    @endpush
    <!-- [ Main Content ] end -->
@stop
