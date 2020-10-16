<?php

$label = NULL;
$datas = NULL;

$i = 1;
foreach ($expensive as $value) {
    $separetor = ($i < count($expensive)) ? ',' : '';
    $label .= "\"".$value->title."\"".$separetor;
    $datas  .= $value->total.$separetor;
    $i++;
}

?>
<div class="ibox ">
    <div class="ibox-title">
        <h5>Despesas <small>
            <?php echo $range == "today" ? 'Até 30 dias' : NULL; ?>
            <?php echo $range == "monthly" ? 'Até 12 meses' : NULL; ?>
            <?php echo $range == "annual" ? 'Até 10 anos' : NULL; ?>
        </small></h5>
        <div class="float-right">
            <div class="btn-group">
                <button type="button" class="btn btn-xs btn-white <?php echo $range == "today" ? 'active' : NULL; ?>" onclick="financeChartPie('today')"   >Today</button>
                <button type="button" class="btn btn-xs btn-white <?php echo $range == "monthly" ? 'active' : NULL; ?>" onclick="financeChartPie('monthly')" >Monthly</button>
                <button type="button" class="btn btn-xs btn-white <?php echo $range == "annual" ? 'active' : NULL; ?>" onclick="financeChartPie('annual')"  >Annual</button>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div>
            <canvas id="doughnutChart" height="140"></canvas>
        </div>
    </div>
</div>

<script>
    
var doughnutData = {
        labels: [<?php echo $label; ?>],
        datasets: [{
            data: [{{$datas}}],
            backgroundColor: [
                "#9933ff",
                "#99ff99",
                "#ff9966",
                "#ff0066",
                "#00cccc",
                "#ffb3b3",
                "#ff66ff",
                "#3399ff",
                "#00ccff",
                "#cceeff"
            ]
        }]
    } ;


    var doughnutOptions = {
        responsive: true
    };


    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});


</script>