<div class="ibox ">
                                    <div class="ibox-title">
        <h5>Small todo list</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <ul class="todo-list m-t small-list">
        @foreach ($tasks as $value)
            <li>
                <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                <span class="m-l-xs">{{$value->title}}</span>
                @if($value->level == 'low')
                    <small class="label label-success"><i class="fa fa-clock-o"></i> {{strtoupper($value->level)}}</small>
                @elseif($value->level == 'medium')
                    <small class="label label-warning"><i class="fa fa-clock-o"></i> {{strtoupper($value->level)}}</small>
                @else
                    <small class="label label-danger"><i class="fa fa-clock-o"></i> {{strtoupper($value->level)}}</small>
                @endif
            </li>
        @endforeach
        </ul>
    </div>
</div>