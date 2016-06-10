
<?php

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

$result = DB::select($sql);
//dd($result);
//$degreeGroup = collect($result)->groupBy('degree');
//$array = $degreeGroup->toArray();
$YearsWkGroup = collect($result)->groupBy('yearofgraduation');


$sql = "SELECT  `alumni`.`yearofgraduation`,`questionnaires`.`questionworkplaceworktype` as 'workplacetype', `questionnaires`.`QuestionWorkplaceWorkPosition` as `workposition`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
where branch = '$branch'
and
yearofgraduation BETWEEN $yearGradStart AND  $yearGradEnd
AND questionworkstatus in ('ทำงานแล้ว' ,'ทำงานแล้วและกำลังศึกษาต่อ')
group by workplacetype,QuestionWorkplaceWorkPosition,yearofgraduation" ;

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
        $masterarray = [];
$subarray = [];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ประเภทงานของบัณฑิตสาขาวิชา {{$branch}} ปีการศึกษาที่จบ <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_workplace_type_graph_panel" style="height: 500px;"></div>



        <h3>ประเภทงานของบัณฑิตสาขาวิชา {{$branch}} </h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีการศึกษาที่จบ</th>

                <th>ประเภทงาน</th>
                <th>จำนวนบัณฑิต(คน)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($YearsWkGroup as $key => $value)
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

                        <td>{{$subValue->workplacetype}}</td>
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

        <h3>ตำแหน่งงานของบัณฑิตสาขาวิชา {{$branch}} </h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีการศึกษาที่จบ</th>
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

                            <td>{{$subValue->workplacetype}}</td>
                            <td>{{$subValue->workposition}}</td>
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
