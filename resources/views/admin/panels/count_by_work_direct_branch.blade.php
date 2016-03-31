<?php


/*SELECT  alumni.yearOfGraduation as yearGrad, alumni.branch as branch,
questionnaires.QuestionWorkStatus as workstatus, questionnaires.QuestionWorkplaceDirectBranch as workdirectbranch,count(*) as amount
FROM
alumni
inner join questionnaires
on alumni.id = questionnaires.alumni_id
group by yearGrad,alumni.branch, questionnaires.questionworkstatus, questionnaires.QuestionWorkplaceDirectBranch
*/
$sql = "SELECT  alumni.yearOfGraduation as yearGrad, alumni.branch as branch,
questionnaires.QuestionWorkStatus as workstatus, count(*) as amount
FROM
alumni
inner join questionnaires
on alumni.id = questionnaires.alumni_id
group by alumni.branch, questionnaires.questionworkstatus"  ;

$result = DB::select($sql);

$sql = "SELECT  distinct questionnaires.QuestionWorkStatus
FROM questionnaires";

$workStatusTypes = DB::select($sql);
$arrWorkStatusTypes = collect($workStatusTypes)->toArray();


$yearGradGroup = collect($result)->groupBy('yearGrad');
dd($yearGradGroup);

$array = $yearGradGroup->toArray();

$yearsofgrad=[];

foreach ($array as $key => $value) {
    $yearsofgrad[] = $key;
}
//print_r($yearsofgrad);


/*[{
    name: 'John',
    data: [5, 3, 4, 7, 2]
}, {
    name: 'Jane',
    data: [2, 2, 3, 2, 1]
}, {
    name: 'Joe',
    data: [3, 4, 4, 2, 5]
}]
*/

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> แผนภูมิสรุปจำนวนบัณฑิตแยกตามปีที่จบการศึกษา แยกตามสถานะการทำงาน และแยกตามสาขา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_work_direct_branch_graph_panel" style="height: 500px;"></div>

        <script>
            var yearsofgrad = <?php echo json_encode($yearsofgrad); ?>;
            //['ss', 'Bananas', 'Oranges'];


            $(function () {
                $('#count_by_work_direct_branch_graph_panel').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'แผนภูมิสรุปจำนวนบัณฑิตแยกตามปีที่จบการศึกษา แยกตามสถานะการทำงาน และแยกตามสาขา'
                    },
                    xAxis: {
                        categories: yearsofgrad
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'จำนวนบัณฑิต(คน)'
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                            }
                        }
                    },
                    legend: {
                        align: 'right',
                        x: -30,
                        verticalAlign: 'top',
                        y: 25,
                        floating: true,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false
                    },
                    tooltip: {
                        headerFormat: '<b>{point.x}</b><br/>',
                        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true,
                                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                                style: {
                                    textShadow: '0 0 3px black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'John',
                        data: [null, null, null, null, null]
                    }, {
                        name: 'Jane',
                        data: [2, 2, 3, 2, 1]
                    }, {
                        name: 'Joe',
                        data: [3, 4, 4, 2, 5]
                    }
                    ,{
                        name: 'Joe',
                        data: [3, 4, 4, 2, 5]
                    }]
                });
            });



        </script>



        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีที่จบการศึกษา</th>
                <th>สาขาวิชา</th>
                <th>สถานะการทำงาน</th>
                <th>จำนวนบัณฑิต(คน)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($yearGradGroup as $key => $value)
                <?php
                $firstRow = true;
                $sum = 0;
                ?>
                @foreach($value as $subValue)
                    <tr>
                        <?php $sum = $sum + $subValue->amount; ?>
                        @if($firstRow)
                            <td rowspan="{{count($value)}}">{{$key}}</td>
                        @endif
                        <td>{{$subValue->branch}}</td>
                        <td>{{$subValue->workstatus}}</td>
                        <td>{{$subValue->amount}}</td>
                    </tr>
                    <?php
                    $firstRow = false;
                    ?>
                @endforeach

                <tr class="success">
                    <td colspan="3" style="text-align: right">รวม</td>
                    <td>{{$sum}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.panel-body -->
</div>
