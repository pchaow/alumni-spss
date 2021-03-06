<?php
$yearGradStart = $_GET['yearGradStart'];
$yearGradEnd = $_GET['yearGradEnd'];
$branch = $_GET['branch'];

if($branch){
    $sql = "SELECT `alumni`.`yearofgraduation`,`alumni`.`branch`,
`questionnaires`.`QuestionWorkplaceWorkType` as `workplacetype`
,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
where branch = '$branch'
and
yearofgraduation BETWEEN $yearGradStart AND  $yearGradEnd
AND questionworkstatus in ('ทำงานแล้ว' ,'ทำงานแล้วและกำลังศึกษาต่อ')
group by questionworkplaceworktype,yearofgraduation" ;

}else{
    $sql = "SELECT `alumni`.`yearofgraduation`,
`questionnaires`.`QuestionWorkplaceWorkType` as `workplacetype`
,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
and
yearofgraduation BETWEEN $yearGradStart AND  $yearGradEnd
AND questionworkstatus in ('ทำงานแล้ว' ,'ทำงานแล้วและกำลังศึกษาต่อ')
group by questionworkplaceworktype,yearofgraduation" ;
}


$result = DB::select($sql);
//dd($result);
//$degreeGroup = collect($result)->groupBy('degree');
//$array = $degreeGroup->toArray();
$WorkTypeGroup = collect($result)->groupBy('workplacetype');
$YearsWkGroup = collect($result)->groupBy('yearofgraduation');
$arrYeargroup=[];
foreach ($YearsWkGroup as $key => $value) {
    $arrYeargroup[]=$key;
}

