@extends('admin.layout')
@section('content')
<?php
$major = $_GET['branch'];
?>
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li><a href="/admin/stats/work_direct_branch">ทำงานตรงสายงาน</a></li>
  <li class="active">สาขาวิชา{{$major}}</li>
</ol>

@include('admin.panels.work_direct_branch_by_branch')

@endsection
