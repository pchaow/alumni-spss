@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li class="active">สถานะการทำงาน</li>
</ol>

<?php
$sql = "SELECT  distinct yearOfGraduation
FROM alumni
order by yearOfGraduation ASC";

$yearOfGraduation = DB::select($sql);
$arryearOfGraduation = collect($yearOfGraduation)->toArray();

$sql = "SELECT  distinct branch
FROM alumni
order by branch ASC";

$branch = DB::select($sql);
$arrBranch = collect($branch)->toArray();


?>



  <div class="panel panel-primary">
      <div class="panel-heading">
          <i class="fa fa-bolt"></i> Quick Access
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">

      <div class="row"><a href="#byyear">-ปีที่จบการศึกษา</a>
      </div>
      <div class="row">  <a href="#bybranch">-สาขาวิชา</a>
        </div>
      </div>

</div>
<h4><u>สถิติสถานะการทำงาน</u></h4>
<div class="panel panel-success"  id="byyear" >
    <div class="panel-heading">
        <i class="fa fa-calendar"></i> ปีที่จบการศึกษา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <div class="row">
    <table  class="table table-bordered table-hover table-striped">
      <tbody>
        @foreach ($arryearOfGraduation as $key=>$value)
          <tr>
            <td>
          <a href="/admin/stat_work_status_by_year?year=<?php echo $value->yearOfGraduation;?>">- <?php echo $value->yearOfGraduation;?></a>
        </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div></div></div>

<div class="panel panel-warning" id="bybranch">
    <div class="panel-heading">
        <i class="fa fa-users"></i> สาขาวิชา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <div class="row" >
     <table  class="table table-bordered table-hover table-striped">
      <tbody>
        @foreach ($arrBranch as $key=>$value)
          <tr>
            <td>
          <a href="/admin/stat_work_status_by_branch?branch=<?php echo $value->branch;?>">- <?php echo $value->branch;?></a>
        </td>
          </tr>
        @endforeach
</div>

</div>
</div>


@endsection
