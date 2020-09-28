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

    $catTotal = 0;
    foreach($cart as $value):
        $catTotal += $value->total;
    endforeach;

    $cartPercentCost;
    if(($catTotal) > 0){
        $cartPercentCost   = $catTotal * 100 / ($totalRecipe + $catTotal);
    }

?>

<ul class="stat-list m-t-lg">
    <li>
        <h2 class="no-margins">R$ {{number_format($totalRecipe, 2, ',','.')}}</h2>
        <small>Faturamento</small>
        <div class="progress progress-mini">
            <div class="progress-bar" style="width: {{$percentRecipe}}%;"></div>
        </div>
    </li>
    <li>
        <h2 class="no-margins ">R$ {{number_format($totalCost, 2, ',','.')}}</h2>
        <small>Despesa</small>
        <div class="progress progress-mini">
            <div class="progress-bar-danger" style="width: {{$percentCost}}%;"></div>
        </div>
    </li>
    <li>
        <h2 class="no-margins ">R$ {{number_format($catTotal, 2, ',','.')}}</h2>
        <small>Lançamentos para a próxima fatura do cartão</small>
        <div class="progress progress-mini">
            <div class="progress-bar-warning" style="width: {{$cartPercentCost}}%;"></div>
        </div>
    </li>
</ul>