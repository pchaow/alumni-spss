@extends('admin.layout')
@section('content')

  <ol class="breadcrumb">
    <li><a href="../">หน้าหลัก</a></li>
    <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
    <li class="active">จำนวนบัณฑิต ตามสาขาวิชา ตามช่วงปีการศึกษาที่จบ</li>
  </ol>

@include('admin.panels.degree_by_year')

@endsection
