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
                                <h5 class="m-b-10">Categories</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header">
                            <h5>Categories</h5>
                            <div class="card-header-right">
                                <button type="button" class="btn waves-effect waves-light btn-primary m-0" data-toggle="modal" data-target="#addCategoryModal">
                                    New Category
                                </button>
                                @include('pages.categories.partials.category_add')
                            </div>
                        </div>
                        <div class="card-body shadow border-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">Description / Name</th>
                                        <th class="border-top-0">Last Edited</th>
                                        <th class="border-top-0"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <a onclick="event.preventDefault();editCategoryForm({{$category->id}});" href="#" class="text-muted"><i class="feather icon-edit mr-1"></i></a>
                                            <a onclick="event.preventDefault();deleteCategoryForm({{$category->id}});" href="#" class="text-muted"><i class="feather icon-trash-2"></i></a>
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
            <!-- [ Main Content ] end -->
        </div>
    </div>
    </div>

        @include('pages.categories.partials.category_add')
        @include('pages.categories.partials.category_edit')
        @include('pages.categories.partials.category_delete')

    @push('scripts')
        <script type="text/javascript" src="{{ asset('js/categories.js') }}"></script>
    @endpush
    <!-- [ Main Content ] end -->
@stop
