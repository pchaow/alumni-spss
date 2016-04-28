@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li><a href="/admin/stats/graduates">จำนวนบัณฑิต</a></li>
  <li class="active">ภาพรวมจำนวนบัณฑิต ตามปีการศึกษา</li>
</ol>

<?php
$sql = "SELECT  distinct yearOfGraduation
FROM alumni
order by yearOfGraduation ASC";

$yearOfGraduation = DB::select($sql);
$arryearOfGraduation = collect($yearOfGraduation)->toArray();

?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-calendar"></i> สถิติภาพรวมจำนวนบัณฑิต ตามปีที่จบการศึกษา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

    <div class="row">
  <table  class="table table-bordered table-hover table-striped">

      <tbody>
        @foreach ($arryearOfGraduation as $key=>$value)
          <tr>
            <td>
          <a href="/admin/stats/degree_by_year_show?year=<?php echo $value->yearOfGraduation;?>">- <?php echo $value->yearOfGraduation;?></a>
        </td>
          </tr>
        @endforeach



      </tbody>
  </table>
</div></div></div>


@endsection
