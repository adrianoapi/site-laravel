<?php
    $days   = NULL;
    $cart = NULL;
    $recipe = NULL;
    $cost   = NULL;
    $totalCost     = 0;
    $totalRecipe   = 0;
    $i = 1;
    ksort($lancamentoTotal);
    foreach($lancamentoTotal as $key => $value):
        $separetor = ($i < count($lancamentoTotal)) ? ',' : '';

        if($range == "annual"){
            $days .= "\"".$key."\"".$separetor;
        }else if($range == "monthly"){
            $days .= "\"".date('m/Y', strtotime($key))."\"".$separetor;
        }else if($range == "today"){
            $days .= "\"".date('d/m', strtotime($key))."\"".$separetor;
        }
        
        $cart .= $value['cartao'].$separetor;
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
                    label: "Cartao",
                    backgroundColor: "rgba(255, 102, 0,0.5)",
                    borderColor: "rgba(255, 102, 0,0.5)",
                    pointBackgroundColor: "rgba(255, 102, 0,1)",
                    pointBorderColor: "#fff",
                    data: [{{$cart}}]
                },
                {
                    label: "Despesa",
                    backgroundColor: "rgba(255, 26, 26, 0.3)",
                    borderColor: "rgba(255, 26, 26,0.5)",
                    pointBackgroundColor: "rgba(255, 0, 0,1)",
                    pointBorderColor: "#fff",
                    data: [{{$cost}}]
                },
                {
                    label: "Receita",
                    backgroundColor: "rgba(26,179,148,0.1)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [{{$recipe}}]
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