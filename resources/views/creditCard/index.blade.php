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
                        <tr>
                        <?php
                            
                            foreach($table as $key => $values):
                                echo "<th>{$key}</th>";
                            endforeach;
                        ?>
                        </tr>
                        </table>
                        <?php
                        
                        echo '<pre>';
                        print_r($table);
                        echo '</pre>';
                        
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection