<?php
    $days   = NULL;
    $recipe = NULL;
    $cost   = NULL;
    $totalCost     = 0;
    $totalRecipe   = 0;
    $i = 1;
    ksort($lancamentoTotal);
    foreach($lancamentoTotal as $key => $value):
        $separetor = ($i < count($lancamentoTotal)) ? ',' : '';
        $days .= "\"".date('d/m', strtotime($key))."\"".$separetor;
        $recipe .= $value['lucro'].$separetor;
        $cost .= $value['despesa'].$separetor;

        $totalRecipe += $value['lucro'  ];
        $totalCost   += $value['despesa'];
        
        $i++;
    endforeach;

?>

<div>
    <canvas id="lineChart" height="114"></canvas>
</div>


<script>
    
    $(document).ready(function() {

      var lineData = {
            
            labels: [{!! html_entity_decode($days) !!}],
            datasets: [
                {
                    label: "Receita",
                    backgroundColor: "rgba(26,179,148,0.5)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [{{$recipe}}]
                },
                {
                    label: "Despesa",
                    backgroundColor: "rgba(255, 100, 148, 0.5)",
                    borderColor: "rgba(225,100,148,0.7)",
                    pointBackgroundColor: "rgba(225,100,148,1)",
                    pointBorderColor: "#fff",
                    data: [{{$cost}}]
                }
            ]
        };

        var lineOptions = {
            responsive: true
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});


    });

</script>