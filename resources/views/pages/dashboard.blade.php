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
                <div class="col-xl-10 col-md-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Channels Information</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
{{--                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>--}}
{{--                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>--}}
{{--                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table nowrap" style="color: white;font-weight: bold">
                                        <thead>
                                        <tr>
                                            <th>Channel</th>
                                            <th>Last filled date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($channels as $channel)
                                            <tr class="{{$channel->className}}">
                                                <td>{{$channel->display_name_am}}</td>
                                                <td>{{$channel->last_filled_date}}</td>
                                                <td>
                                                    <form action="{{route('epg.show',$channel->channel_id)}}">
                                                        <button type="submit" class="btn btn-secondary btn-sm" >Fill programs</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- liveline-section end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    @push('scripts')
        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/pages/data-basic-custom.js"></script>
    @endpush
    <!-- [ Main Content ] end -->
@stop
