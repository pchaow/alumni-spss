@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">Home</a></li>
  <li><a href="/admin/stats">Statistics</a></li>
  <li class="active">สถิติจำนวนบัณฑิต</li>
</ol>

<div class="row">
    <div class="col-lg-12">
      <h2>สถิติจำนวนบัณฑิต</h2>
    
      <a href="/admin/stat_by_degree">- ตามระดับการศึกษา</a>
        <br>
      <a href="/admin/stat_by_yearofgraduation">- ตามปีการศึกษา</a>
      <br>
      <a href="/admin/stat_by_branch">- ตามสาขาวิชา</a>
    </div>

</div>


@endsection
