@extends('web.layouts.app')

@section('content')

    <div class="login_container">
        <div class="login_wrapper">
        <div class="login_content">
            <div class="row g-0 py-2">
                <div class="col-md-6" >
                    <div class="container-fluid">
                        <div class="row row-cols-2 g-2">
                            <div class="col"> <img style="width: 100%;height: 100%" src="{{asset('img/cnx/1.png')}}" alt=""></div>
                            <div class="col"> <img style="width: 100%;border-radius: 0 3.5rem 0 0;height: 100%;" src="{{asset('img/cnx/2.png')}}" alt=""></div>
                            <div class="col">  <img style="width: 100%;height: 100%" src="{{asset('img/cnx/3.png')}}" alt=""></div>
                            <div class="col">  <img style="width: 100%;height: 100%" src="{{asset('img/cnx/4.png')}}" alt=""></div>
                            <div class="col">  <img style="width: 100%;height: 100%" src="{{asset('img/cnx/5.png')}}" alt=""></div>
                            <div class="col">  <img style="width: 100%;height: 100%" src="{{asset('img/cnx/6.png')}}" alt=""></div>
                            <div class="col">  <img style="width: 100%;height: 100%" src="{{asset('img/cnx/7.png')}}" alt=""></div>
                            <div class="col">  <img style="width: 100%;height: 100%" src="{{asset('img/cnx/8.png')}}" alt=""></div>
                            <div class="col">  <img style="width: 100%;height: 100%" src="{{asset('img/cnx/9.png')}}" alt=""></div>
                            <div class="col">  <img style=" border-radius: 0 0 3.5rem 0; width: 100%;height: 100%" src="{{asset('img/cnx/10.png')}}" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="display: flex;    flex-direction: row;    justify-content: center;    margin: auto;">

                    <div class="card-body p-4 p-sm-5">
                        <div class="réseau-sociaux">
                            <h3 class="text-center">Connectez-Vous Avec</h3><br>
                            <p class="text-center">
                                <a  href="{{route('login.facebook')}}"><img style="width:10%" src="{{asset('/img/f.png  ')}}" alt=""></a>
                                <a  href="{{route('login.google')}}"><img style="width:10%;margin-left: 50px" src="{{asset('/img/gmail.png  ')}}" alt=""></a>
                                <a  href="{{route('login.linkedin')}}"><img src="{{asset('/img/l.png  ')}}" style="width:10%;margin-left: 50px " alt=""></a>
                            </p>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <h5 class="m-0 text-center or_styling">Ou Bien</h5>
                        </div>
                        <br>
                        <form action="{{route('connexion_trait')}}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control w-100" id="floatingInputEmail"
                                       placeholder="name@example.com">
                                <label for="floatingInputEmail">Email address</label>
                            </div>


                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control w-100" id="floatingPassword"
                                       placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>



                                <div class="container overflow-hidden">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <a href=""><h5>Mot de Passe Oubliée ?</h5></a>
                                    </div>
                                    <div class="col col-md-6">
                                            <button class="btn btn-danger" type="submit">Connexion</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


            </div>

        </div>
        </div>
    </div>

@endsection
