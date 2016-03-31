@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li><a href="../admin/stat_by_graduates">สถิติจำนวนบัณฑิต</a></li>
    <li class="active">ตามปีที่จบการศึกษา</li>
</ol>

@include('admin.panels.count_by_yearofgraduation')

@endsection
