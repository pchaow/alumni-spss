@extends('admin.layout')
@section('content')
<?php
$major = $_GET['branch'];
?>
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li><a href="../admin/stat_work_status">สถานะการทำงาน</a></li>
  <li class="active">สาขาวิชา{{$major}}</li>
</ol>

@include('admin.panels.count_by_work_status_by_branch')

@endsection
