@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">Home</a></li>
  <li><a href="/admin/stats">Statistics</a></li>
  <li class="active">สถิติภาวะการมีงานทำ</li>
</ol>
@include('admin.panels.count_by_work_status')
@endsection
