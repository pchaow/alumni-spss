@extends('admin.layout')
@section('content')
<?php
$year = $_GET['year'];
?>
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li><a href="../admin/stat_work_direct_branch">สถิติการทำงานตรงสายงาน</a></li>
  <li class="active">ปีการศึกษา{{$year}}</li>
</ol>

@include('admin.panels.count_by_work_direct_branch_by_year')

@endsection
