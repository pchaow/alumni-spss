@extends('admin.layout')
@section('content')
<?php
$yearGradStart = $_GET['yearGradStart'];
$yearGradEnd = $_GET['yearGradEnd'];
$branch = $_GET['branch'];
?>
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li><a href="/admin/stats/work_status_by_branch_year_menu">ภาวะการมีงานทำ</a></li>
  <li class="active">ภาวะการมีงานทำ ตามสาขาวิชา ตามช่วงปีการศึกษาที่จบ</li>
</ol>


@include('admin.panels.work_status_by_branch_year')

@endsection
