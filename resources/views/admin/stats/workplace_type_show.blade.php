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
  <li><a href="/admin/stats/workplace_type">ประเภทงานบัณฑิต</a></li>
  <li class="active">สาขาวิชา{{$branch}} ปีการศึกษาที่จบ {{$yearGradStart}} ถึง {{$yearGradEnd}}</li>
</ol>


@include('admin.panels.workplace_type')

@endsection
