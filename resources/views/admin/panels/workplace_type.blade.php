
<?php

$sql = "SELECT `alumni`.`yearofgraduation`,`alumni`.`branch`,`questionnaires`.`questionworkstatus` as `workstatus`,
`questionnaires`.`questionworkplacedirectbranch` as `workdirectbranch`, `questionnaires`.`QuestionWorkplaceWorkType` as `workplacetype`
,  `questionnaires`.`QuestionWorkplaceWorkPosition` as `workposition`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
where branch = '$branch'
and
yearofgraduation BETWEEN $yearGradStart AND  $yearGradEnd
AND questionworkstatus in ('ทำงานแล้ว' ,'ทำงานแล้วและกำลังศึกษาต่อ')
group by workstatus,workdirectbranch,questionworkplaceworktype,QuestionWorkplaceWorkPosition,yearofgraduation" ;

$result = DB::select($sql);
//dd($result);
//$degreeGroup = collect($result)->groupBy('degree');
//$array = $degreeGroup->toArray();
$YearsGroup = collect($result)->groupBy('yearofgraduation');
//dd($YearsGroup);

$arrvalueofworkstatus = [];
$arrofworkstatus = [];
$workstatusGroup = collect($result)->groupBy('workstatus');
//dd($workstatusGroup);
//$cs= array("#00CC66", "#CCFF66", "#99FFFF", "pink",'#CCFFCC');
$i=0;
$masterarray = [];
$subarray = [];
foreach ($workstatusGroup as $key=>$value) {

  $sum=0;
  $arrofworkstatus[]=$key;
  $valueofworkstatus = new stdClass();
   $arrofworkplacetype=[];
   $arrofworkplacetypeamount=[];


    $vworkstatus = new stdClass();
    $vworkstatus->name = $key;
    $vworkstatus->id = $key;

   foreach ($value as $subkey => $subvalue) {
     if($subvalue->workplacetype==null){
       $subvalue->workplacetype="ยังไม่ได้ทำงาน";
     }
     $arrofworkplacetype[]=$subvalue->workplacetype;
     $arrofworkplacetypeamount[]=$subvalue->amount;
     $sum=$sum+$subvalue->amount;

       $vworktype[] = $subvalue->workplacetype;
       $vworktype[] = $subvalue->amount;
       $groupvworktype[] = $vworktype;
       $vworktype= [];

   }

    $vworkstatus->data = $groupvworktype;
    $groupvworktype = [];

  $valueofworkstatus->y=$sum;

    $worktype = new stdClass();
    $worktype->name = $key;
    $worktype->y=$sum;
    $worktype->drilldown=$key;
    $masterarray[] =  $worktype;
    $subarray[] = $vworkstatus;

  //$valueofworkstatus->color=$cs[$i];
  $valueofworkplacetype = new stdClass();
  $valueofworkplacetype->name=$key;
  $valueofworkplacetype->categories=$arrofworkplacetype;
  $valueofworkplacetype->data=$arrofworkplacetypeamount;
  //$valueofworkplacetype->color=$cs[$i];

 $valueofworkstatus->drilldown=$valueofworkplacetype;
 $i++;
 $arrvalueofworkstatus[] = $valueofworkstatus;
}
//dd($arrvalueofworkstatus);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ประเภทงานของบัณฑิตสาขาวิชา {{$branch}} ที่จบปีการศึกษา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_workplace_type_graph_panel" style="height: 500px;"></div>

        <script>
            $(function () {
                // Create the chart
                $('#count_by_workplace_type_graph_panel').highcharts({
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
        <h3>ประเภทงานของบัณฑิตสาขาวิชา {{$branch}} </h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีการศึกษาที่จบ</th>
                <th>สถานะการมีงานทำ</th>
                <th>ประเภทงาน</th>
                <th>ตำแหน่งงาน</th>
                <th>จำนวนบัณฑิต(คน)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($YearsGroup as $key => $value)
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
                            <td>{{$subValue->workstatus}}</td>
                        <td>{{$subValue->workplacetype}}</td>
                            <td>{{$subValue->workposition}}</td>
                        <td>{{$subValue->amount}}</td>
                    </tr>
                    <?php
                    $firstRow = false;
                    ?>
                @endforeach

                <tr class="success">
                    <td colspan="4" style="text-align: right">รวม</td>
                    <td>{{$sum}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
