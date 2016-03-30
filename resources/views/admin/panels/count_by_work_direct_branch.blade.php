<?php


/*SELECT  alumni.yearOfGraduation as yearGrad, alumni.branch as branch,
questionnaires.QuestionWorkStatus as workstatus, questionnaires.QuestionWorkplaceDirectBranch as workdirectbranch,count(*) as amount
FROM
alumni
inner join questionnaires
on alumni.id = questionnaires.alumni_id
group by yearGrad,alumni.branch, questionnaires.questionworkstatus, questionnaires.QuestionWorkplaceDirectBranch
*/
$sql = "SELECT  alumni.yearOfGraduation as yearGrad, alumni.branch as branch,
questionnaires.QuestionWorkStatus as workstatus, count(*) as amount
FROM
alumni
inner join questionnaires
on alumni.id = questionnaires.alumni_id
group by yearGrad,alumni.branch, questionnaires.questionworkstatus"  ;

$result = DB::select($sql);

$yearGradGroup = collect($result)->groupBy('yearGrad');
//dd($yearGradGroup);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ตารางสรุปจำนวนบัณฑิตแยกตามปีที่จบการศึกษา แยกตามสถานะการทำงาน และแยกตามสาขา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_branch_graph_panel" style="height: 500px;"></div>

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีที่จบการศึกษา</th>
                <th>สาขาวิชา</th>
                <th>สถานะการทำงาน</th>
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
                        <td>{{$subValue->workstatus}}</td>
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
    <!-- /.panel-body -->
</div>
