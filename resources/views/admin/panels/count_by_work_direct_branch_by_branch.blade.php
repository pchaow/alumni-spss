<?php
$work_involve_branch = DB::table('questionnaires')
->select('questionworkplacedirectbranch')
->distinct()
->orderBy('questionworkplacedirectbranch', 'asc')
->get();
//$yeargrad= collect($result)->toArray();
$arrWorkInvolveBranchGroup=[];
foreach ($work_involve_branch as $key => $value) {
  $arrWorkInvolveBranchGroup[]=$value->questionworkplacedirectbranch;
}

$sql = "SELECT alumni.yearOfGraduation as yeargrad,
alumni.branch,
questionnaires.questionworkplacedirectbranch as workdirectbranch, count(*) as amount
FROM
alumni
inner join questionnaires
on alumni.id = questionnaires.alumni_id
where alumni.branch='$major' and questionnaires.questionworkplacedirectbranch is not null
group by workdirectbranch, yeargrad
";

$result = DB::select($sql);
$WorkDirectGroup = collect($result)->groupBy('workdirectbranch');
$yearWorkGroup =collect($result)->groupBy('yeargrad');
//dd($result);
//dd($yearWorkGroup);


$Yeargrad = DB::table('alumni')
->select('yearOfGraduation')
->distinct()
->where('branch', '=', $major)
->orderBy('yearOfGraduation', 'asc')
->get();
//$yeargrad= collect($result)->toArray();
$arrYeargroup=[];
foreach ($Yeargrad as $key => $value) {
  $arrYeargroup[]=$value->yearOfGraduation;
}

$arrValueofgraduates=[];

foreach ($WorkDirectGroup as $key=>$value) {
  $valueofgraduates = new stdClass();
  $valueofgraduates->name=$key;
  //dd($value);
  //$valueofgraduates->name=$value->yearOfGraduation;
  $arrValueofgrad=[];
  $i=0;
  foreach ($arrYeargroup as $year) {

    foreach ($value as $key) {

      if($key->yeargrad==$year){
             $arrValueofgrad[$i] = $key->amount;
             break;
      }else{
        $arrValueofgrad[$i]=null;
      }
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
        <i class="fa fa-bar-chart-o fa-fw"></i> สถานะการทำงานตรงสายของบัณฑิตสาขาวิชา<?php echo $major;?> ตามปีที่จบการศึกษา
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
                    text: 'สถานะการทำงานตรงสายของบัณฑิตสาขาวิชา<?php echo $major;?> ตามปีที่จบการศึกษา'
                },
                xAxis: {
                    categories: <?php echo json_encode($arrYeargroup);?>
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'อัตราส่วนสถานะการมีงานทำของบัณฑิต'
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
                series: <?php echo json_encode($arrValueofgraduates);?>
            });
        });

        </script>
         <h3>สถานะการมีงานทำของบัณฑิตสาขาวิชา<?php echo $major;?> ตามปีที่จบการศึกษา</h3>

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>

                <th>ปีที่จบการศึกษา</th>
                <th>สถานะการทำงานตรงสาย</th>
                <th>จำนวนบัณฑิต(คน)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($yearWorkGroup as $key => $value)
                <?php
                $firstRow = true;
                $sum = 0;
                ?>
                @foreach($value as $subValue)
                    <tr>
                        <?php $sum = $sum + $subValue->amount; ?>
                        @if($firstRow)
                            <td rowspan="{{count($value)}}">{{$subValue->yeargrad}}</td>
                        @endif

                        <td>{{$subValue->workdirectbranch}}</td>
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
