@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li><a href="/admin/stats/graduates">จำนวนบัณฑิต</a></li>
    <li class="active">ตามระดับการศึกษา</li>
</ol>

@include('admin.panels.degree')

@endsection
