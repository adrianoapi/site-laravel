<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>pagSoft</title>

	<!-- Bootstrap -->
  <link rel="stylesheet" href="{{url(mix('dashboard/css/bootstrap.css'))}}">

  <!-- PageGuide -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/pageguide/pageguide.css')}}">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/fullcalendar/fullcalendar.css')}}">
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/chosen/chosen.css')}}">
	<!-- select2 -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/select2/select2.css')}}">
  <!-- icheck -->
  <link rel="stylesheet" href="{{url('dashboard/css/plugins/icheck/all.css')}}">
  <!-- Datepicker -->
	<link rel="stylesheet" href="{{url('dashboard/css/plugins/datepicker/datepicker.css')}}">

	<!-- Theme CSS -->
  <link rel="stylesheet" href="{{url(mix('dashboard/css/style.css'))}}">

	<!-- jQuery -->
  <script src="{{url(mix('dashboard/js/jquery.js'))}}"></script>
  <script src="{{url(mix('dashboard/js/jquery-ui.js'))}}"></script>

  <!-- Theme framework -->
  <script src="{{url(mix('dashboard/js/framework.js'))}}"></script>

  <script src="{{url(mix('dashboard/js/form.js'))}}"></script>
  <!-- Datepicker -->
	<script src="{{url('dashboard/js/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

	<!--[if lte IE 9]>
		<script src="{{url(mix('dashboard/js/jquery-ie9.js'))}}"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="{{url('img/favicon.ico')}}" />
	<!-- Apple devices Homescreen icon -->
  <link rel="apple-touch-icon-precomposed" href="{{url('img/apple-touch-icon-precomposed.png')}}" />

	<!-- Fullcalendar -->
  <link rel="stylesheet" href="{{url('dashboard/css/plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
  

  <!-- icheck -->
	<script src="{{url('dashboard/js/plugins/icheck/jquery.icheck.min.js')}}"></script>



</head>

<body data-layout-sidebar="fixed" data-layout-topbar="fixed">
  
