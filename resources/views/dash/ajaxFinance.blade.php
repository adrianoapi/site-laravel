<?php
    $days   = NULL;
    $recipe = NULL;
    $cost   = NULL;
    $totalCost     = 0;
    $totalRecipe   = 0;
    $percentRecipe = 0;
    $percentCost   = 0;
    $i = 1;
    ksort($lancamentoTotal);
    foreach($lancamentoTotal as $key => $value):
        $separetor = ($i < count($lancamentoTotal)) ? ',' : '';
        $days .= "\"$key\"".$separetor;
        $recipe .= $value['lucro'].$separetor;
        $cost .= $value['despesa'].$separetor;

        $totalRecipe += $value['lucro'  ];
        $totalCost   += $value['despesa'];
        
        $i++;
    endforeach;

    if(($totalRecipe + $totalCost) > 0){
        $percentRecipe = $totalRecipe * 100 / ($totalRecipe + $totalCost);
        $percentCost   = $totalCost * 100 / ($totalRecipe + $totalCost);
    }
?>

<ul class="stat-list m-t-lg">
    <li>
        <h2 class="no-margins">R$ {{number_format($totalRecipe, 2, ',','.')}}</h2>
        <small>Total orders in period</small>
        <div class="progress progress-mini">
            <div class="progress-bar" style="width: {{$percentRecipe}}%;"></div>
        </div>
    </li>
    <li>
        <h2 class="no-margins ">R$ {{number_format($totalCost, 2, ',','.')}}</h2>
        <small>Orders in last month</small>
        <div class="progress progress-mini">
            <div class="progress-bar-danger" style="width: {{$percentCost}}%;"></div>
        </div>
    </li>
</ul>