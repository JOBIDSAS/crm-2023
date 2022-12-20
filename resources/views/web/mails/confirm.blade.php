<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" rel="icon" href="{{ asset('/img/logo.png') }}" sizes="16x16">
    <title>CPN - Confirmation rendez-vous</title>
    <!-- javascripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  </head>
<body>
  
  <main class="primary_body">
    <div class="container-fluid d-flex flex-column justify-content-center g-0 appointment_container">
      <div class="row justify-content-center g-0">
        <div class="col-md-7">
          <div class="appointment_wrapper container">
            <header class="row p-2 g-0 appointment_header">
              <div class="col-md-12 header_logo">
                <img class="logo" src="{{asset('img/logo-cpn2.png')}}" alt="">
              </div>
            </header>
            <div class="appointment_body mb-3">
              <div class="row g-0 justify-content-center align-items-center">
                <div class="col-md-12">
                  <div class="row mb-5 g-0 justify-content-center">
                    <div class="col-auto">
                      <div class="logo_box">
                        <img class="calendar" width="180" src="{{asset('img/calender.svg')}}" alt="">
                        <img class="tick" width="60" src="{{asset('img/tick.svg')}}" alt="">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-5 g-0 justify-content-center">
                    <div class="col-auto">
                      <h2 class="info_txt">Votre rendez-vous à bien été confirmé.</h2>
                    </div>
                  </div>
                  <div class="row mb-3 g-0 justify-content-center">
                    <div class="col-auto">
                      <a class="info_button" target="_blank" href="http://cpn-aide-aux-entreprises.com/">Accéder au site</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <footer class="appointment_footer">
              <div class="row justify-content-center">
                <div class="col-auto">
                  <ul class="social_list">  
                    <li class="social_items">
                      <a class="social_href" target="_blank" href="https://www.facebook.com/CPN.aideauxentreprises"><img class="social_logo" src="{{asset('img/facebook.png')}}" alt=""></a>
                    </li>
                    <li class="social_items">
                      <a class="social_href" target="_blank" href="https://www.instagram.com/cpn_aideauxentreprises"><img class="social_logo" src="{{asset('img/instagram.png')}}" alt=""></a>
                    </li>
                    <li class="social_items">
                      <a class="social_href" target="_blank" href="https://www.linkedin.com/company/cpn-aide-aux-entreprises"><img class="social_logo" src="{{asset('img/linkedin.png')}}" alt=""></a>
                    </li>
                  </ul>
                </div>
              </div>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="{{asset('js/confirm.js')}}"></script>
</body>
</html>