<table class="table table-hover margin bottom">
    <thead>
    <tr>
        <th class="w-75">Tipo</th>
        <th class="">Valor</th>
    </tr>
    </thead>
    <tbody>

    <?php
        $total = $dynamic['recipe'][0]->total - $dynamic['expense'][0]->total;
    ?>

        <tr>
            <td>Receita</td>
            <td><span class="label label-info">R$ {{number_format($dynamic['recipe'][0]->total, 2, ",", ".")}}</span></td>
        </tr>
        <tr>
            <td>Despesa</td>
            <td><span class="label label-danger">R$ {{number_format($dynamic['expense'][0]->total, 2, ",", ".")}}</span></td>
        </tr>
        <tr>
            <td>Total</td>
            <td><span class="label label-{{$total > 0 ? 'info': 'danger'}}">R$ {{number_format($total, 2, ",", ".")}}</span></td>
        </tr>

    </tbody>
</table>
