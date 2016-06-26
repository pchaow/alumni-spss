<?php
$yearGradStart = $_GET['yearGradStart'];
$yearGradEnd = $_GET['yearGradEnd'];
$branch = $_GET['branch'];
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

    $sqlwkdirectextend = "SELECT `alumni`.`yearofgraduation`,`alumni`.`branch`,
`questionnaires`.`questionworkplacedirectbranch` as `workdirectbranch`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
where branch = '$branch'
and
`questionnaires`.`questionworkstatus` in ('ทำงานแล้ว' ,'ทำงานแล้วและกำลังศึกษาต่อ')
and
yearofgraduation between $yearGradStart and '$yearGradEnd'

group by workdirectbranch,yearofgraduation";

} else {
    $sqlwkdirect = "SELECT `alumni`.`yearofgraduation`,`questionnaires`.`questionworkstatus` as `workstatus`,
`questionnaires`.`questionworkplacedirectbranch` as `workdirectbranch`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
and
yearofgraduation between $yearGradStart and '$yearGradEnd'

group by workstatus,workdirectbranch,yearofgraduation";

    $sqlwkdirectextend = "SELECT `alumni`.`yearofgraduation`,
`questionnaires`.`questionworkplacedirectbranch` as `workdirectbranch`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
and
`questionnaires`.`questionworkstatus` in ('ทำงานแล้ว' ,'ทำงานแล้วและกำลังศึกษาต่อ')
and
yearofgraduation between $yearGradStart and '$yearGradEnd'

group by workdirectbranch,yearofgraduation";

    $sqlwkstatus = "SELECT `alumni`.`yearofgraduation`,`questionnaires`.`questionworkstatus` as `workstatus`,
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

$resultwkdirectextend = DB::select($sqlwkdirectextend);

$arrvalueofworkstatus = [];
$arrofworkstatus = [];
$WorkStatusGroup = collect($resultwkstatus)->groupBy('workstatus');
$yearGradWorkstatusGroup = collect($resultwkdirect)->groupBy('yearofgraduation');

$wkdirectentend = collect($resultwkdirectextend)->groupBy('workdirectbranch');

//dd($wkdirectentend);

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


        $masterarray = [];
//dd($wkdirectentend);
foreach ($wkdirectentend as $key => $value) {
   // dd($wkdirectentend);
    $valueofgraduates = new stdClass();
    if($key==null){
        $key = "ไม่ระบุ";
    }
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
    $masterarray[] = $valueofgraduates;

}

//dd($masterarray);

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
            </div>



<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ทำงานตรงสาย/ไม่ตรงสาย ภาวะการมีงานทำของบัณฑิตสาขาวิชา<?php echo $branch;?> ปีการศึกษาที่จบ
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
        <div id="work_direct_branch" style="height: 500px;"></div>
        <script>

            $(function () {
                $('#work_direct_branch').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'ทำงานตรงสาย/ไม่ตรงสาย ภาวะการมีงานทำของบัณฑิตสาขาวิชา<?php echo $branch;?> ปีการศึกษาที่จบ <?php if ($yearGradStart == $yearGradEnd) {
                            echo $yearGradStart;
                        } else {
                            echo $yearGradStart;
                            echo " ถึง ";
                            echo $yearGradEnd;
                        } ?>'
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
                            text: 'จำนวนบัณฑิต(คน)',
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
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: <?php echo json_encode($masterarray);?>,
                });
            });
        </script>
    </div>
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
            <th>อัตราส่วน(%)</th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0; ?>
        ​@foreach($yearGradWorkstatusGroup as $key => $value)
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
                    <?php $sum = $sum + $subValue->amount;
                    $total = $total + $subValue->amount;?>
                    @if($firstRow)
                        <td rowspan="{{count($value)}}">{{$key}}</td>
                    @endif
                    <td>{{$subValue->workstatus}}</td>
                    <td><?php if(($subValue->workstatus=="ทำงานแล้ว"||$subValue->workstatus=="ทำงานแล้วและกำลังศึกษาต่อ")&&($subValue->workdirectbranch==null)){
                            echo "ไม่ระบุ";
                        }else{
                            echo $subValue->workdirectbranch;
                        }
                        ?></td>
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
        <tr>
            <td colspan="3" style="text-align: right">รวมทั้งหมด</td>

            <td>{{$total}}</td>
        </tr>
        </tbody>
    </table>

