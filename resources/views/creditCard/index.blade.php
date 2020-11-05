@extends('layouts.app')

@section('title', 'Main page')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Lançamentos</h5>
                    </div>
                    <div class="ibox-content">
                        
                        <table class="table table-bordered table-hover table-nomargin">
                        <?php

                            echo "<thead>";
                            echo "<tr>";
                            $total = [];
                            $i=0;
                            $maiorRepeticao = 0;
                            foreach($table as $key => $values):
                                echo "<th>".strftime('%B de %Y', strtotime($key))."</th>";

                                $total[$i] = array_sum($values);
                                $i++;

                                #Apenas para achar a maior repetição
                                $maiorRepeticao = count($values) > $maiorRepeticao ? count($values) : $maiorRepeticao;
                            
                            endforeach;
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            for($i=0; $i < $maiorRepeticao; $i++){
                                echo "<tr>";
                                foreach($table as $key => $values):

                                    if(array_key_exists($i, $values)){
                                        echo "<td/>R$ ".number_format($values[$i], 2, ',', '.')."</td>";
                                    }else{
                                        echo "<td/>-</td>";
                                    }

                                endforeach;
                                echo "</tr>";
                            }
                            echo "</tbody>";
                        
                            echo '<tfoot><tr>';
                            foreach ($total as $value) {
                                echo "<td>R$ ".number_format($value, 2, ',', '.')."</td>";
                            }
                            echo '</tfoot></tr>';
                        ?>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection