<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{mix('site/css/style.css')}}">
    <title>Document</title>
</head>
<body>
    
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <a class="navbar-brand" href="#">Carousel</a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() === 'site.home' ? 'active' : ''}}" href="{{route('site.home')}}">Home</a>
              </li>
              <li class="nav-item {{Route::current()->getName() === 'site.curses' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('site.curses')}}">Cursos</a>
              </li>
              <li class="nav-item {{Route::current()->getName() === 'site.contact' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('site.contact')}}">Contato</a>
              </li>
            </ul>
          </div>

        </nav>
      </header>
      
      <main role="main">
      
        @yield('content')
      
      
        <!-- FOOTER -->
        <footer class="container">
          <p class="float-right"><a href="#">Back to top</a></p>
          <p>&copy; {{date('Y')}} Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
      </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{mix('site/js/script.js')}}"></script>
</body>
</html>