@extends('admin.layout')
@section('javascript')
    <script src="/js/thai-data.js"></script>

@endsection
@section('content')
    <?php
    "select count(*) as value, province.PROVINCE_NAME,province.PROVINCE_CODE from alumni
JOIN province on province.PROVINCE_NAME = alumni.houseProvince
group by alumni.houseProvince";

    $query = \App\Models\Alumni::query();
    $query->select([
            "province.PROVINCE_NAME",
            "province.PROVINCE_CODE",
            DB::raw("count(*) as value")
    ]);
    $query->leftJoin('province', function ($join) {
        $join->on('province.PROVINCE_NAME', '=', 'alumni.houseProvince');
    });
    $query->groupBy("alumni.houseProvince");

    $thaidataJson = $query = $query->get()->toJson();

    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> จำนวนบัณฑิตที่มีภูมิลำเนาในประเทศไทย
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
                            text: 'จำนวนบัณฑิตที่มีภูมิลำเนาในประเทศไทย'
                        },

                        mapNavigation: {
                            enabled: true,
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
                            joinBy: [ 'province_code','PROVINCE_CODE'],
                            dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                format: '{point.value}'
                            },
                        }]
                    });
                });

            </script>

        </div>

@endsection
