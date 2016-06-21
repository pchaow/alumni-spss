@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="/admin/">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li class="active">ภาวะการมีงานทำ</li>

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

$branchs = DB::select($sql);
$arrbranchs = collect($branchs)->toArray();

?>
<form action="/admin/stats/work_status" method="get">
    <input type="hidden" name="view" value="query">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> ภาวะการมีงานทำ ตามสาขาวิชา ตามช่วงปีการศึกษาที่จบ
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">

            <table  class="table table-bordered table-hover table-striped">
                <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <h5><u>ขั้นตอนที่ 1</u></h5>
                            <label>เลือกสาขาวิชา</label>
                            <select name="branch" id="branch" class="form-control input-sm"  >
                                <option value="">ทุกสาขาวิชา</option>
                                @foreach ($arrbranchs as $key=>$value)
                                <option value="<?php echo $value->branch;?>"><?php echo $value->branch;?></option>
                                @endforeach
                            </select>


                        </div>

                    </td>

                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <h5><u>ขั้นตอนที่ 2</u></h5>
                            <label>เลือกปีการศึกษาที่จบ (เริ่มต้น) </label>
                                <select required name="yearGradStart" id="yearGradStart" class="form-control input-sm"  >
                                    <option value="">เลือกปีการศึกษาที่จบ</option>
                                    @foreach ($arryearOfGraduation as $key=>$value)
                                        <option value="<?php echo $value->yearOfGraduation;?>"><?php echo $value->yearOfGraduation;?></option>
                                    @endforeach
                                </select>


                        </div>

                    </td>

                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <h5><u>ขั้นตอนที่ 3</u></h5>
                            <label>เลือกปีการศึกษาที่จบ (สิ้นสุด)</label>
                                <select required name="yearGradEnd" id="yearGradEnd" class="form-control input-sm"  >
                                </select>

                        </div>
                    </td>
                </tr>
                <!--
                  <tr>
                    <td>
                  <a href="/admin/stats/degree">- ตามระดับการศึกษา เรียงปีการศึกษา</a>
                  </td>
                  </tr>
                  <tr>
                    <td>
                  <a href="/admin/stats/branch">- ตามสาขาวิชา เลือกการศึกษา</a>
                  </td>
                  </tr>
                  <tr>
                    <td>
                  <a href="/admin/stats/yearofgraduation">- ตามปีการศึกษา เรียงสาขาวิชา</a>
                  </td>
                  </tr>
        -->



                </tbody>
            </table>

            <button type="submit" value="submit" class="btn btn-success">ดูรายงานสถิติ</button>
            <button type="reset" value="Reset" class="btn btn-default">รีเซต</button>
        </div>
    </div>
</form>

<?php if($_GET['view']=="query"){
?>
@include('admin.panels.work_status')
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
