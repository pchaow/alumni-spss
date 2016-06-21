@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li class="active">จำนวนบัณฑิต ตามสาขาวิชา ตามช่วงปีการศึกษาที่จบ</li>
</ol>

<?php
$sql = "SELECT  distinct yearOfGraduation
FROM alumni
order by yearOfGraduation ASC";

$yearOfGraduation = DB::select($sql);
$arryearOfGraduation = collect($yearOfGraduation)->toArray();

?>
<!--<form action="/admin/stats/degree_by_year_show" method="get">-->
<form role="form" action="/admin/stats/graduates" method="get">
<div class="panel panel-success">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> จำนวนบัณฑิต ตามสาขาวิชา ตามช่วงปีการศึกษาที่จบ
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

     <table  class="table table-bordered table-hover table-striped">
      <tbody>
        <tr>
          <td>
              <div class="form-group">
                  <h5><u>ขั้นตอนที่ 1</u></h5>
                  <label>เลือกปีการศึกษาที่จบ (เริ่มต้น)
                      <select required name="yearGradStart" id="yearGradStart" class="form-control input-sm"  >
                          <option value="">เลือกปีการศึกษาที่จบ</option>
                          @foreach ($arryearOfGraduation as $key=>$value)

                          <option value="<?php echo $value->yearOfGraduation;?>"><?php echo $value->yearOfGraduation;?></option>
                          @endforeach
                      </select>
                  </label>

              </div>

              <input type="hidden" name="view" value="query">

        </td>

        </tr>
        <tr>
            <td>
                <div class="form-group">
                    <h5><u>ขั้นตอนที่ 2</u></h5>
                    <label>เลือกปีการศึกษาที่จบ (สิ้นสุด)
                        <select required name="yearGradEnd" id="yearGradEnd" class="form-control input-sm"  >
                        </select>
                    </label>
                </div>
            </td>
            </tr>

      </tbody>
  </table>

    <button type="submit" value="submit" class="btn btn-success">ดูรายงานสถิติ</button>
    <button type="reset" value="Reset" class="btn btn-default">รีเซต</button>
    </div>
    </div>

</form>

<?php if($_GET['view']=="query"){
?>
   @include('admin.panels.graduates');
<?php } ?>

<script>
    $('#yearGradStart').on('change',function(e){
        //console.log(e);
        var yearGrad = e.target.value;
        //ajax
        $.get('../../ajax-yearGrad?yearGrad='+yearGrad, function(data){
            //success data
            //console.log(data);
            $('#yearGradEnd').empty();
           // $('#yearGradEnd').append('<option value="">เลือกปีการศึกษาที่จบ</option>');
            $.each(data, function (index, years) {
                //console.log(years.yearofgraduation);
                $('#yearGradEnd').append('<option value="'+years.yearofgraduation+'">'+years.yearofgraduation+'</option>');

            });
        });
    });


    </script>
@endsection
