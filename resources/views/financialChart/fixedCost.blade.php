<div class="ibox ">
    <div class="ibox-title">
        <h5>Próximos lançamentos</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#" class="dropdown-item">Config option 1</a>
                </li>
                <li><a href="#" class="dropdown-item">Config option 2</a>
                </li>
            </ul>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        
        <table class="table table-hover margin bottom">
            <thead>
            <tr>
                <th class="w-75">Despesa</th>
                <th class="">Data</th>
            </tr>
            </thead>
            <tbody>

            @foreach($fixedCost as $value)
            <tr>
                <td>{{$value->description}}</td>
                <td class="text-center">{{substr($value->entry_date, 0, -5)}}</td>
            </tr>
            @endforeach
            
            </tbody>
        </table>

    </div>
</div>