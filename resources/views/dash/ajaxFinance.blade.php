<?php
    $days   = NULL;
    $recipe = NULL;
    $cost   = NULL;
    $totalCart     = 0;
    $totalCost     = 0;
    $totalRecipe   = 0;
    $percentRecipe = 0;
    $percentCost   = 0;
    foreach($lancamentoTotal as $key => $value):

        $totalRecipe += $value['lucro'  ];
        $totalCost   += $value['despesa'];
        $totalCart   += $value['cartao'];
        
    endforeach;

    if(($totalRecipe + $totalCost) > 0){
        $percentRecipe = $totalRecipe * 100 / ($totalRecipe + $totalCost);
        $percentCost   = $totalCost * 100 / ($totalRecipe + $totalCost);
    }

    $cartPercentCost = 0;
    if(($totalCart) > 0){
        $cartPercentCost   = $totalCart * 100 / ($totalRecipe + $totalCart);
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
        <h2 class="no-margins ">R$ {{number_format($totalCart, 2, ',','.')}}</h2>
        <small>Lançamentos para a próxima fatura do cartão</small>
        <div class="progress progress-mini">
            <div class="progress-bar-warning" style="width: {{$cartPercentCost}}%;"></div>
        </div>
    </li>
</ul>