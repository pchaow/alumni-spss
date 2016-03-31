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
group by alumni.branch, questionnaires.questionworkstatus
"  ;

$result = DB::select($sql);
//dd($result);
$sql = "SELECT  distinct questionnaires.QuestionWorkStatus
FROM questionnaires
order by QuestionWorkStatus DESC";

$workStatusTypes = DB::select($sql);
$arrWorkStatusTypes = collect($workStatusTypes)->toArray();
//dd($arrWorkStatusTypes);

$sql = "SELECT  distinct yearOfGraduation
FROM alumni
order by yearOfGraduation ASC";

$yearOfGraduation = DB::select($sql);
$arryearOfGraduation = collect($yearOfGraduation)->toArray();
//dd($arryearOfGraduation);

$yearGradGroup = collect($result)->groupBy('yearGrad');
//dd($yearGradGroup);

$branchYear = collect($result)->groupBy('branch');
//dd($branchYear);

$array = $branchYear->toArray();

//$yearsofgrad=[];
$arrAmount=[];
foreach ($array as $key => $value) {
    //$yearsofgrad[] = $key;
    //dd($value);
        //แต่ละอันในสาขา
    foreach ($value as $subKey => $subValue) {

      foreach ($arryearOfGraduation as $keyYear => $YearValue) {
        if($subValue == $YearValue){

        }else{
               //= null;
        }
      }
        //ดูปี ดูประเภท
        //dd($subValue);
      }

    }

//print_r($yearsofgrad);





$arrResult = [];
foreach ($arrWorkStatusTypes as $key => $value) {
  $obj = new stdClass();
  $obj->name = $value->QuestionWorkStatus;
  $obj->data = $arrAmount;
  $arrResult[] = $obj;
}
//dd($arrResult);


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
        <i class="fa fa-bar-chart-o fa-fw"></i> แผนภูมิสรุปภาวะการมีงานทำของบัณฑิตแยกตามสาขาวิชา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_work_status_graph_panel" style="height: 500px;"></div>

        <script>
            var arryearOfGraduation = <?php echo json_encode($arryearOfGraduation); ?>;
            //['ss', 'Bananas', 'Oranges'];

            $(function () {
                $('#count_by_work_status_graph_panel').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Stacked column chart'
                    },
                    xAxis: {
                        categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Total fruit consumption'
                        }
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                        shared: true
                    },
                    plotOptions: {
                        column: {
                            stacking: 'percent'
                        }
                    },
                    series: [{
                        name: 'John',
                        data: [5, 3, 4, 7, 2]
                    }, {
                        name: 'Jane',
                        data: [2, 2, 3, 2, 1]
                    }, {
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
