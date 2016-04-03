
<?php

$sql = "SELECT `questionnaires`.`questionworkstatus` as `workstatus`,
`questionnaires`.`questionworkplacedirectbranch` as `workdirectbranch`,
count(*) as `amount`
FROM `alumni`
Inner Join questionnaires
on alumni.id = questionnaires.alumni_id
where yearofgraduation=$year and branch='$branch'
group by workstatus,workdirectbranch" ;

$result = DB::select($sql);
//dd($result);
//$degreeGroup = collect($result)->groupBy('degree');
//$array = $degreeGroup->toArray();

$arrvalueofworkstatus = [];
$arrofworkstatus = [];
$workstatusGroup = collect($result)->groupBy('workstatus');
//dd($workstatusGroup);
$cs= array("#00CC66", "#CCFF66", "#99FFFF", "#FFCCFF",'#CCFFCC');
$i=0;
foreach ($workstatusGroup as $key=>$value) {

  $sum=0;
  $arrofworkstatus[]=$key;
  $valueofworkstatus = new stdClass();
   $arrofworkdirectbranch=[];
   $arrofworkdirectbranchamount=[];
   foreach ($value as $subkey => $subvalue) {
     if($subvalue->workdirectbranch==null){
       $subvalue->workdirectbranch="ยังไม่ได้ทำงาน";
     }
     $arrofworkdirectbranch[]=$subvalue->workdirectbranch;
     $arrofworkdirectbranchamount[]=$subvalue->amount;
     $sum=$sum+$subvalue->amount;
   }
  $valueofworkstatus->y=$sum;
  $valueofworkstatus->color=$cs[$i];
  $valueofworkdirectbranch = new stdClass();
  $valueofworkdirectbranch->name=$key;
  $valueofworkdirectbranch->categories=$arrofworkdirectbranch;
  $valueofworkdirectbranch->data=$arrofworkdirectbranchamount;
  $valueofworkdirectbranch->color=$cs[$i];

 $valueofworkstatus->drilldown=$valueofworkdirectbranch;
 $i++;
 $arrvalueofworkstatus[] = $valueofworkstatus;
}
//dd($arrvalueofworkstatus);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ภาวะการมีงานทำของบัณฑิตสาขาวิชา<?php  echo $branch;?> ที่จบปีการศึกษา <?php  echo $year;?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_work_status_branch_year_graph_panel" style="height: 500px;"></div>

        <script>
        $(function () {

      var colors = Highcharts.getOptions().colors,
      categories = <?PHP echo json_encode($arrofworkstatus);?>,
      data = <?PHP echo json_encode($arrvalueofworkstatus);?>,
      browserData = [],
      versionsData = [],
      i,
      j,
      dataLen = data.length,
      drillDataLen,
      brightness;


  // Build the data arrays
  for (i = 0; i < dataLen; i += 1) {

      // add browser data
      browserData.push({
          name: categories[i],
          y: data[i].y,
          color: data[i].color
      });

      // add version data
      drillDataLen = data[i].drilldown.data.length;
      for (j = 0; j < drillDataLen; j += 1) {
          brightness = 0.2 - (j / drillDataLen) / 5;
          versionsData.push({
              name: data[i].drilldown.categories[j],
              y: data[i].drilldown.data[j],
              color: Highcharts.Color(data[i].color).brighten(brightness).get()
          });
      }
  }

  // Create the chart
  $('#count_by_work_status_branch_year_graph_panel').highcharts({
      chart: {
          type: 'pie'
      },
      title: {
          text: "ภาวะการมีงานทำของบัณฑิตสาขาวิชา<?php  echo $branch;?> ที่จบปีการศึกษา <?php  echo $year;?>"
      },
      yAxis: {
          title: {
              text: 'จำนวนบัณฑิต(คน)'
          }
      },
      plotOptions: {
          pie: {
              shadow: false,
              center: ['50%', '50%']
          }
      },
      tooltip: {
          valueSuffix: 'คน'
      },
      series: [{
          name: 'จำนวนบัณฑิต',
          data: browserData,
          size: '60%',
          dataLabels: {
              formatter: function () {
                  return this.y > 5 ? this.point.name : null;
              },
              color: '#ffffff',
              distance: -30
          }
      }, {
          name: 'จำนวนบัณฑิต',
          data: versionsData,
          size: '80%',
          innerSize: '60%',
          dataLabels: {
              formatter: function () {
                  // display only if larger than 1
                  return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + 'คน' : null;
              }
          }
      }]
  });
});
        </script>
        <h3>ภาวะการมีงานทำของบัณฑิตสาขาวิชา<?php  echo $branch;?> ที่จบปีการศึกษา <?php  echo $year;?></h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>สถานะการมีงานทำ</th>
                <th>ทำงานตรงสาย</th>
                <th>จำนวนบัณฑิต(คน)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($workstatusGroup as $key => $value)
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
