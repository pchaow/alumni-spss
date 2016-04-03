
@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../admin">หน้าหลัก</a></li>
  <li><a href="/admin/stats">รายการสถิติ</a></li>
  <li><a href="/admin/stat_workplace_type_menu">ประเภทงานบัณฑิต</a></li>
    <li class="active">เลือกสาขาวิชา และปีที่จบการศึกษา</li>
</ol>

<form action="/admin/stat_by_workplace_type" method="get">

  <div class="panel panel-primary">
      <div class="panel-heading">
          <i class="fa fa-tasks"></i> เลือกสาขาวิชา และ ปีที่จบการศึกษา
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <table  class="table table-bordered table-hover table-striped">
          <tbody>
            <tr>
            <td>
              <div class="form-group">
                  <label><u><i>ขั้นตอนที่ 1</i></u><br>เลือกระดับการศึกษา
                      <select required name="degree" id="degree" class="form-control input-sm" onChange="getDegree(this.value);" >
                          <option value="">เลือกระดับการศึกษา</option>
                          <option value="ปริญญาตรี">ปริญญาตรี</option>
                          <option value="ปริญญาโท">ปริญญาโท</option>
                          <option value="ปริญญาเอก">ปริญญาเอก</option>
                     </select>
                  </label>
              </div>
    </td>
      </td>
      </tr>
      <tr>
          <td>
            <div class="form-group">
                <label><u><i>ขั้นตอนที่ 2</i></u><br>เลือกสาขาวิชา
                    <select required name="branch" id="branch" class="form-control input-sm" onChange="getBranch(this.value);" >

                   </select>
                </label>
            </div>
  </td>
</tr>
<tr>
  <td>
<div class="form-group">
    <label><u><i>ขั้นตอนที่ 3</i></u><br>เลือกปีที่จบการศึกษา
        <select required name="yearofgraduation" id="yearofgraduation" class="form-control input-sm" >

       </select>
    </label>
</div>
  </td>
</tr>
</tbody>
</table>

<button type="submit" value="submit" class="btn btn-success">ดูสถิติ</button>
<button type="reset" value="Reset" class="btn btn-default">รีเซต</button>
</form>

</div>
</div>
<script>
function getDegree(val) {
	$.ajax({
	type: "post",
	url: "/create/branch-list",
	data:'degree='+val,
	success: function(data){
		$("#branch").html(data);
	}
	});
}
function getBranch(val) {
	$.ajax({
	type: "post",
	url: "/create/yeargrad-list",
	data:'branch='+val,
	success: function(data){
		$("#yearofgraduation").html(data);
	}
	});
}


</script>

@endsection
