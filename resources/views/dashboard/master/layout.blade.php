<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>FLAT - Blank Page</title>

	<!-- Bootstrap -->
  <link rel="stylesheet" href="{{url(mix('dashboard/css/bootstrap.css'))}}">

	<!-- Theme CSS -->
  <link rel="stylesheet" href="{{url(mix('dashboard/css/style.css'))}}">

  <link rel="stylesheet" href="{{url(mix('dashboard/css/form.css'))}}">

	<!-- jQuery -->
  <script src="{{url(mix('dashboard/js/jquery.js'))}}"></script>
  <script src="{{url(mix('dashboard/js/jquery-ui.js'))}}"></script>

  <!-- Theme framework -->
  <script src="{{url(mix('dashboard/js/framework.js'))}}"></script>

  <script src="{{url(mix('dashboard/js/form.js'))}}"></script>

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
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>
<div id="navigation">
  <div class="container-fluid">
    <a href="#" id="brand">FLAT</a>
    <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
    <ul class='main-nav'>
      <li>
        <a href="index.html">
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
          <span>Forms</span>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="forms-basic.html">Basic forms</a>
          </li>
          <li>
            <a href="forms-extended.html">Extended forms</a>
          </li>
          <li>
            <a href="forms-validation.html">Validation</a>
          </li>
          <li>
            <a href="forms-wizard.html">Wizard</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
          <span>Components</span>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="components-timeline.html">Timeline</a>
          </li>
          <li>
            <a href="components-pagestatistics.html">Page statistics</a>
          </li>
          <li>
            <a href="components-sidebarwidgets.html">Sidebar widgets</a>
          </li>
          <li>
            <a href="components-messages.html">Messages &amp; Chat</a>
          </li>
          <li>
            <a href="components-gallery.html">Gallery &amp; Thumbs</a>
          </li>
          <li>
            <a href="components-tiles.html">Tiles</a>
          </li>
          <li>
            <a href="components-icons.html">Icons &amp; Buttons</a>
          </li>
          <li>
            <a href="components-elements.html">UI elements</a>
          </li>
          <li>
            <a href="components-typography.html">Typography</a>
          </li>
          <li>
            <a href="components-bootstrap.html">Bootstrap elements</a>
          </li>
          <li>
            <a href="components-grid.html">Grid</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
          <span>Tables</span>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="tables-basic.html">Basic tables</a>
          </li>
          <li>
            <a href="tables-dynamic.html">Dynamic tables</a>
          </li>
          <li>
            <a href="tables-large.html">Large tables</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
          <span>Plugins</span>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="plugins-charts.html">Charts</a>
          </li>
          <li>
            <a href="plugins-calendar.html">Calendar</a>
          </li>
          <li>
            <a href="plugins-filemanager.html">File manager</a>
          </li>
          <li>
            <a href="plugins-filetrees.html">File trees</a>
          </li>
          <li>
            <a href="plugins-elements.html">Editable elements</a>
          </li>
          <li>
            <a href="plugins-maps.html">Maps</a>
          </li>
          <li>
            <a href="plugins-dragdrop.html">Drag &amp; Drop widgets</a>
          </li>
          
        </ul>
      </li>
      <li class='active'>
        <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
          <span>Pages</span>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="more-error.html">Error pages</a>
          </li>
          <li class='dropdown-submenu'>
            <a href="#" data-toggle="dropdown" class='dropdown-toggle'>Shop</a>
            <ul class="dropdown-menu">
              <li>
                <a href="more-shop-list.html">List view</a>
              </li>
              <li>
                <a href="more-shop-product.html">Product view</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="more-pricing.html">Pricing tables</a>
          </li>
          <li>
            <a href="more-faq.html">FAQ</a>
          </li>
          <li>
            <a href="more-invoice.html">Invoice</a>
          </li>
          <li>
            <a href="more-userprofile.html">User profile</a>
          </li>
          <li>
            <a href="more-searchresults.html">Search results</a>
          </li>
          <li>
            <a href="more-login.html">Login</a>
          </li>
          <li>
            <a href="more-locked.html">Lock screen</a>
          </li>
          <li>
            <a href="more-email.html">Email templates</a>
          </li>
          <li class='active'>
            <a href="more-blank.html">Blank page</a>
          </li>
          <li class='dropdown-submenu'>
            <a href="#" data-toggle="dropdown" class='dropdown-toggle'>Blog</a>
            <ul class="dropdown-menu">
              <li>
                <a href="more-blog-list.html">List big image</a>
              </li>
              <li>
                <a href="more-blog-list-small.html">List small image</a>
              </li>
              <li>
                <a href="more-blog-post.html">Post</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
          <span>Layouts</span>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="layouts-sidebar-hidden.html">Default hidden sidebar</a>
          </li>
          <li>
            <a href="layouts-sidebar-right.html">Sidebar right side</a>
          </li>
          <li>
            <a href="layouts-color.html">Different default color</a>
          </li>
          <li>
            <a href="layouts-fixed.html">Fixed layout</a>
          </li>
          <li>
            <a href="layouts-fixed-topside.html">Fixed topbar and sidebar</a>
          </li>
          <li class='dropdown-submenu'>
            <a href="#">Mobile sidebar</a>
            <ul class="dropdown-menu">
              <li>
                <a href="layouts-mobile-slide.html">Slide</a>
              </li>
              <li>
                <a href="layouts-mobile-button.html">Button</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="layouts-footer.html">Footer</a>
          </li>
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
            <a href="more-login.html">Sign out</a>
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
        <li><a href="#"><i class="glyphicon-dashboard"></i> Dashboard</a></li>
        <li class='dropdown'>
          <a href="#" data-toggle="dropdown"><i class="icon-money"></i> Lançamentos</a>
          <ul class="dropdown-menu">
            <li>
              <a href="#">Receitas</a>
            </li>
            <li>
              <a href="#">Despesas</a>
            </li>
            <li>
              <a href="#">Transferências</a>
            </li>
            <li class='dropdown-submenu'>
              <a href="#" data-toggle="dropdown" class='dropdown-toggle'>Go to level 3</a>
              <ul class="dropdown-menu">
                <li>
                  <a href="#">This is level 3</a>
                </li>
                <li>
                  <a href="#">Unlimited levels</a>
                </li>
                <li>
                  <a href="#">Easy to use</a>
                </li>
              </ul>
            </li>
          </ul>
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
              <a href="#"><i class="glyphicon-credit_card"></i> Tipos de Lançamento</a>
            </li>
            <li>
              <a href="#"><i class="glyphicon-shopping_bag"></i> Tipos de Despesa</a>
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
        <li>
          <a href="{{route('linksItems.listAll')}}"><i class="icon-star-empty"></i> Favoritos</a>
        </li>
        <li>
          <a href="#"><i class="icon-heart-empty"></i> Coleções</a>
        </li>
        <li>
          <a href="{{route('posts.index')}}"><i class="icon-book"></i> Anotações</a>
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
        <li><a href="#"><i class="glyphicon-list"></i> Lista de Tarefas</a></li>
      </ul>
    </div>
    <div class="subnav subnav-hidden">
      <div class="subnav-title">
        <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Plugins</span></a>
      </div>
      <ul class="subnav-menu">
        <li>
          <a href="#">Cache manager</a>
        </li>
        <li class='dropdown'>
          <a href="#" data-toggle="dropdown">Import manager</a>
          <ul class="dropdown-menu">
            <li>
              <a href="#">Action #1</a>
            </li>
            <li>
              <a href="#">Antoher Link</a>
            </li>
            <li class='dropdown-submenu'>
              <a href="#" data-toggle="dropdown" class='dropdown-toggle'>Go to level 3</a>
              <ul class="dropdown-menu">
                <li>
                  <a href="#">This is level 3</a>
                </li>
                <li>
                  <a href="#">Unlimited levels</a>
                </li>
                <li>
                  <a href="#">Easy to use</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">Contact form generator</a>
        </li>
        <li>
          <a href="#">SEO optimization</a>
        </li>
      </ul>
    </div>
    <div class="subnav subnav-hidden">
      <div class="subnav-title">
        <a href="#" class='toggle-subnav'><i class="icon-angle-right"></i><span>Configurações</span></a>
      </div>
      <ul class="subnav-menu">
        <li>
          <a href="#">Menu</a>
        </li>
        <li class='dropdown'>
          <a href="#" data-toggle="dropdown">With submenu</a>
          <ul class="dropdown-menu">
            <li>
              <a href="#">Action #1</a>
            </li>
            <li>
              <a href="#">Antoher Link</a>
            </li>
            <li class='dropdown-submenu'>
              <a href="#" data-toggle="dropdown" class='dropdown-toggle'>More stuff</a>
              <ul class="dropdown-menu">
                <li>
                  <a href="#">This is level 3</a>
                </li>
                <li>
                  <a href="#">Easy to use</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">Security settings</a>
        </li>
      </ul>
    </div>
  </div>
  <div id="main">

    @yield('content')

  </div>
</div>


</body>
</html>