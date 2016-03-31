@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li class="active">สถิติการทำงานตรงสายงาน</li>
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



<div>
<div>
  <h4><u>Quick Access</u></h4>
<a href="#byyear">ปีที่จบการศึกษา</a>
  <br>
  <a href="#bybranch">สาขาวิชา</a>
  <br>
</div>
<div>
<h4><u>สถิติการทำงานตรงสายงาน</u></h4>
</div>
 <div id="byyear">
  <table  class="table table-bordered table-hover table-striped">
      <thead>
      <tr>
          <th><h4>ปีที่จบการศึกษา</h4></th>
      </tr>
      </thead>
      <tbody>
        @foreach ($arryearOfGraduation as $key=>$value)
          <tr>
            <td>
          <a href="/admin/stat_by_work_direct_branch_by_year?year=<?php echo $value->yearOfGraduation;?>">- <?php echo $value->yearOfGraduation;?></a>
        </td>
          </tr>
        @endforeach



      </tbody>
  </table>
</div>

<div id="bybranch">
  <table  class="table table-bordered table-hover table-striped">
      <thead>
      <tr>
          <th><h4>สาขาวิชา</h4></th>
      </tr>
      </thead>
      <tbody>
        @foreach ($arrBranch as $key=>$value)
          <tr>
            <td>
          <a href="/admin/stat_by_work_direct_branch_by_branch?branch=<?php echo $value->branch;?>">- <?php echo $value->branch;?></a>
        </td>
          </tr>
        @endforeach
</div>


</div>


@endsection
