<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">Example user</strong>
                            </span> <span class="text-muted text-xs block">Example menu <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="">
                <a href="{{route('dash.index') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="">
                <a href="{{ url('/minor') }}"><i class="fa fa-desktop"></i> <span class="nav-label">Configurações</span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('transitionTypes.index')}}">Tipo de Transação</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Financeiro</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('collections.index')}}">Coleções</a></li>
                    <li><a href="{{route('ledgerEntries.index')}}">Lançamentos</a></li>
                    <li><a href="{{route('fixedCosts.index')}}">Lançamentos fixos</a></li>
                </ul>
            </li>
            <li class="">
                <a href="{{route('passwords.index')}}"><i class="fa fa-key"></i> <span class="nav-label">Senhas</span> <span class="fa arrow"></span></a>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Tarefas</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('tasks.index')}}">Tarefas</a></li>
                    <li><a href="{{route('taskGroups.index')}}">Grupos</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
