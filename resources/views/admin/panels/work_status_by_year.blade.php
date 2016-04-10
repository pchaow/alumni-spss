<?php

/*SELECT  alumni.yearOfGraduation as yearGrad, alumni.branch as branch,
questionnaires.QuestionWorkStatus as workstatus, questionnaires.QuestionWorkplaceDirectBranch as workdirectbranch,count(*) as amount
FROM
alumni
inner join questionnaires
on alumni.id = questionnaires.alumni_id
group by yearGrad,alumni.branch, questionnaires.questionworkstatus, questionnaires.QuestionWorkplaceDirectBranch
*/

$sql = "SELECT  distinct `alumni`.`branch` as `branch`
FROM alumni
where yearOfGraduation=$year
order by branch ASC";

$result = DB::select($sql);


//$Branchgroup = DB::table('alumni')->select('branch')->distinct()->get();
$Branchgroup = collect($result)->toArray();
$arrBranch=[];
foreach ($Branchgroup as $key => $value) {
  $arrBranch[]=$value->branch;
}
//dd($arrBranch);

$sql = "SELECT alumni.branch as branch,
questionnaires.QuestionWorkStatus as workstatus, count(*) as amount
FROM
alumni
inner join questionnaires
on alumni.id = questionnaires.alumni_id
where alumni.yearOfGraduation=$year
group by alumni.branch, questionnaires.questionworkstatus
";

$result = DB::select($sql);
//dd($result);

$sql = "SELECT  distinct questionnaires.QuestionWorkStatus
FROM questionnaires
order by QuestionWorkStatus DESC";

$workStatusTypes = DB::select($sql);
$arrWorkStatusTypes = collect($workStatusTypes)->toArray();
//dd($arrWorkStatusTypes);
//$yearGradGroup = collect($result)->groupBy('yearGrad');
//dd($yearGradGroup);

$branchGroup = collect($result)->groupBy('branch');
$WorkStatusGroup = collect($result)->groupBy('workstatus');
//dd($WorkStatusGroup);

$array = $branchGroup->toArray();

//$yearsofgrad=[];
$arrValueofgraduates=[];

foreach ($WorkStatusGroup as $key=>$value) {
  $valueofgraduates = new stdClass();
  //dd($value);
  $valueofgraduates->name=$key;
  $arrValueofgrad=[];

   //dd($value);
    $i=0;
        foreach ($arrBranch as $branch) {
          foreach ($value as $key) {

          if($key->branch==$branch){
                 $arrValueofgrad[$i] = $key->amount;
                 break;
          }else{
            $arrValueofgrad[$i]=0;
          }
          //print_r($arrvalueofgradyear);
      }

      $i++;
  }
    $valueofgraduates->data=$arrValueofgrad;
    //
    //var_dump($valueofgraduates);
    $arrValueofgraduates[] = $valueofgraduates;


}
//dd($arrValueofgraduates);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> สถานะการทำงานของบัณฑิตปีที่จบการศึกษา <?php echo $year;?> แยกตามสาขาวิชา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_work_status_graph_panel" style="height: 500px;"></div>

        <script>
        $(function () {
            $('#count_by_work_status_graph_panel').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'สถานะการทำงานของบัณฑิตปีที่จบการศึกษา <?php echo $year;?> แยกตามสาขาวิชา'
                },
                xAxis: {
                    categories: <?php echo json_encode($arrBranch);?>
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'อัตราส่วนสถานะการมีงานทำของบัณฑิต'
                    }
                },plotOptions: {  column: {
                    dataLabels: {
                        enabled: true
                    }
                }
                },
                
                series: <?php echo json_encode($arrValueofgraduates);?>
            });
        });

        </script>


<h3>สถานะการทำงานของบัณฑิตปีที่จบการศึกษา <?php echo $year;?> แยกตามสาขาวิชา</h3>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>

                                <th>สาขาวิชา</th>
                                <th>สถานะการมีงานทำ</th>
                                <th>จำนวนบัณฑิต(คน)</th>
                            </tr>
                            </thead>
                            <tbody>

                            ​@foreach($branchGroup as $key => $value)
                                <?php
                                $firstRow = true;
                                $sum = 0;
                                ?>
                                @foreach($value as $subValue)
                                    <tr>
                                        <?php $sum = $sum + $subValue->amount; ?>
                                        @if($firstRow)
                                            <td rowspan="{{count($value)}}">{{$subValue->branch}}</td>
                                        @endif

                                        <td>{{$subValue->workstatus}}</td>
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
