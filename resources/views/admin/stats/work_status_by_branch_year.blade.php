@extends('admin.layout')
@section('content')
<?php
$branch = $_GET['branch'];
$year = $_GET['yearofgraduation'];
 ?>
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li><a href="/admin/stats/work_status_by_branch_year_menu">ภาวะการมีงานทำ</a></li>
  <li class="active">สาขาวิชา{{$branch}} ปีที่จบการศึกษา {{$year}}</li>
</ol>


@include('admin.panels.work_status_by_branch_year')

@endsection
