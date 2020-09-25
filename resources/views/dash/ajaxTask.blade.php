<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Custom responsive table </h5>
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
            <div class="row">
                <div class="col-sm-9 m-b-xs">
                    <div data-toggle="buttons" class="btn-group btn-group-toggle">
                        <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                        <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                        <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button">Go!</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Level</th>
                        <th>Group</th>
                        <th>Date</th>
                        <th>Progress</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $value)
                    <tr>
                        <td>{{$value->title}}</td>
                        <td>
                            @if($value->level == 'low')
                                <span class="label label-success">{{strtoupper($value->level)}}</span>
                            @elseif($value->level == 'medium')
                                <span class="label label-warning">{{strtoupper($value->level)}}</span>
                            @else
                                <span class="label label-danger">{{strtoupper($value->level)}}</span>
                            @endif
                        </td>
                        <td>{{$value->taskGroup->title}}</td>
                        <td>{{date('d/m/Y H:i', strtotime($value->created_at))}}</td>
                        <td>
                            @if($value->status == 'todo')
                                <span class="pie">0.00/1.0</span>
                            @elseif($value->status == 'inprogress')
                                <span class="pie">0.50/1.0</span>
                            @else
                                <span class="pie">1.0/1.0</span>
                            @endif
                        </td>
                        <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>