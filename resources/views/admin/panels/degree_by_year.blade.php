<?php

$sql = "SELECT `alumni`.`degree` as `degree`,
`alumni`.`branch`,
count(*) as `amount`
FROM `alumni`
where yearofgraduation=$year
group by `alumni`.`degree`,`alumni`.`branch`" ;

$result = DB::select($sql);

//$degreeGroup = collect($result)->groupBy('degree');
//$array = $degreeGroup->toArray();

$arrvalueofdegree = [];
$arrofdegree = [];
$degreeGradGroup = collect($result)->groupBy('degree');
//dd($degreeGradGroup);
$cs= array("#00CC66", "#CCFF66", "#99FFFF", "#FFCCFF",'#CCFFCC');
$i=0;
foreach ($degreeGradGroup as $key=>$value) {

  $sum=0;
  $arrofdegree[]=$key;
  $valueofdegree = new stdClass();
   $arrofbranch=[];
   $arrofbranchamount=[];
   foreach ($value as $subkey => $subvalue) {
     $arrofbranch[]=$subvalue->branch;
     $arrofbranchamount[]=$subvalue->amount;
     $sum=$sum+$subvalue->amount;
   }
  $valueofdegree->y=$sum;
  $valueofdegree->color=$cs[$i];
  $valueofbranch = new stdClass();
  $valueofbranch->name=$key;
  $valueofbranch->categories=$arrofbranch;
  $valueofbranch->data=$arrofbranchamount;
  $valueofbranch->color=$cs[$i];

 $valueofdegree->drilldown=$valueofbranch;
 $i++;
 $arrvalueofdegree[] = $valueofdegree;
}
//dd($arrvalueofdegree);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> จำนวนบัณฑิตที่จบปีการศึกษา <?php  echo $year;?> แยกตามระดับการศึกษาและสาขาวิชา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_year_graph_panel" style="height: 500px;"></div>

        <script>
        $(function () {

      var colors = Highcharts.getOptions().colors,
      categories = <?php echo json_encode($arrofdegree); ?>,
      data = <?php echo json_encode($arrvalueofdegree);?>,
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
  $('#count_by_year_graph_panel').highcharts({
      chart: {
          type: 'pie'
      },
      title: {
          text: "จำนวนบัณฑิตที่จบปีการศึกษา <?php  echo $year;?> แยกตามระดับการศึกษาและสาขาวิชา"
      },
      yAxis: {
          title: {
              text: 'Total percent market share'
          }
      },
      plotOptions: {
          pie: {
              shadow: false,
              center: ['50%', '50%'],


              dataLabels: {
                  enabled: true
              }



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
        <h3>จำนวนบัณฑิตที่จบปีการศึกษา <?php  echo $year;?> แยกตามระดับการศึกษาและสาขาวิชา</h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ระดับการศึกษา</th>
                <th>สาขาวิชา</th>
                <th>จำนวนบัณฑิต(คน)</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($degreeGradGroup as $key => $value)
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
</div>