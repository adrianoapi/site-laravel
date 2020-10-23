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
                            echo "<tr>";
                            foreach($table as $key => $values):
                                echo "<th>{$key}</th>";
                            endforeach;
                            echo "</tr>";

                            for($i=0; $i < count($table); $i++){
                                echo "<tr>";
                                foreach($table as $key => $values):

                                    if(array_key_exists($i, $values)){
                                        echo "<td/>{$values[$i]}</td>";
                                    }else{
                                        echo "<td/>0</td>";
                                    }

                                endforeach;
                                echo "</tr>";
                            }

                        ?>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection