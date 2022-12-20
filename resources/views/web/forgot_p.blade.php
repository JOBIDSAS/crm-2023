@extends('web.layouts.app')

@section('content')
    <div class="register_container">
        <div class="register_content">
            <div class="register_wrapper">
                <form action="{{route('registre_trait')}}" method="post">
                    @csrf
                    <div class="row row d-flex align-items-center ">
                        <div class="col-md-6 g-3" >
                            <div class="container py-0">
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
                        <div class="col-md-6" style="height: 100%;">
                            <div class="row g-0 mb-3" style="flex: 1;">
                                <h2 style="color: #111d5e;text-align: center;">Mot de passe Oubliée</h2>
                            </div>
                            <div class="row mb-3 g-4" style="flex: 2;">
                                <div class="col-md-12">
                                    <input placeholder="Email"  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >
                                </div>

                            </div>
                            <div class="row justify-content-end">
                                <div class="row justify-content-end" style="flex: 1;">
                                    <div class="col-md-4">
                                        <button style="border: none;
                  background: red;
                  border-radius: 25px;
                  color: white;
                  padding: 5px 15px;    margin-top: 15px;" type="submit" class="btn btn-danger">Envoyer</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
