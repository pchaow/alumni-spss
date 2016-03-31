@extends('admin.layout')

@section('css')
    <link href="/assets/css/search_custom.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li class="active">รายการสถิติ</li>
</ol>

    <div class="row">
        <div class="col-lg-12">
          <h2>รายการสถิติ</h2>
          <a href="/admin/stat_by_graduates">- สถิติจำนวนบัณฑิต</a>
          <br>
          <a href="/admin/stat_work_status">- สถิติสถานะการมีงานทำ</a>
          <br>
          <a href="/admin/stat_work_direct_branch">- สถิติการทำงานตรงสายงาน</a>
        </div>

    </div>
@endsection
