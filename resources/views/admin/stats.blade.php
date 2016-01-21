@extends('admin.layout')

@section('css')
    <link href="/assets/css/search_custom.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('admin.panels.summary_by_branch')
            @include('admin.panels.count_by_branch')
            @include('admin.panels.count_by_workplace_province')
            @include('admin.panels.count_by_work_status')
        </div>

    </div>
@endsection