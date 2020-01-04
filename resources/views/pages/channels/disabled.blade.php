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
                                <h5 class="m-b-10">Channels</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row justify-content-center">
                <!-- liveline-section start -->
                @foreach($channels as $channel)
                <div class="col-sm-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ "data:image/" . $channel->channel_logo . ";base64," . $channel->channel_logo }}" alt="" class="img-fluid w-50">
                            <a href="{{url('channel/'.$channel->channel_id)}}"><h5 class="mt-3">{{ $channel->display_name_am }}</h5></a>
                            <hr>
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6 text-left">
                                    <button onclick="event.preventDefault();enableChannelForm({{$channel->id}});" type="button" class="btn  btn-icon btn-outline-success"><i class="feather icon-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- liveline-section end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    @include('pages.channels.partials.channel_enable')

    @push('scripts')
        <script type="text/javascript" src="{{ asset('js/channels.js') }}"></script>
        @endpush
    <!-- [ Main Content ] end -->
@stop
