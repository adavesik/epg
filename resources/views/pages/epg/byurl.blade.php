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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-success btn-sm btn-round has-ripple"  onclick="event.preventDefault();addEpgUrlForm();" data-toggle="modal" data-target="#modal-report">
                                        <i class="feather icon-plus"></i> Add Channel and EPG URL</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div id="report-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="report-table" class="table table-bordered table-striped mb-0 dataTable no-footer" role="grid" aria-describedby="report-table_info">
                                                <thead>
                                                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="report-table" rowspan="1" colspan="1" style="width: 70.35px;" aria-sort="ascending" aria-label="Icon: activate to sort column descending">Icon</th>
                                                    <th class="sorting" tabindex="0" aria-controls="report-table" rowspan="1" colspan="1" style="width: 165.2px;" aria-label="Name: activate to sort column ascending">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="report-table" rowspan="1" colspan="1" style="width: 165.2px;" aria-label="Channel ID: activate to sort column ascending">Channel's Original ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="report-table" rowspan="1" colspan="1" style="width: 747.5px;" aria-label="Description: activate to sort column ascending" width="50%">URL</th>
                                                    <th class="sorting" tabindex="0" aria-controls="report-table" rowspan="1" colspan="1" style="width: 426.95px;" aria-label="Options: activate to sort column ascending">Options</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($channels as $channel)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        <img src="{{ "data:image/" . $channel->channel_logo . ";base64," . $channel->channel_logo }}" class="img-fluid w-50">
                                                    </td>
                                                    <td>{{ $channel->display_name_am }}</td>
                                                    <td>{{ $channel->channel_orig_id }}</td>
                                                    <td><a href="{{ $channel->epg_url }}">{{ $channel->epg_url }}</a></td>
                                                    <td>
                                                        <button onclick="event.preventDefault();fetchEpgByUrl({{$channel->id}});" type="button" class="btn btn-primary btn-sm" name="btn_fetchUrl" id="btn-fetchUrl" data-url="{{ $channel->epg_url }}"><i class="feather icon-plus"></i>Get EPG XML file</button>
                                                        <button onclick="event.preventDefault();editEpgUrlForm({{$channel->id}});" type="button" class="btn btn-info btn-sm" value=""><i class="feather icon-edit"></i> Edit </button>
                                                        <button onclick="event.preventDefault();deleteEpgUrlForm({{$channel->id}});" type="button" class="btn btn-danger btn-sm" value=""><i class="feather icon-trash-2"></i> Delete</button>
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
                    </div>
                </div>
                <!-- liveline-section end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    @include('pages.epg.partials.epgurl_add')
    @include('pages.epg.partials.epgurl_delete')
    @include('pages.epg.partials.epgurl_edit')

    @push('scripts')
        <script type="text/javascript" src="{{ asset('js/channels.js') }}"></script>
    @endpush
    <!-- [ Main Content ] end -->
@stop
