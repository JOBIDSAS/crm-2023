@extends('web.layouts.app')

@section('content')
        <style>

            h1 {
                text-align: center;
                font-family: Tahoma, Arial, sans-serif;
                color: #06D85F;
                margin: 80px 0;
            }

            .box {
                width: 40%;
                margin: 0 auto;
                background: rgba(255,255,255,0.2);
                padding: 35px;
                border: 2px solid #fff;
                border-radius: 20px/50px;
                background-clip: padding-box;
                text-align: center;
            }

            .button {
                font-size: 1em;
                padding: 10px;
                color: #fff;
                border: 2px solid #06D85F;
                border-radius: 20px/50px;
                text-decoration: none;
                cursor: pointer;
                transition: all 0.3s ease-out;
                background: black;
            }
            .button:hover {
                background: #06D85F;
            }

            .overlay {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(0, 0, 0, 0.7);
                transition: opacity 500ms;
                visibility: hidden;
                opacity: 0;
            }
            .overlay:target {
                visibility: visible;
                opacity: 1;
            }

            .popup {
                margin: 70px auto;
                padding: 20px;
                background: #111d5e;
                border-radius: 40px;
            ;
                width: 30%;
                position: relative;
                transition: all 5s ease-in-out;

            }

            .popup h2 {
                margin-top: 0;
                color: #333;
                font-family: Tahoma, Arial, sans-serif;
            }
            .popup .close {
                position: absolute;
                top: 20px;
                right: 30px;
                transition: all 200ms;
                font-size: 30px;
                font-weight: bold;
                text-decoration: none;
                color: white;
            }
            .popup .close:hover {
                color: #06D85F;
            }
            .popup .content {
                max-height: 30%;
                color: white;
            }

            @media screen and (max-width: 700px){
                .box{
                    width: 70%;
                }
                .popup{
                    width: 70%;
                }

            }
        </style>

        <div class="box">
            <a class="button" href="#popup1">Let me Pop up</a>
        </div>

        <div id="popup1" class="overlay">
            <div class="popup">
                <div class="pop_img">
                    <img style="  width: 20%;
                    position: relative;
                    left: 150px;" class="img_pop" src="{{asset('img/cpn-logo-250.png')}}" alt="">

                </div>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    <div>
                    <p style="text-align: center;padding:11px">Abonnez-vous à Newsletter pour rester informer sur toute nouvelles informations </p>
                    </div>
                    <div class="row g-2 px-2">

                        <div class="col">
                            <input style="height: 100%;width: 100%;border-radius: 0.25rem;" type="text" name="f_name" class="form-control" placeholder=" Nom" required>
                         </div>

                        <div class="col">
                            <input style="height: 100%;
                            width: 100%;
                            border-radius: 0.25rem;" type="text" name="fl_name_name" class="form-control" placeholder=" Prénom"required>
                        </div>
                    </div>
                    <div style="padding: 10px;">
                    <input type="email" name="email" class="form-control" placeholder="Email "required>
                    </div>
                    <div style="padding: 10px;">
                        <input type="text" name="phone" class="form-control" placeholder="Numéro Téléphone" required>
                    </div>
                    <div>
                        <button style="position: relative; left: 150px  " type="button" class="btn btn-sm btn-danger" >
                                Envoyer
                        </button>
                    </div>
                       </div>
            </div>
        </div>
@endsection
