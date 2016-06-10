@extends('admin.layout')
@section('content')
<ol class="breadcrumb">
  <li><a href="../">หน้าหลัก</a></li>
  <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
  <li><a href="/admin/stats/work_status_by_branch_year_menu">ภาวะการมีงานทำ</a></li>
    <li class="active">เลือกสาขาวิชา และช่วงปีการศึกษาที่จบ</li>
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
<form action="/admin/stats/work_status_by_branch_year" method="get">

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
                            <label>เลือกสาขาวิชา
                                <select required name="branch" id="branch" class="form-control input-sm"  >
                                    <option value="">เลือกสาขาวิชา</option>
                                    @foreach ($arrbranchs as $key=>$value)
                                        <option value="<?php echo $value->branch;?>"><?php echo $value->branch;?></option>
                                    @endforeach
                                </select>
                            </label>

                        </div>

                    </td>

                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label>เลือกช่วงปีการศึกษาที่จบ (เริ่มต้น)
                                <select required name="yearGradStart" id="yearGradStart" class="form-control input-sm"  >
                                    <option value="">เลือกปีการศึกษาที่จบ</option>
                                    @foreach ($arryearOfGraduation as $key=>$value)
                                        <option value="<?php echo $value->yearOfGraduation;?>"><?php echo $value->yearOfGraduation;?></option>
                                    @endforeach
                                </select>
                            </label>

                        </div>

                    </td>

                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label>เลือกช่วงปีการศึกษาที่จบ (สิ้นสุด)
                                <select required name="yearGradEnd" id="yearGradEnd" class="form-control input-sm"  >
                                </select>
                            </label>
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
                  <a href="/admin/stats/branch">- ตามสาขาวิชา เลือกช่วงการศึกษา</a>
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