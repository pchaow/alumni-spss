@extends('admin.layout')
@section('javascript')
    <script src="/js/thai-data.js"></script>

@endsection
@section('content')
    <?php

    "select count(*),questionnaires.QuestionWorkplaceProvince, province.PROVINCE_CODE from alumni
join questionnaires on alumni.id = questionnaires.alumni_id
left join province on questionnaires.QuestionWorkplaceProvince = province.PROVINCE_NAME
group by questionnaires.QuestionWorkplaceProvince";

    $yearGradStart = $_GET['yearGradStart'];
    $yearGradEnd = $_GET['yearGradEnd'];
    $branch = $_GET['branch'];

    $query = \App\Models\Alumni::query();
    $query->select([
            "questionnaires.QuestionWorkplaceProvince",
            "province.PROVINCE_NAME",
            "province.PROVINCE_CODE",
            DB::raw("count(DISTINCT(alumni.personal_id)) as value")
    ]);
    $query->join('questionnaires', function ($join) {
        $join->on('alumni.id', '=', 'questionnaires.alumni_id');
    });
    $query->leftJoin('province', function ($join) {
        $join->on('province.PROVINCE_NAME', '=', 'questionnaires.QuestionWorkplaceProvince');
    });
    $query->whereRaw("province.PROVINCE_CODE IS NOT NULL");

    if(($branch)&&($branch!="All")){
        $query->where('branch',$branch);
    }
    $query->whereBetween('yearofgraduation', array($yearGradStart, $yearGradEnd));

    $query->groupBy("questionnaires.QuestionWorkplaceProvince");
    $thaidataJson = $query = $query->get()->toJson();

    ?>
    <?php if(!$branch){$branch = "All";} ?>
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="../">หน้าหลัก</a></li>
            <li><a href="/admin/stats/mainmenu">รายการสถิติ</a></li>
            <li class="active">สถานที่ทำงานของบัณฑิตสาขาวิชา {{$branch}} ปีการศึกษาที่จบ
                <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?></li>
        </ol>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> สถานที่ทำงานของบัณฑิตสาขาวิชา {{$branch}} ปีการศึกษาที่จบ
                    <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?>

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="stat_map" style="height: 1000px;"></div>
                    <script>
                        $(function () {
                            // Prepare demo data

                            // Initiate the chart
                            $('#stat_map').highcharts('Map', {

                                title: {
                                    text: 'สถานที่ทำงานของบัณฑิตสาขาวิชา {{$branch}} ปีการศึกษาที่จบ <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?>'
                                },

                                mapNavigation: {
                                    enabled: false,
                                    buttonOptions: {
                                        verticalAlign: 'bottom'
                                    }
                                },

                                colorAxis: {
                                    min: 0
                                },
                                plotOptions: {
                                    series: {
                                        point: {
                                            events: {
                                                click: function () {
                                                    window.location.href =
                                                            "/admin/stats/mapwork?QuestionWorkplaceProvince="+this.PROVINCE_NAME+"&PROVINCE_CODE="+this.PROVINCE_CODE
                                                            +"&branch="+"{{$branch}}"+"&yearGradStart="+"{{$yearGradStart}}"+"&yearGradEnd="+"{{$yearGradEnd}}";

                                                }
                                            }
                                        }
                                    }
                                },


                                series: [{
                                    mapData: Highcharts.maps['countries/th/th-all'],
                                    data: <?php echo $thaidataJson; ?>,
                                    joinBy: ['province_code', 'PROVINCE_CODE'],
                                    dataLabels: {
                                        enabled: true,
                                        color: '#FFFFFF',
                                        format: '{point.value}'
                                    },
                                    name: 'จำนวนนิสิต',
                                    tooltip: {
                                        pointFormat: '{point.PROVINCE_NAME}: {point.value} คน'
                                    }
                                }]
                            });
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Input::has('QuestionWorkplaceProvince'))
        <div class="row">
            <?php
            $query = \App\Models\Alumni::query();

            $questionWorkplaceProvince = \Illuminate\Support\Facades\Input::get('QuestionWorkplaceProvince');
            $provinceCode = \Illuminate\Support\Facades\Input::get('PROVINCE_CODE');

            $query->select([
                    "alumni.*",
                    "questionnaires.QuestionWorkplaceProvince",
                    "questionnaires.QuestionWorkplaceName",
                    "province.PROVINCE_NAME",
                    "province.PROVINCE_CODE",
            ]);
            $query->join('questionnaires', function ($join) {
                $join->on('alumni.id', '=', 'questionnaires.alumni_id');
            });
            $query->leftJoin('province', function ($join) {
                $join->on('province.PROVINCE_NAME', '=', 'questionnaires.QuestionWorkplaceProvince');
            });
            $query->where("province.PROVINCE_NAME", "=", $questionWorkplaceProvince);
            $query->where('branch',$branch);
            $query->whereBetween('yearofgraduation', array($yearGradStart, $yearGradEnd));

            //$query->orderBy("yearOfGraduation","asc");
            $data_alumni = $query->paginate(15);

            $data_alumni->setPath(url("/admin/stats/mapwork?QuestionWorkplaceProvince=$questionWorkplaceProvince&PROVINCE_CODE=$provinceCode"));
            //dd($data_alumni);
            ?>
            <div class="col-lg-12">

                <h3>รายชื่อบัณฑิตสาขาวิชา <u>{{$branch}}</u> ที่ทำงานอยู่ใน <u>{{$questionWorkplaceProvince}}</u> ปีการศึกษาที่จบ <u><?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?>
                    </u></h3>
                <div class="panel panel-success">

                    <div class="panel-heading">
                        <i class="fa fa-file-text-o"></i> ผลลัพธ์การค้นหา
                    </div>
                    <div class="panel-body">

                        <div class="row" style="padding-bottom: 10px;">
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-11" style="text-align: center;">
                                พบข้อมูลทั้งหมดจำนวน {{$data_alumni->total()}} รายการ

                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>สาขาวิชาที่สำเร็จการศึกษา</th>
                                <th>ปีที่จบการศึกษา</th>
                                <th>รหัสนิสิต</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>สถานที่ทำงาน</th>
                                <th>การจัดการ</th>

                            </tr>
                            </thead>
                            <tbody>

                            @if(count($data_alumni) != 0)

                                @foreach ($data_alumni as $r)

                                    <tr>
                                        <td>{{$r["branch"]}}</td>
                                        <td>{{$r["yearOfGraduation"]}}</td>
                                        <td>{{$r["student_id"]}}</td>
                                        <td>{{$r["title"] . ' ' . $r["firstname"] . ' ' . $r["lastname"]}}</td>
                                        <td>{{$r["QuestionWorkplaceName"] }}</td>

                                        <td>
                                            <a type="button" href="/admin/profile/{{$r->id}}" target="_blank"
                                               class="btn btn-primary">ดูข้อมูล</a>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" align="center">ไม่พบข้อมูล</td>
                                </tr>
                            @endif
                            </tbody>

                        </table>
                        <div align="center">{!! $data_alumni->render() !!}</div>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