<div id="navigation">
  <div class="container-fluid">
    <a href="{{url('dash')}}" id="brand">pagSoft</a>
    <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
    <ul class='main-nav'>
      <li>
        <a href="{{url('dash')}}">
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
          <span>Financeiro</span>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
        <li><a href="{{route('dash.index')}}"><i class="glyphicon-dashboard"></i> Dashboard</a></li>
        <li>
          <a href="{{route('ledgerEntries.index')}}"><i class="icon-money"></i> Lançamentos</a>
        </li>
        <li>
          <a href="#"><i class="icon-search"></i> Pesquisas</a>
        </li>
        <li>
          <a href="#"><i class="icon-bar-chart"></i> Gráficos</a>
        </li>
        <li class='dropdown-submenu'>
          <a href="#" data-toggle="dropdown"><i class="icon-laptop"></i> Configurações</a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{'transacoes-tipo'}}"><i class="glyphicon-credit_card"></i> Tipo de tansação</a>
            </li>
            <li>
              <a href="{{'lancamento-grupo'}}"><i class="glyphicon-shopping_bag"></i> Tipos de Despesa</a>
            </li>
          </ul>
        </li>
      </ul>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
          <span>Produtividade</span>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li class='dropdown'>
            <a href="#" data-toggle="dropdown"><i class="icon-sitemap"></i> Organogramas</a>
            <ul class="dropdown-menu">
              <li>
                <a href="#">Mapa Mental</a>
              </li>
              <li>
                <a href="#">Fluxograma</a>
              </li>
            </ul>
          </li>
          <li class="dropdown-submenu">
            <a href="#" data-toggle="dropdown"><i class="icon-star-empty"></i> Favoritos</a>
            <ul class="dropdown-menu">
              <li>
                <a href="{{route('links.listAll')}}"><i class="icon-star-empty"></i> Categorias</a>
              </li>
              <li>
                <a href="{{route('linksItems.listAll')}}"><i class="icon-star-empty"></i> Links</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="icon-heart-empty"></i> Coleções</a>
          </li>
          <li>
            <a href="{{route('posts.index')}}"><i class="icon-book"></i> Anotações</a>
          </li>
          <li class='dropdown-submenu'>
            <a href="#" data-toggle="dropdown"><i class="icon-ok-circle"></i> Exames</a>
            <ul class="dropdown-menu">
              <li>
                <a href="{{route('exams.index')}}"><i class="icon-ok-circle"></i> Listar Exames</a>
              </li>
              <li>
                <a href="{{route('questions.index')}}"><i class="icon-ok-circle"></i> Listar Questões</a>
              </li>
              <li>
                <a href="{{route('answers.index')}}"><i class="icon-ok-circle"></i> Listar Respostas</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="glyphicon-keys"></i> Senhas</a>
          </li>
          <li class='dropdown-submenu'>
            <a href="#" data-toggle="dropdown"><i class="icon-calendar"></i> Agendas</a>
            <ul class="dropdown-menu">
              <li>
                <a href="#"><i class="glyphicon-tie"></i> Compromissos</a>
              </li>
              <li>
                <a href="#"><i class="glyphicon-iphone_shake"></i> Contatos</a>
              </li>
            </ul>
          </li>
          <li class='dropdown-submenu'>
            <a href="#" data-toggle="dropdown"><i class="glyphicon-list"></i> Lista de Tarefas</a>
            <ul class="dropdown-menu">
              <li>
                <a href="{{url('tarefas')}}"><i class="glyphicon-list"></i> Tarefas</a>
              </li>
              <li>
              <a href="{{url('tarefas-grupo')}}"><i class="glyphicon-list"></i> Grupos</a>
              </li>
            </ul>
          </li>
          <li><a href="artigos"><i class="icon-list-alt"></i> Artigos</a></li>
        </ul>
      </li>
    </ul>
    <div class="user">
      <ul class="icon-nav">
        <li class='dropdown'>
          <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred">4</span></a>
          <ul class="dropdown-menu pull-right message-ul">
            <li>
              <a href="#">
                <img src="{{url('img/demo/user-1.jpg')}}" alt="">
                <div class="details">
                  <div class="name">Jane Doe</div>
                  <div class="message">
                    Lorem ipsum Commodo quis nisi ...
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="#">
                <img src="{{url('img/demo/user-2.jpg')}}" alt="">
                <div class="details">
                  <div class="name">John Doedoe</div>
                  <div class="message">
                    Ut ad laboris est anim ut ...
                  </div>
                </div>
                <div class="count">
                  <i class="icon-comment"></i>
                  <span>3</span>
                </div>
              </a>
            </li>
            <li>
              <a href="#">
                <img src="{{url('img/demo/user-3.jpg')}}" alt="">
                <div class="details">
                  <div class="name">Bob Doe</div>
                  <div class="message">
                    Excepteur Duis magna dolor!
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="components-messages.html" class='more-messages'>Go to Message center <i class="icon-arrow-right"></i></a>
            </li>
          </ul>
        </li>
        
        <li class="dropdown sett">
          <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-cog"></i></a>
          <ul class="dropdown-menu pull-right theme-settings">
            <li>
              <span>Layout-width</span>
              <div class="version-toggle">
                <a href="#" class='set-fixed'>Fixed</a>
                <a href="#" class="active set-fluid">Fluid</a>
              </div>
            </li>
            <li>
              <span>Topbar</span>
              <div class="topbar-toggle">
                <a href="#" class='set-topbar-fixed'>Fixed</a>
                <a href="#" class="active set-topbar-default">Default</a>
              </div>
            </li>
            <li>
              <span>Sidebar</span>
              <div class="sidebar-toggle">
                <a href="#" class='set-sidebar-fixed'>Fixed</a>
                <a href="#" class="active set-sidebar-default">Default</a>
              </div>
            </li>
          </ul>
        </li>
        <li class='dropdown colo'>
          <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
          <ul class="dropdown-menu pull-right theme-colors">
            <li class="subtitle">
              Predefined colors
            </li>
            <li>
              <span class='red'></span>
              <span class='orange'></span>
              <span class='green'></span>
              <span class="brown"></span>
              <span class="blue"></span>
              <span class='lime'></span>
              <span class="teal"></span>
              <span class="purple"></span>
              <span class="pink"></span>
              <span class="magenta"></span>
              <span class="grey"></span>
              <span class="darkblue"></span>
              <span class="lightred"></span>
              <span class="lightgrey"></span>
              <span class="satblue"></span>
              <span class="satgreen"></span>
            </li>
          </ul>
        </li>
        <li class='dropdown language-select'>
          <a href="#" class='dropdown-toggle' data-toggle="dropdown"><img src="{{url('img/demo/flags/us.gif')}}" alt=""><span>US</span></a>
          <ul class="dropdown-menu pull-right">
            <li>
              <a href="#"><img src="{{url('img/demo/flags/br.gif')}}" alt=""><span>Brasil</span></a>
            </li>
            <li>
              <a href="#"><img src="{{url('img/demo/flags/de.gif')}}" alt=""><span>Deutschland</span></a>
            </li>
            <li>
              <a href="#"><img src="{{url('img/demo/flags/es.gif')}}" alt=""><span>España</span></a>
            </li>
            <li>
              <a href="#"><img src="{{url('img/demo/flags/fr.gif')}}" alt=""><span>France</span></a>
            </li>
          </ul>
        </li>
      </ul>
      <div class="dropdown">
        <a href="#" class='dropdown-toggle' data-toggle="dropdown">John Doe <img src="{{url('img/demo/user-avatar.jpg')}}" alt=""></a>
        <ul class="dropdown-menu pull-right">
          <li>
            <a href="more-userprofile.html">Edit profile</a>
          </li>
          <li>
            <a href="#">Account settings</a>
          </li>
          <li>
            <a href="{{route('admin.logout')}}">Sign out</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid" id="content">
  <div id="left">
    <div class="subnav">
      <div class="subnav-title">
        <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Financeiro</span></a>
      </div>
      <ul class="subnav-menu">
        <li><a href="{{route('dash.index')}}"><i class="glyphicon-dashboard"></i> Dashboard</a></li>
        <li>
          <a href="{{route('ledgerEntries.index')}}"><i class="icon-money"></i> Lançamentos</a>
        </li>
        <li>
          <a href="#"><i class="icon-search"></i> Pesquisas</a>
        </li>
        <li>
          <a href="#"><i class="icon-bar-chart"></i> Gráficos</a>
        </li>
        <li class='dropdown'>
          <a href="#" data-toggle="dropdown"><i class="icon-laptop"></i> Configurações</a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{'transacoes-tipo'}}"><i class="glyphicon-credit_card"></i> Tipo de tansação</a>
            </li>
            <li>
              <a href="{{'lancamento-grupo'}}"><i class="glyphicon-shopping_bag"></i> Tipos de Despesa</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="subnav">
      <div class="subnav-title">
        <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Produtividade</span></a>
      </div>
      <ul class="subnav-menu">
        <li class='dropdown'>
          <a href="#" data-toggle="dropdown"><i class="icon-sitemap"></i> Organogramas</a>
          <ul class="dropdown-menu">
            <li>
              <a href="#">Mapa Mental</a>
            </li>
            <li>
              <a href="#">Fluxograma</a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" data-toggle="dropdown"><i class="icon-star-empty"></i> Favoritos</a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{route('links.listAll')}}"><i class="icon-star-empty"></i> Categorias</a>
            </li>
            <li>
              <a href="{{route('linksItems.listAll')}}"><i class="icon-star-empty"></i> Links</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="icon-heart-empty"></i> Coleções</a>
        </li>
        <li>
          <a href="{{route('posts.index')}}"><i class="icon-book"></i> Anotações</a>
        </li>
        
        <li class='dropdown'>
          <a href="#" data-toggle="dropdown"><i class="icon-ok-circle"></i> Exames</a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{route('exams.index')}}"><i class="icon-ok-circle"></i> Listar Exames</a>
            </li>
            <li>
              <a href="{{route('questions.index')}}"><i class="icon-ok-circle"></i> Listar Questões</a>
            </li>
            <li>
              <a href="{{route('answers.index')}}"><i class="icon-ok-circle"></i> Listar Respsotas</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="glyphicon-keys"></i> Senhas</a>
        </li>
        <li class='dropdown'>
          <a href="#" data-toggle="dropdown"><i class="icon-calendar"></i> Agendas</a>
          <ul class="dropdown-menu">
            <li>
              <a href="#"><i class="glyphicon-tie"></i> Compromissos</a>
            </li>
            <li>
              <a href="#"><i class="glyphicon-iphone_shake"></i> Contatos</a>
            </li>
          </ul>
        </li>
        <li class='dropdown'>
          <a href="#" data-toggle="dropdown"><i class="glyphicon-list"></i> Lista de Tarefas</a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{url('tarefas')}}"><i class="glyphicon-list"></i> Tarefas</a>
            </li>
            <li>
            <a href="{{url('tarefas-grupo')}}"><i class="glyphicon-list"></i> Grupos</a>
            </li>
          </ul>
        </li>
        <li><a href="artigos"><i class="icon-list-alt"></i> Artigos</a></li>
      </ul>
    </div>
  </div>
  <div id="main">

    @yield('content')

  </div>
</div>

<script>
  $('.datepick').datepicker({
      format: 'dd/mm/yyyy'
   });
  </script>

</body>
</html>