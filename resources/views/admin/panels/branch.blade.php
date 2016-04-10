<?php

$sql = "SELECT  distinct `alumni`.`branch` as `branch`
FROM alumni
order by branch ASC";

$result = DB::select($sql);

$Branchgroup = DB::table('alumni')->select('branch')->distinct()->get();
$Branchgroup = collect($result)->toArray();
$arrBranch=[];
foreach ($Branchgroup as $key => $value) {
  $arrBranch[]=$value->branch;
}

//dd($arrBranch);
//print_r($arrYear);




$sql = "SELECT count(*) as `amount` ,
`alumni`.`branch` as `branch`
, `alumni`.`yearofgraduation` as `yearGrad`
FROM `alumni`
group by `alumni`.`branch`, `alumni`.`yearofgraduation`"  ;

$result = DB::select($sql);

$yearGradGroup = collect($result)->groupBy('yearGrad');
//dd($yearGradGroup);
$branchGradGroup = collect($result)->groupBy('branch');

$array = $yearGradGroup ->toArray();

$arrvalueofgraduates = [];

//dd($branchGradGroup);
foreach ($yearGradGroup as $key=>$value) {
  $valueofgraduates = new stdClass();

  $valueofgraduates->name=$key;
  $arrvalueofgradyear=[];

 //dd($value);
$i=0;
        foreach ($arrBranch as $Branchvalue) {
          foreach ($value as $key) {

          if($key->branch==$Branchvalue){
                 $arrvalueofgradyear[$i] = $key->amount;
                 break;
          }else{
            $arrvalueofgradyear[$i]=0;
          }
          //print_r($arrvalueofgradyear);
      }

      $i++;
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
        <i class="fa fa-bar-chart-o fa-fw"></i> จำนวนบัณฑิตตามสาขาวิชา แยกตามปีที่จบการศึกษา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_branch_graph_panel" style="height: 500px;"></div>

        <script>

            //['ss', 'Bananas', 'Oranges'];

            $(function () {
                $('#count_by_branch_graph_panel').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'จำนวนบัณฑิตตามสาขาวิชา แยกตามปีที่จบการศึกษา'
                    },
                    xAxis: {

                        categories: <?PHP echo json_encode($arrBranch); ?>

                    },
                    yAxis: {
                        title: {
                            text: 'จำนวนบัณฑิต(คน)'
                        }




                    },plotOptions: {  column: {
                dataLabels: {
                    enabled: true
                }
            }
        }
                    ,
                    series: <?PHP echo json_encode($arrvalueofgraduates);?>
                });
            });

        </script>
        <h3>จำนวนบัณฑิตตามสาขาวิชา แยกตามปีที่จบการศึกษา</h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>สาขาวิชา</th>
                <th>ปีที่จบการศึกษา</th>
                <th>จำนวนบัณฑิต(คน)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($branchGradGroup as $key => $value)
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
                        <td>{{$subValue->yearGrad}}</td>
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
