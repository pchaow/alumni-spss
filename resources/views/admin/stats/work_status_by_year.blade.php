@extends('admin.layout')
@section('content')
<?php
$year = $_GET['year'];
?>
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li><a href="/admin/stats/work_status">สถานะการทำงาน</a></li>
  <li class="active">ปีการศึกษา {{$year}}</li>
</ol>

@include('admin.panels.work_status_by_year')

@endsection
