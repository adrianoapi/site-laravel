<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <!--<img alt="image" class="rounded-circle" src="/img/profile_small.jpg"/>-->
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">User</span>
                        <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="{{route('perfil.index')}}">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('perfil.logout')}}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{Route::current()->getName() === 'dash.index' || Route::current()->getName() === NULL ? 'active' : ''}}">
                <a href="{{route('dash.index') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{Route::current()->getName() === 'transitionTypes.index' || Route::current()->getName() === 'ledgerGroups.index' ? 'active' : ''}}">
                <a href="{{ url('/minor') }}"><i class="fa fa-desktop"></i> <span class="nav-label">Configurações</span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('transitionTypes.index')}}">Tipo de Transação</a></li>
                    <li><a href="{{route('ledgerGroups.index')}}">Grupo Lançamento</a></li>
                </ul>
            </li>
            <li class="{{Route::current()->getName() === 'ledgerEntries.index' ||
             Route::current()->getName() === 'fixedCosts.index' ||
             Route::current()->getName() === 'creditcards.index' ||
             Route::current()->getName() === 'ledgerItems.search' ||
             Route::current()->getName() === 'financialCharts.index' ? 'active' : ''}}">
                <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Financeiro</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('ledgerEntries.index')}}">Lançamentos</a></li>
                    <li><a href="{{route('fixedCosts.index')}}">Lançamentos fixos</a></li>
                    <li><a href="{{route('ledgerItems.search')}}">Lançamentos Itens</a></li>
                    <li><a href="{{route('creditcards.index')}}">Parcelamentos</a></li>
                    <li><a href="{{route('financialCharts.index')}}">Gráficos</a></li>
                </ul>
            </li>
            <li class="{{Route::current()->getName() === 'collections.index' ? 'active' : ''}}">
                <a href="{{route('collections.index')}}"><i class="fa fa-trophy"></i> <span class="nav-label">Coleções</span> <span class="fa arrow"></span></a>
            </li>
            <li class="{{Route::current()->getName() === 'diagrams.index' ||
                Route::current()->getName() === 'diagrams.create' ||
                Route::current()->getName() === 'diagrams.edit'  ? 'active' : ''}}">
                <a href="{{route('diagrams.index')}}"><i class="fa fa-code-fork"></i> <span class="nav-label">Diagramas</span> <span class="fa arrow"></span></a>
            </li>
            <li class="{{Route::current()->getName() === 'passwords.index' ? 'active' : ''}}">
                <a href="{{route('passwords.index')}}"><i class="fa fa-key"></i> <span class="nav-label">Senhas</span> <span class="fa arrow"></span></a>
            </li>
            <li class="{{Route::current()->getName() === 'tasks.index' || Route::current()->getName() === 'taskGroups.index' ? 'active' : ''}}">
                <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Tarefas</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('tasks.index')}}">Tarefas</a></li>
                    <li><a href="{{route('taskGroups.index')}}">Grupos</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
