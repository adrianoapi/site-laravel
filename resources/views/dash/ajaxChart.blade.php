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
                    label: "Despesa",
                    backgroundColor: "rgba(205, 90, 219, 0.5)",
                    borderColor: "rgba(205, 90, 219,0.7)",
                    pointBackgroundColor: "rgba(205, 90, 219,1)",
                    pointBorderColor: "#fff",
                    data: [{{$cost}}]
                },
                {
                    label: "Receita",
                    backgroundColor: "rgba(26,179,148,0.5)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [{{$recipe}}]
                },
                {
                    label: "Cartao",
                    backgroundColor: "rgba(248, 167, 0,0.5)",
                    borderColor: "rgba(248, 167, 0,0.7)",
                    pointBackgroundColor: "rgba(248, 167, 0,1)",
                    pointBorderColor: "#fff",
                    data: [{{$cart}}]
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