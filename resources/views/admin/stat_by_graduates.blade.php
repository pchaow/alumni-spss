@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li class="active">จำนวนบัณฑิต</li>
</ol>


<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> สถิติจำนวนบัณฑิต
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
    <div class="row">
     <table  class="table table-bordered table-hover table-striped">
      <tbody>
        <tr>
          <td>
        <a href="/admin/stat_by_degree_by_year">- ภาพรวมทั้งหมดตามปีการศึกษา</a>
        </td>
        </tr>
          <tr>
            <td>
          <a href="/admin/stat_by_degree">- ตามระดับการศึกษา เรียงปีการศึกษา</a>
          </td>
          </tr>
          <tr>
            <td>
          <a href="/admin/stat_by_branch">- ตามสาขาวิชา เรียงปีการศึกษา</a>
          </td>
          </tr>
          <tr>
            <td>
          <a href="/admin/stat_by_yearofgraduation">- ตามปีการศึกษา เรียงสาขาวิชา</a>
          </td>
          </tr>




      </tbody>
  </table>
</div>
</div>
</div>



@endsection
