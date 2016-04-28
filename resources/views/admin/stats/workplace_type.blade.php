
@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li><a href="/admin/stats/workplace_type">ประเภทงานบัณฑิต</a></li>
    <li class="active">เลือกสาขาวิชา และปีที่จบการศึกษา</li>
</ol>

<form action="/admin/stats/workplace_type_show" method="get">

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
                      <select required name="degree" id="degree" class="form-control input-sm" >
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
                    <select required name="branch" id="branch" class="form-control input-sm" >

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
      </div>
  </div>
</form>
<script>
    $('#degree').on('change',function(e){
        //console.log(e);
        var degree_id = e.target.value;

        //ajax
        $.get('../../ajax-branch?degree_id='+degree_id, function(data){
            //success data
            //console.log(data);
            $('#branch').empty();
            $('#branch').append('<option value="">เลือกสาขาวิชา</option>');
            $.each(data, function (index, branch) {
                console.log(branch.branch);
                $('#branch').append('<option value="'+branch.branch+'">'+branch.branch+'</option>');

            });
        });
    });

    $('#branch').on('change',function(e){
        //console.log(e);
        var branch_id = e.target.value;

        //ajax
        $.get('../../ajax-yeargrad?branch_id='+branch_id, function(data){
            //success data
            //console.log(data);
            $('#yearofgraduation').empty();
            $('#yearofgraduation').append('<option value="">เลือกปีที่จบการศึกษา</option>');
            $.each(data, function (index, yearofgraduation) {

                $('#yearofgraduation').append('<option value="'+yearofgraduation.yearofgraduation+
                        '">'+yearofgraduation.yearofgraduation+'</option>');

            });
        });
    });


</script>

@endsection
