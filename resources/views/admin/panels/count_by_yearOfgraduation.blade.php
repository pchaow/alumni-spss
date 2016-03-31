<?php


$sql = "SELECT count(*) as `amount` ,
`alumni`.`branch` as `branch`
, `alumni`.`yearofgraduation` as `yearGrad`
FROM `alumni`
group by `alumni`.`branch`, `alumni`.`yearofgraduation`"  ;

$result = DB::select($sql);

$yearGradGroup = collect($result)->groupBy('yearGrad');
//dd($yearGradGroup);

$array = $yearGradGroup->toArray();

$yearsofgrad=[];

$resultArray1 = [];

foreach ($array as $key => $value) {
$yearsofgrad[] = $key;
    $obj = [];

    foreach ($value as $data) {

        $obj['year'] = $key;
        $obj[$data->branch] = $data->amount;
    }
    $resultArray1[] = $obj;

}

$arrvalueofgraduates = [];

$branchGradGroup = collect($result)->groupBy('branch');
//dd($branchGradGroup);
foreach ($branchGradGroup as $key=>$value) {
  $valueofgraduates = new stdClass();
  $arrvalueofgradyear=[];
//print_r($value);
 $valueofgraduates->name=$key;
 //dd($value);
  foreach ($value as $key) {
    //print_r($key->amount);
    $arrvalueofgradyear[] = $key->amount;
    //print_r($arrvalueofgradyear);
  }
    $valueofgraduates->data=$arrvalueofgradyear;
    //

    //var_dump($valueofgraduates);
    $arrvalueofgraduates[] = $valueofgraduates;
    //dd($arrvalueofgraduates);

}

//dd($arrvalueofgraduates);

/*
series: [{
    name: 'Jane',
    data: [1, 0, 4]
}, {
    name: 'John',
    data: [5, 7, 3]
}]*/

//print_r($yearsofgrad);

//print_r($arrvalueofgraduates);
//dd($resultArray1);


?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> แผนภูมิสรุปจำนวนบัณฑิตตามปีที่จบการศึกษา แยกตามสาขาวิชา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_year_graph_panel" style="height: 500px;"></div>

        <script>
            var yearsofgrad = <?php echo json_encode($yearsofgrad); ?>;
            //['ss', 'Bananas', 'Oranges'];

            $(function () {
                $('#count_by_year_graph_panel').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'แผนภูมิสรุปจำนวนบัณฑิตตามปีที่จบการศึกษา แยกตามสาขาวิชา'
                    },
                    xAxis: {

                        categories: yearsofgrad

                    },
                    yAxis: {
                        title: {
                            text: 'จำนวนบัณฑิต(คน)'
                        }
                    },tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            column: {
                stacking: 'percent'
            }
        },
                    series: <?PHP echo json_encode($arrvalueofgraduates);?>
                });
            });

        </script>

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีที่จบการศึกษา</th>
                <th>สาขาวิชา</th>
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
                        <td>{{$subValue->amount}}</td>
                    </tr>
                    <?php
                    $firstRow = false;
                    ?>
                @endforeach

                <tr class="success">
                    <td colspan="2" style="text-align: right">รวม</td>
                    <td>{{$sum}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.panel-body -->
</div>
