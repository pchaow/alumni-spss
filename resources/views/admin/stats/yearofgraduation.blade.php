@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li><a href="/admin/stats/graduates">สถิติจำนวนบัณฑิต</a></li>
    <li class="active">ตามปีที่จบการศึกษา</li>
</ol>

@include('admin.panels.yearofgraduation')

@endsection
