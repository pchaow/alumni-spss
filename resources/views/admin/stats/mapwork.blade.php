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
    $query->groupBy("questionnaires.QuestionWorkplaceProvince");

    $thaidataJson = $query = $query->get()->toJson();

    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> จำนวนบัณฑิตที่ทำงานในประเทศไทย
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
                            text: 'จำนวนบัณฑิตที่ทำงานในประเทศไทย'
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

@endsection
