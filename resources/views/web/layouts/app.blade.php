<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" rel="icon" href="{{ asset('/img/logo.png') }}" sizes="16x16">
    <title>CPN</title>
    <!-- javascripts -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src='https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel='stylesheet' href='https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.css'>
    <link rel="stylesheet" href="{{ asset('css/web.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css">
  </head>
<body>

  <header class="primary_header">
    <div class="header_wrapper">
      <nav class="main_navigation navbar navbar-expand-lg navbar-light">
        <div class="navigation_wrapper container-fluid">
          <a class="nav_brand navbar-brand" style="padding-left: 55px;" href="#">
            <img class="brand_logo d-inline-block align-text-top" src="{{asset('/img/cpn-logo-250.png')}}" alt="" height="60">
          </a>

          <button class="nav_button navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="button_toggle navbar-toggler-icon"></span>
          </button>

          <div class="nav_menu collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="nav_menu_wrapper navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="menu_item nav-item">
                  <a class="menu_item_href nav-link {{ ( request()->is('home') ) ? 'active' : '' }}" active-color="red" aria-current="page" href="/home">Accueil</a>
                </li>
                <li class="menu_item nav-item">
                  <a class="menu_item_href nav-link {{ (request()->is('actuality')) ? 'active' : '' }}" active-color="red" href="/actuality">Actualité +</a>
                </li>
                <li class="menu_item nav-item">
                  <a class="menu_item_href nav-link {{ (request()->route('subevention')) ? 'active' : '' }}" active-color="red" href="{{route('subevention')}}">Subvention</a>
                </li>
                <li class="menu_item nav-item">
                  <a class="menu_item_href nav-link {{ (request()->is('agenda')) ? 'active' : '' }}"active-color="red" href="{{route('agenda')}}">Agenda +</a>
                </li>
                <li class="menu_item nav-item">
                  <a class="menu_item_href nav-link {{ (request()->is('about')) ? 'active' : '' }}" active-color="red" href="#about">A propos</a>
                </li>
                <li class="menu_item nav-item">
                  <a class="menu_item_href nav-link {{ (request()->is('contact')) ? 'active' : '' }}" active-color="red" href="/contact">Contactez-nous</a>
                </li>
                <li class="menu_item nav-item">
                  <a class="menu_item_href nav-link {{ (request()->is('registre')) ? 'active' : '' }}"active-color="red" href="{{route('registre')}}">Inscription</a>
                </li>
                <li class="menu_item nav-item">
                  <a class="menu_item_href nav-link btn btn-danger"  active-color="red" style="border: none;
                  background: red;
                  border-radius: 25px;
                  color: white;
                  padding: 5px 15px;" href="{{route('login')}}">Connexion</a>
                </li>
              </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <main class="primary_body mb-5" id="main">
    @yield('content')
  </main>

  <!-- <footer style="background: #111D5E;" class="primary_footer">
    <div class="container p-5">
      <div class="row g-0">
        <div class="col-md-4 mb-3">
          <img class="mb-3 brand_logo d-inline-block align-text-top" src="{{asset('/img/logo-cpn3.png')}}" alt="" width="" height="45">
          <p style="color:white;font-size: 13px;">Le Cabinet de Propulsion Numérique aide les entreprises à se propulser numériquement et à bénéficier de financement.
          CPN est un organisme de financement à but non lucratif</p>
          <ul style="margin:0; padding:0; display: flex; flex-direction:row">
            <li style="list-style: none;"><a href="#"><img style="width:40px; height:40px" src="{{asset('/img/facebook.png')}}" alt=""></a></li>
            <li style="list-style: none;margin:0 5px"><a href="#"><img style="width:40px; height:40px" src="{{asset('/img/instagram.png')}}" alt=""></a></li>
            <li style="list-style: none;margin:0 5px 0 0"><a href="#"><img style="width:40px; height:40px" src="{{asset('/img/twitter.png')}}" alt=""></a></li>
            <li style="list-style: none;"><a href="#"><img style="width:40px; height:40px" src="{{asset('/img/youtube.png')}}" alt=""></a></li>
          </ul>
        </div>
        <div class="col-md-8">
          <div class="row g-3">
            <div class="col-md-4 py-2 px-4 d-flex flex-column align-items-center justify-content-center">
              <h3 style="color: white; font-size: 20px; font-weight: 600;">Réseau sociaux</h3> <br>
              <ul style="width:100%; margin:0;padding:0;margin-left: 139px;font-size: 15px;">
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">Instagram</a></li> <br>
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">Youtube</a></li> <br>
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">Linkedin</a></li> <br>
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">Facebook</a></li>
              </ul>
            </div>
            <div class="col-md-4 py-2 px-4 d-flex flex-column align-items-center justify-content-center">
              <h3 style="color: white; font-size: 20px; font-weight: 600;">Support</h3> <br>
              <ul style="width:100%; margin:0;padding:0;margin-left: 139px;font-size: 15px;">
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">FAQ</a></li> <br>
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">Inscription</a></li> <br>
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">Actualité</a></li> <br>
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">Contact</a></li>
              </ul>
            </div>
            <div class="col-md-4 py-2 px-4 d-flex flex-column align-items-center justify-content-center" style="    margin-top: -47px;">
              <h3 style="color: white; font-size: 20px; font-weight: 600;">Contact</h3> <br>
              <ul style="width:100%; margin:0;padding:0;margin-left: 139px;font-size: 15px; ">
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">+33 6 73 46 65 64</a></li> <br>
                <li style="list-style: none;"><a style="text-decoration: none; color:white" href="#">votreconseiller@cpn-aide-aux-entreprise.com</a></li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer> -->
</body>
</html>
