@extends('admin.layout')
@section('content')
<?php
$year = $_GET['year'];
?>
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li><a href="/admin/stats/graduates">จำนวนบัณฑิต</a></li>
  <li><a href="/admin/stats/degree_by_year">จำนวนบัณฑิต ตามปีการศึกษา</a></li>
  <li class="active">จำนวนบัณฑิต ปีการศึกษา <?php echo $year;  ?></li>
</ol>

@include('admin.panels.degree_by_year')

@endsection
