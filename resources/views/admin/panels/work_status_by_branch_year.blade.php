<?php
if ($branch) {
    $sqlwkstatus = "SELECT `alumni`.`yearofgraduation`,`alumni`.`branch`,`questionnaires`.`questionworkstatus` as `workstatus`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
where branch = '$branch'
and
yearofgraduation between $yearGradStart and '$yearGradEnd'

group by workstatus,yearofgraduation";

    $sqlwkdirect = "SELECT `alumni`.`yearofgraduation`,`alumni`.`branch`,`questionnaires`.`questionworkstatus` as `workstatus`,
`questionnaires`.`questionworkplacedirectbranch` as `workdirectbranch`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
where branch = '$branch'
and
yearofgraduation between $yearGradStart and '$yearGradEnd'

group by workstatus,workdirectbranch,yearofgraduation";
} else {
    $sqlwkdirect = "SELECT `alumni`.`yearofgraduation`,`alumni`.`branch`,`questionnaires`.`questionworkstatus` as `workstatus`,
`questionnaires`.`questionworkplacedirectbranch` as `workdirectbranch`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
and
yearofgraduation between $yearGradStart and '$yearGradEnd'

group by workstatus,workdirectbranch,yearofgraduation";

    $sqlwkstatus = "SELECT `alumni`.`yearofgraduation`,`alumni`.`branch`,`questionnaires`.`questionworkstatus` as `workstatus`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
and
yearofgraduation between $yearGradStart and '$yearGradEnd'

group by workstatus,yearofgraduation";

}

$resultwkstatus = DB::select($sqlwkstatus);

$resultwkdirect = DB::select($sqlwkdirect);

//dd($result);
//$degreeGroup = collect($result)->groupBy('degree');
//$array = $degreeGroup->toArray();

$arrvalueofworkstatus = [];
$arrofworkstatus = [];
$WorkStatusGroup = collect($resultwkstatus)->groupBy('workstatus');
$yearGradWorkstatusGroup = collect($resultwkdirect)->groupBy('yearofgraduation');
//dd($YearGradWorkstatusGroup);
//$cs= array("#00CC66", "#CCFF66", "#99FFFF", "pink",'#CCFFCC');

/*$Yeargrad = DB::table('alumni')
        ->select('yearOfGraduation')
        ->distinct()
        ->where('branch', '=', $branch)
        ->orderBy('yearOfGraduation', 'asc')
        ->get();*/
//$yeargrad= collect($result)->toArray();
$arrYeargroup = [];
foreach ($yearGradWorkstatusGroup as $key => $value) {
    $arrYeargroup[] = $key;
}

$arrWorkstgroup = [];
$workstatus = DB::table('questionnaires')
        ->select('questionworkstatus')
        ->distinct()
        ->orderBy('questionworkstatus', 'asc')
        ->get();
$workstatus = collect($workstatus)->toArray();
foreach ($workstatus as $key => $value) {
    $arrWorkstgroup[] = $value->questionworkstatus;
}
//print_r($arrWorkstgroup);



$arrValueofgraduates = [];

foreach ($WorkStatusGroup as $key => $value) {
    $valueofgraduates = new stdClass();
    $valueofgraduates->name = $key;
    //dd($value);
    //$valueofgraduates->name=$value->yearOfGraduation;
    $arrValueofgrad = [];
    $i = 0;
    foreach ($arrYeargroup as $year) {

        foreach ($value as $key) {

            if ($key->yearofgraduation == $year) {
                $arrValueofgrad[$i] = $key->amount;
                break;
            } else {
                $arrValueofgrad[$i] = null;
            }
        }
        $i++;
    }
    $valueofgraduates->data = $arrValueofgrad;
    //
    //var_dump($valueofgraduates);
    $arrValueofgraduates[] = $valueofgraduates;
}
//dd($arrValueofgraduates);




?>
<?php if(!$branch){$branch = "All";} ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ภาวะการมีงานทำของบัณฑิตสาขาวิชา<?php echo $branch;?> ปีการศึกษาที่จบ
        <?php if ($yearGradStart == $yearGradEnd) {
            echo $yearGradStart;
        } else {
            echo $yearGradStart;
            echo " ถึง ";
            echo $yearGradEnd;
        } ?>
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
                        text: 'ภาวะการมีงานทำของบัณฑิตสาขาวิชา<?php echo $branch;?> ปีการศึกษาที่จบ <?php if ($yearGradStart == $yearGradEnd) {
                            echo $yearGradStart;
                        } else {
                            echo $yearGradStart;
                            echo " ถึง ";
                            echo $yearGradEnd;
                        } ?>'
                    },
                    xAxis: {
                        categories: <?php echo json_encode($arrYeargroup);?>
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'จำนวนบัณฑิต(คน)'
                        }
                    },

                    plotOptions: {
                        column: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    }, legend: {
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

    <h3>ภาวะการมีงานทำของบัณฑิตสาขาวิชา <u>{{$branch}}</u> ปีการศึกษาที่จบ
        <u><?php if ($yearGradStart == $yearGradEnd) {
                echo $yearGradStart;
            } else {
                echo $yearGradStart;
                echo " ถึง ";
                echo $yearGradEnd;
            } ?>
        </u></h3>
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr>
            <th>ปีการศึกษาที่จบ</th>
            <th>สถานะการมีงานทำ</th>
            <th>ทำงานตรงสาย</th>
            <th>จำนวนบัณฑิต(คน)</th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0; ?>
        ​@foreach($yearGradWorkstatusGroup as $key => $value)
            <?php
            $firstRow = true;
            $sum = 0;
            ?>
            @foreach($value as $subValue)
                <tr>
                    <?php $sum = $sum + $subValue->amount;
                    $total = $total + $subValue->amount;?>
                    @if($firstRow)
                        <td rowspan="{{count($value)}}">{{$key}}</td>
                    @endif
                    <td>{{$subValue->workstatus}}</td>
                    <td>{{$subValue->workdirectbranch}}</td>
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
        <tr>
            <td colspan="3" style="text-align: right">รวมทั้งหมด</td>

            <td>{{$total}}</td>
        </tr>
        </tbody>
    </table>
</div>
