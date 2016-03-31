@extends('admin.layout')

@section('css')
    <link href="/assets/css/search_custom.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">Home</a></li>
  <li class="active">Statistics</li>
</ol>

    <div class="row">
        <div class="col-lg-12">
          <h2>สถิติ</h2>
          <a href="/admin/stat_by_graduates">- สถิติจำนวนบัณฑิต</a>
          <br>
          <a href="/admin/stat_by_work_status">- สถิติภาวะการมีงานทำ</a>
        </div>

    </div>
@endsection
