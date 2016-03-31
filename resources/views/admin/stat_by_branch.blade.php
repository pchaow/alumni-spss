@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">Home</a></li>
  <li><a href="/admin/stats">Statistics</a></li>
  <li><a href="../admin/stat_by_graduates">สถิติจำนวนบัณฑิต</a></li>
    <li class="active">ตามสาขาวิชา</li>
</ol>

@include('admin.panels.count_by_branch')

@endsection
