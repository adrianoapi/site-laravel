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
        <h5>Pie </h5>

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
            backgroundColor: ["#a3e1d4","#dedede","#b5b8cf"]
        }]
    } ;


    var doughnutOptions = {
        responsive: true
    };


    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});


</script>