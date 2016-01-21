<?php


$sql = "SELECT count(*) as `amount` , `alumni`.`branch` as `branch`  FROM `alumni` group by `alumni`.`branch`";

$result = DB::select($sql);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ตารางสรุปจำนวนศิษย์เก่าแยกตามสาขา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>สาขา</th>
                <th>จำนวนศิษย์เก่า</th>
            </tr>
            </thead>
            <tbody>
            <?php $sum = 0; ?>
            @foreach($result as $r)
                    <?php $sum = $sum + $r->amount; ?>
                        <tr>
                            <td>{{$r->branch}}</td>
                            <td>{{$r->amount}}</td>
                        </tr>
            @endforeach
                    <tr class="success">
                        <td >รวม</td>
                        <td>{{$sum}}</td>
                    </tr>
            </tbody>
        </table>
    </div>
    <!-- /.panel-body -->
</div>