if($branch){
$sql = "SELECT  `alumni`.`yearofgraduation`,`questionnaires`.`questionworkplaceworktype` as 'workplacetype', `questionnaires`.`QuestionWorkplaceWorkPosition` as `workposition`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
where branch = '$branch'
and
yearofgraduation BETWEEN $yearGradStart AND  $yearGradEnd
AND questionworkstatus in ('ทำงานแล้ว' ,'ทำงานแล้วและกำลังศึกษาต่อ')
group by workplacetype,QuestionWorkplaceWorkPosition,yearofgraduation
";}
        else{
            $sql = "SELECT  `alumni`.`yearofgraduation`,`questionnaires`.`questionworkplaceworktype` as 'workplacetype', `questionnaires`.`QuestionWorkplaceWorkPosition` as `workposition`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
and
yearofgraduation BETWEEN $yearGradStart AND  $yearGradEnd
AND questionworkstatus in ('ทำงานแล้ว' ,'ทำงานแล้วและกำลังศึกษาต่อ')
group by workplacetype,QuestionWorkplaceWorkPosition,yearofgraduation
";

}

$result = DB::select($sql);
//dd($result);
//$degreeGroup = collect($result)->groupBy('degree');
//$array = $degreeGroup->toArray();
$YearsGroup = collect($result)->groupBy('yearofgraduation');
//dd($YearsGroup);

$arrValueofgraduates=[];
//dd($WorkTypeGroup);
foreach ($WorkTypeGroup as $key=>$value) {
$valueofgraduates = new stdClass();
$valueofgraduates->name=$key;
//dd($value);
//$valueofgraduates->name=$value->yearOfGraduation;
$arrValueofgrad=[];
$i=0;
foreach ($arrYeargroup as $year) {

    foreach ($value as $key) {

        if($key->yearofgraduation==$year){
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
?>
<?php if(!$branch){$branch = "(ทุกสาขาวิชา)";} ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ประเภทงานของบัณฑิตสาขาวิชา {{$branch}} ภายใน 1 ปี หลังสำเร็จการศึกษา ปีการศึกษาที่จบ
        <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_workplace_type_graph_panel" style="height: 500px;">
            <script>
            $(function () {
            $('#count_by_workplace_type_graph_panel').highcharts({
            chart: {
            type: 'column'
            },
            title: {
            text: 'ประเภทงานของบัณฑิตสาขาวิชา {{$branch}} ภายใน 1 ปี หลังสำเร็จการศึกษา ปีการศึกษาที่จบ <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?>'
            },

            xAxis: {
            categories: <?php echo json_encode($arrYeargroup);?>,
            title: {
            text: null
            }
            },
            yAxis: {
            min: 0,
            title: {
            text: 'จำนวนบัณฑิต (คน)',
            align: 'high'
            },
            labels: {
            overflow: 'justify'
            }
            },
            tooltip: {
            valueSuffix: ' คน'
            },
            plotOptions: {
            column: {
            dataLabels: {
            enabled: true
            }
            }
            },
            legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: false,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
            },
            credits: {
            enabled: false
            },
            series: <?php echo json_encode($arrValueofgraduates);?>
            });
            });
            </script>

        </div>
    </div>
</div>


        <h3>ประเภทงานของบัณฑิตสาขาวิชา <u>{{$branch}}</u> ภายใน 1 ปี หลังสำเร็จการศึกษา
            ปีการศึกษาที่จบ <u><?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?></u></h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีการศึกษาที่จบ</th>

                <th>ประเภทงาน</th>
                <th>จำนวนบัณฑิต(คน)</th>
                <th>อัตราส่วน(%)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($YearsWkGroup as $key => $value)
                <?php
                $firstRow = true;
                $sum = 0;
                $sumforpercentage = 0;
                ?>

                @foreach($value as $subValue)
                    <?php $sumforpercentage = $sumforpercentage + $subValue->amount;?>
                @endforeach

                @foreach($value as $subValue)
                    <tr>
                        <?php $sum = $sum + $subValue->amount; ?>
                        @if($firstRow)
                            <td rowspan="{{count($value)}}">{{$key}}</td>
                        @endif

                        <td>{{$subValue->workplacetype}}</td>
                        <td>{{$subValue->amount}}</td>
                            <td><?php
                                printf("%.2f",($subValue->amount/$sumforpercentage*100));?>
                            </td>
                    </tr>
                    <?php
                    $firstRow = false;
                    ?>
                @endforeach

                <tr class="success">
                    <td colspan="2" style="text-align: right">รวม</td>
                    <td>{{$sum}}</td>
                    <td><?php echo "100%"?></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h3>ตำแหน่งงานของบัณฑิตสาขาวิชา <u>{{$branch}}</u> ภายใน 1 ปี หลังสำเร็จการศึกษา ปีการศึกษาที่จบ <u><?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?></u></h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีการศึกษาที่จบ</th>
                <th>ประเภทงาน</th>
                <th>ตำแหน่งงาน</th>
                <th>จำนวนบัณฑิต(คน)</th>
                <th>อัตราส่วน(%)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($YearsGroup as $key => $value)
                <?php
                $firstRow = true;
                $sum = 0;
                $sumforpercentage = 0;
                ?>

                @foreach($value as $subValue)
                    <?php $sumforpercentage = $sumforpercentage + $subValue->amount;?>
                @endforeach

                @foreach($value as $subValue)
                    <tr>
                        <?php $sum = $sum + $subValue->amount; ?>
                        @if($firstRow)
                            <td rowspan="{{count($value)}}">{{$key}}</td>
                        @endif

                            <td>{{$subValue->workplacetype}}</td>
                            <td>{{$subValue->workposition}}</td>
                        <td>{{$subValue->amount}}</td>
                            <td><?php
                                printf("%.2f",($subValue->amount/$sumforpercentage*100));?>
                            </td>
                    </tr>
                    <?php
                    $firstRow = false;
                    ?>
                @endforeach

                <tr class="success">
                    <td colspan="3" style="text-align: right">รวม</td>
                    <td>{{$sum}}</td>
                    <td><?php echo "100%"?></td>
                </tr>
            @endforeach
            </tbody>
        </table>

