<?php

$sql = "SELECT `alumni`.`degree` as `degree`,
`alumni`.`branch`,
count(*) as `amount`
FROM `alumni`
where yearofgraduation=$year
group by `alumni`.`branch`" ;

$result = DB::select($sql);

//$degreeGroup = collect($result)->groupBy('degree');
//$array = $degreeGroup->toArray();
$masterarray = [];
$subarray = [];
$arrvalueofdegree = [];
$arrofdegree = [];
$degreeGradGroup = collect($result)->groupBy('degree');
//dd($degreeGradGroup);

$i=0;
foreach ($degreeGradGroup as $key=>$value) {


  $sum=0;
   $arrofdegree[]=$key;
   $valueofdegree = new stdClass();
    $valueofdegree->name = $key;
   $arrofbranch=[];
   $arrofbranchamount=[];

    $vdegree = new stdClass();
    $vdegree->name = $key;
    $vdegree->id = $key;

   foreach ($value as $subkey => $subvalue) {

     $arrofbranch[]=$subvalue->branch;
     $arrofbranchamount[]=$subvalue->amount;
     $sum=$sum+$subvalue->amount;

       $vbranch[] = $subvalue->branch;
       $vbranch[] = $subvalue->amount;
       $groupvbranch[] = $vbranch;
       $vbranch = [];
   }

    $vdegree->data = $groupvbranch;
    $groupvbranch = [];


  $valueofdegree->y=$sum;

    $degree = new stdClass();
    $degree->name = $key;
    $degree->y=$sum;
    $degree->drilldown=$key;
    $masterarray[] =  $degree;
  //$valueofdegree->color=$cs[$i];
  $valueofbranch = new stdClass();
  $valueofbranch->name=$key;
  $valueofbranch->categories=$arrofbranch;
  $valueofbranch->data=$arrofbranchamount;
  //$valueofbranch->color=$cs[$i]

 $valueofdegree->drilldown=$valueofbranch;
 $i++;
    $subarray[] = $vdegree;
 $arrvalueofdegree[] = $valueofdegree;
}
//dd($subarray);
//dd($valueofbranch);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> จำนวนบัณฑิตที่จบปีการศึกษา <?php  echo $year;?> ตามสาขาวิชา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_year_graph_panel" style="height: 500px;"></div>

        <script>
            $(function () {
                // Create the chart
                $('#count_by_year_graph_panel').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Browser market shares. January, 2015 to May, 2015'
                    },
                    subtitle: {
                        text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Total percent market share'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                //format: '{point.y:.1f}%'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                    },

                    series: [{
                        name: 'Brands',
                        colorByPoint: true,
                        data: <?php echo json_encode($masterarray);?>
                    }],
                    drilldown: {
                        series: <?php echo json_encode($subarray);?>
                    }
                });
            });
        </script>
        <h3>จำนวนบัณฑิตที่จบปีการศึกษา <?php  echo $year;?> แยกตามระดับการศึกษาและสาขาวิชา</h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ระดับการศึกษา</th>
                <th>สาขาวิชา</th>
                <th>จำนวนบัณฑิต(คน)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($degreeGradGroup as $key => $value)
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
</div>