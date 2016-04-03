@extends('admin.layout')
@section('content')
<?php
$branch = $_GET['branch'];
$year = $_GET['yearofgraduation'];
 ?>
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li><a href="/admin/stat_workplace_type_menu">ประเภทงานบัณฑิต</a></li>
  <li class="active">สาขาวิชา{{$branch}} ปีที่จบการศึกษา {{$year}}</li>
</ol>


@include('admin.panels.count_by_workplace_type')

@endsection
