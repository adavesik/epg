@extends('layouts.default')
@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    
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
                            <a href="{{url('channel/'.$channel->channel_id)}}">
                            <img src="{{ "data:image/" . $channel->channel_logo . ";base64," . $channel->channel_logo }}" alt="" class="img-fluid w-50">
                            <h5 class="mt-3">{{ $channel->display_name_am }}</h5>
                            </a>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row align-items-center justify-content-around  m-l-0">
                                        <div class="row">
                                            <div class="">
                                                <button onclick="event.preventDefault();deleteChannelForm({{$channel->id}});" type="button" class="btn  btn-icon btn-outline-danger"><i class="feather icon-trash-2"></i></button>
                                            </div>
                                            <div class="">
                                                <div class="col-sm-6 text-left">
                                                    <button onclick="event.preventDefault();editChannelForm({{$channel->id}});" type="button" class="btn  btn-icon btn-outline-success"><i class="feather icon-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <form class="channel-form" data-id="{{$channel->id}}" method="POST" action="{{route('channel.reset',$channel->id)}}">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{$channel->id}}">
                                                <button type="button" onclick="fire('{{$channel->display_name_am}}','{{$channel->id}}')"  class="btn btn-outline-danger">Reset</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-sm-12 text-center">
                    <button type="button" onclick="event.preventDefault();addChannelForm();" class="btn btn-primary" id="create-new-channel" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i>New Channel</button>
                </div>
                <!-- liveline-section end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    @include('pages.channels.partials.channel_add')
    @include('pages.channels.partials.channel_delete')
    @include('pages.channels.partials.channel_edit')

    @push('scripts')
        <script type="text/javascript" src="{{ asset('js/channels.js') }}"></script>
        @endpush
    <!-- [ Main Content ] end -->
@stop
