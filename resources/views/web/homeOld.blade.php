@extends('web.layouts.app')

@section('content')
    <style>
        .outer-div,
        .inner-div {
            height: 378px;
            max-width: 300px;
            margin: 0 auto;
            position: relative;
        }

        .outer-div {
            perspective: 900px;
            perspective-origin: 50% calc(50% - 18em);
        }

        .inner-div {
            margin: 0 auto;
            border-radius: 5px;
            font-weight: 400;
            color: black;
            font-size: 1rem;
            text-align: center;
            transition: all 0.6s cubic-bezier(0.8, -0.4, 0.2, 1.7);
            transform-style: preserve-3d;
        }

        :hover .social-icon {
            opacity: 1;
            top: 0;
        }

        /*&:hover .front__face-photo,
        &:hover .front__footer {
          opacity: 1;
        }*/


        .outer-div:hover .inner-div {
            transform: rotateY(180deg);
        }

        .front,
        .back {
            position: relative;
            top: 0;
            left: 0;
            backface-visibility: hidden;
        }

        .front {
            cursor: pointer;
            height: 85%;
            background: white;
            backface-visibility: hidden;
            border-radius: 5px;
            box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3),
            0 0 40px rgba(0, 0, 0, 0.1) inset;
        }


        .front__face-photo1 {
            position: relative;
            top: 10px;
            height: 120px;
            width: 120px;
            margin: 0 auto;
            border-radius: 50%;
            border: 5px solid white;

            background-size: contain;
            overflow: hidden;
            /* backface-visibility: hidden;
             transition: all 0.6s cubic-bezier(0.8, -0.4, 0.2, 1.7);
             z-index: 3;*/
        }


        .front__face-photo2 {
            position: relative;
            top: 10px;
            height: 120px;
            width: 120px;
            margin: 0 auto;
            border-radius: 50%;
            border: 5px solid white;
            background-size: contain;
            overflow: hidden;
            /* backface-visibility: hidden;
             transition: all 0.6s cubic-bezier(0.8, -0.4, 0.2, 1.7);
             z-index: 3;*/
        }


        .front__face-photo3 {
            position: relative;
            top: 10px;
            height: 120px;
            width: 120px;
            margin: 0 auto;
            border-radius: 50%;
            border: 5px solid white;
            background-size: contain;
            overflow: hidden;
            /* backface-visibility: hidden;
             transition: all 0.6s cubic-bezier(0.8, -0.4, 0.2, 1.7);
             z-index: 3;*/
        }

        .front__text {
            position: relative;
            top: 35px;
            margin: 0 auto;
            font-family: "Montserrat";
            font-size: 18px;
            backface-visibility: hidden;
        }

        .front__text-header {
            font-weight: 700;
            font-family: "Oswald";
            text-transform: uppercase;
            font-size: 20px;
        }

        .front__text-para {
            position: relative;
            top: -5px;
            color: #000;
            font-size: 14px;
            letter-spacing: 0.4px;
            font-weight: 400;
            font-family: "Montserrat", sans-serif;
        }

        .front-icons {
            position: relative;
            top: 0;
            font-size: 14px;
            margin-right: 6px;
            color: gray;
        }

        .front__text-hover {
            position: relative;
            top: 10px;
            font-size: 10px;
            color: red;
            backface-visibility: hidden;

            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;

            border: 2px solid red;
            padding: 8px 15px;
            border-radius: 30px;

            background: red;
            color: white;
        }


        .back {
            transform: rotateY(180deg);
            position: absolute;
            top: 0;
            left: 0;
            height: 85%;
            width: 100%;
            background-color: black;
            border-radius: 5px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

/*.wavy{*/
/*    position: relative;*/
/*    width: 150px ;*/
/*    height: 150px;*/
/*    overflow: hidden;*/
/*}*/
/*.wavy::before*/
/*{*/
/*    content: "Ghazi";*/
/*    position: absolute;*/
/*    top: -42px;*/
/*    left: 0;*/
/*    color: transparent;*/
/*    font-size: 4rem;*/
/*    text-decoration-style: wavy;*/
/*    text-decoration-color: red;*/
/*    text-decoration-line: underline;*/
/*    animation: animate 2s linear infinite;*/
/*}*/
/*@keyframes animate  {*/
/*    0%*/
/*    {*/
/*        transform: translateX(-1px);*/
/*    }*/
/*    100%*/
/*    {*/
/*        transform: translateX(-50px);*/
/*    }*/

/*}*/
    </style>
    <div class="home_container">
        <section class="section_heading mb-3">
            <div class="heading_wrapper container-fluid g-0">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="row g-0 justify-content-center">
                            <div class="col-auto">
                                <div class="img_wrapper">
                                    <img class="heading_img" src="{{asset('img/33.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 p-3">
                        <div class="row g-0 justify-content-start">
                            <div class="col-md-auto">
                                <h2 class="title_heading">Transition Numérique</h2>
                                <h4 class="desc_heading">2021</h4>
                                <div class="search_bloc">
                                    <form class="search">
                                        <input class="search__input" placeholder="Search..." style="">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="our_success mb-3">
            <div class="success_wrapper container px-4 g-0">
                <div class="row g-0">

                    <div class="col-md-6 py-2">
                        <h5 class="success_txt">Notre succés</h5>
                        <h3 class="success_desc">Peut importe votre secteur d'acitivité nous vous offrons une
                            subvention</h3>
                    </div>
                    <div class="col-md-6 py-2">
                        <ul class="success_list">
                            <li class="success_item">
                                <h3><span class="item_num">562</span>K</h3>
                                <p class="item_desc">Entreprises</p>
                            </li>
                            <li class="success_item">
                                <h3><span class="item_num">10</span>K</h3>
                                <p class="item_desc">Subventions</p>
                            </li>
                            <li class="success_item">
                                <h3><span class="item_num">200</span>K+ </h3>
                                <p class="item_desc">Adhérants</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="card-blog mb-5">
            <div class="card_wrapper container px-4 g-0">
                <div class="row py-3 ">
                    <div class="col-md-4">
                        <div style="background: transparent; color: white; border: none"
                             class="card d-flex flex-column align-items-center justify-content-center">
                            <img style="height:50%;width:50%" src="{{asset('img/agent.png')}}" class="card-img-top"
                                 alt="...">
                            <div class="card-body py-0 d-flex flex-column justify-content-center align-items-center">
                                <h5 class="card-title">Subvention</h5>
                                <p class="card-text">Besoin d'un chèque Numérique</p>
                            </div>
                            <div class="card-footer py-0">
                                <a href="#" style="margin-top: 24px;border-radius: 20px;"
                                   class="test-btn3 btn btn-light">Testez Votre éligibilité</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: transparent; color: white; border: none"
                             class="card d-flex flex-column align-items-center justify-content-center">
                            <img style="height:50%;width:50%" src="{{asset('img/casque.png')}}" class="card-img-top"
                                 alt="...">
                            <div class="card-body py-0 d-flex flex-column justify-content-center align-items-center">
                                <h5 class="card-title">Accompagnement</h5>
                                <p class="card-text">Des Experts à votre disposition pour digitaliser votre
                                    entreprise</p>
                            </div>
                            <div class="card-footer py-0">
                                <a href="#" style="border-radius: 20px;" class="test-btn3 btn btn-danger">En savoir
                                    plus</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: transparent; color: white; border: none"
                             class="card d-flex flex-column align-items-center justify-content-center">
                            <img style="height:50%;width:50%" src="{{asset('img/money.png')}}" class="card-img-top"
                                 alt="...">
                            <div class="card-body py-0 d-flex flex-column justify-content-center align-items-center">
                                <h5 class="card-title">Financement</h5>
                                <p class="card-text">Obtenez le immédiatement sur votre devis ou facture</p>
                            </div>
                            <div class="card-footer py-0">
                                <a href="#" style="border-radius: 20px;" class="test-btn3 btn btn-light">En savoir
                                    plus</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="text-bloc g-0 mb-5">
            <div class="container px-4">
                <ul style="margin-left: 15px;" class="text_body">
                    <li style="font-size: 70px;color:#111d5e " class="text_content"></li>
                    <h1 style="margin-top: -75px;margin-left: -17px;color:#111d5e"> Conseils et Accompagnement</h1>
                </ul>
                <p style="padding-right: 25rem">Le CPN est un acteur majeur dans la transition digital des entreprises
                    nous subventionnons
                    et accompagnons tous type de projet de développement informatique nous vous orientons au-près
                    d’agence de développement vérifier et désigné.</p>

            </div>
        </section>
        <section class="divider g-0 mb-5">
            <div class="container px-4">
                <span class="divider_ligne"></span>
            </div>
        </section>

        <section class="actuality mb-5">
            <div class="float_actions">
                <ul class="actions_content">
                    <li class="action_items">
                        <a class="item_href" href="#">
                            <i class="ihref_logo"><img width="40%" src="{{asset('/img/Entreprise.png')}}" alt=""></i>
                            <p class="ihref_text">Entreprise</p>
                        </a>
                    </li>
                    <li class="action_items">
                        <a class="item_href" href="#">
                            <i class="ihref_logo"><img width="40%" src="{{asset('/img/Agence.png')}}"></i>
                            <p class="ihref_text">Agence</p>
                        </a>
                    </li>
                    <li class="action_items">
                        <a class="item_href" href="#">
                            <i class="ihref_logo"> <img width="40%" src="{{asset('/img/Collectivité.png')}}"> </i>
                            <p class="ihref_text">Collectivites</p>
                        </a>
                    </li>
                </ul>
            </div>

        </section>
        <section class="second-bloc">
            <div class="container px-4">
                <h2 style="color:#111d5e">Facilité & Rapidité</h2>
                <p style="    padding-right: 48rem;">
                    Tous les services du CPN Aide aux entreprises sont destinée aux petites et moyennes entreprises
                    et Start-up.
                </p>
                <p style="    padding-right: 48rem;">Nous faisons un suivie et donnons accès a notre réseau de
                    partenaires et d’entreprise pour favorisé leurs croissance.
                </p>
            </div>
{{--            <div class="wavy"></div>--}}
            <div style=" margin: -123px 0 0 470px;" class="outer-div">
                <div class="inner-div">
                    <div class="front">
                        <div class="front__face-photo1"><img style="width: 100%;" src="{{asset('img/icone-2.png')}}" alt=""></div>
                        <div class="front__text">
                            <h3 class="front__text-header">Agence</h3>
                            <p class="front__text-para">Grace au Cpn Soyez accompagné au prés d'agence garentie et
                                referencé</p>

                        </div>
                    </div>
                    <div class="back">
                        <span class="front__text-hover">Hover to Find Me</span>
                    </div>

                </div>
            </div>
            <div style="margin: -482px 0 0 851px;" class="outer-div">
                <div class="inner-div">
                    <div class="front">
                        <div class="front__face-photo2"><img style="width: 100%;" src="{{asset('img/icone-1.png')}}" alt=""></div>
                        <div class="front__text">
                            <h3 class="front__text-header">Transformation <br> digitale</h3>
                            <p class="front__text-para">Grace au Cpn Soyez accompagné au prés d'agence garentie et
                                referencé</p>

                        </div>
                    </div>
                    <div class="back">
                        <span class="front__text-hover">Hover to Find Me</span>
                    </div>

                </div>
            </div>
            <div style="margin : -2px 0 0 851px" class="outer-div">
                <div class="inner-div">
                    <div class="front">
                        <div class="front__face-photo3"> <img style="width: 100%;" src="{{asset('img/icone-3.png')}}" alt="">
                        </div>
                        <div class="front__text">
                            <h3 class="front__text-header">Financement <br> Imédiat</h3>
                            <p class="front__text-para">Grace au Cpn Soyez accompagné au prés d'agence garentie et
                                referencé</p>

                        </div>
                    </div>
                    <div class="back">
                        <span class="front__text-hover">Hover to Find Me</span>
                    </div>

                </div>
            </div>


        </section>

        <section class="third-bloc g-0 mb-5">
            <div class="container px-4 text-center">
                <h1 style="color: #111d5e">Pour obtenir votre subvention</h1>
                <p style="color: gray" class="subvention-text text-center">
                    Le CPN s'engage à vous mettre en relation avec une agence. <br>
                    Le cabinet vous permet d'obtenir une subvention sur votre <br>
                    développement informatique, et vous met a disposition également <br>
                    sont réseaux d'entreprises et de partenaire international.
                </p>
            </div>
            <div class="row">
                <div class="col">
                    <div style="border: 5px solid;    width: 30%;    margin-left: 190px;"></div>
                    <div class="vl" style="  border-left: 11px solid black;
  height: 140px;margin-left: 190px;position: absolute"></div>
                    <img style="margin-left: 190px;height:100%;width:100%" src="{{asset('img/old.jpeg')}}" alt="...">
                    <div class="vl"
                         style="  border-left: 11px solid black;  height: 140px;    margin: -130px 0px 0 740px;position: absolute"></div>
                    <div style="border: 5px solid;    width: 10%;    margin-left: 680px;"></div>

                </div>
                <div class="col" style="padding-top: 30px; padding-left: 110px;">
                    <div class="third-bloc-border" style="    border-radius: 20px;
border: 2px solid deepskyblue;
    width: 90%;
    padding: 20px;">
                        <h3>Accompagnement</h3>
                        <p>lorem ipsum</p>
                    </div>
                    <div class="third-bloc-border" style="    border-radius: 20px;
border: 2px solid deepskyblue;
    margin-top: 20px;
    width: 90%;
    padding: 20px;">
                        <h3>Sauvé de l'argent</h3>
                        <p>lorem ipsum</p>
                    </div>
                    <div class="third-bloc-border" style="    border-radius: 20px;
border: 2px solid deepskyblue;
    margin-top: 20px;
    width: 90%;
    padding: 20px;">
                        <h3>Réalisé vos projets</h3>
                        <p>lorem ipsum</p>
                    </div>

                </div>
            </div>
        </section>

        <section class="fourth-bloc" style="padding-top: 100px">
            <div class="container px-4">
                <div class="text-center">
                    <h1 style="color: #111d5e">Avis D'entreprises</h1>
                    <p style="color: gray" class="subvention-text text-center">
                        Ils nous ont fait confiance , ont été accompagnés par le CPN et ont réussi à avoir leur <br>
                        subventions
                    </p>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    <div class="col" style="margin-right: 50px;height: 315px; width: 270px;">
                        <div class="card h-100"
                             style="border: none;border-radius: 71px 14px 71px 14px;background-color: antiquewhite;padding: 40px;">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporties</p>
                            </div>

                        </div>
                        <div style=" position: relative;
    top: -132px;
    left: -116px;
    height: 100px;
    width: 100px;
    margin: 0 auto;
    border-radius: 50%;
    border: 5px solid white;
    background-size: contain;
    overflow: hidden;">
                            <img style="width: 120%;height: 120%" src="{{asset('img/avis 3.jpeg')}}" alt="">
                        </div>
                    </div>
                    <div class="col" style="margin-right: 50px;height: 315px; width: 270px;">
                        <div class="card h-100"
                             style="border: none;border-radius: 71px 14px 71px 14px;background-color: antiquewhite;padding: 40px;">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporties</p>
                            </div>

                        </div>
                        <div style=" position: relative;
    top: -132px;
    left: -116px;
    height: 100px;
    width: 100px;
    margin: 0 auto;
    border-radius: 50%;
    border: 5px solid white;
    background-size: contain;
    overflow: hidden;">
                            <img style="width: 120%;height: 120%" src="{{asset('img/avis 1.jpeg')}}" alt="">
                        </div>
                    </div>
                    <div class="col" style="height: 315px; width: 270px;">
                        <div class="card h-100"
                             style="border: none;border-radius: 71px 14px 71px 14px;background-color: antiquewhite;padding: 40px;">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporties</p>
                            </div>
                            <div>
{{--                                <img src="https://image.flaticon.com/icons/png/512/32/32371.png" alt="">--}}
                            </div>
                        </div>
                        <div style=" position: relative;
    top: -132px;
    left: -116px;
    height: 100px;
    width: 100px;
    margin: 0 auto;
    border-radius: 50%;
    border: 5px solid white;
    background-size: contain;
    overflow: hidden;">
                            <img style="width: 120%;height: 120%" src="{{asset('img/avis 2.jpeg')}}" alt="">
                        </div>
                    </div>


                </div>
            </div>
        </section>

    </div>

    <section class="point g-0 mb-5">
        <div class="container px-4 " style="    margin-bottom: 20px;">
            <textarea class="form-control" placeholder="Commentaire..." name="" id="" cols="30" rows="5" style="    width: 60%;
    border-radius: 8px;
    border: 2px solid #137feb;
    margin: auto;
    margin-top: 50px;"></textarea>
        </div>
        <div class="btn_post">
            <a href="#"
               style="text-decoration: auto;border: none;background: red;border-radius: 25px;color: white; margin-left: 910px;padding: 5px 15px;">Postuler</a>
        </div>
    </section>


    <script>
        $(document).ready(function () {
            $('.item_num').counterUp({
                time: 2000
            });
        });
    </script>
    <script>
        (function ($) {
            $('.search').mouseenter(function () {
                $(this).addClass('search--show');
                $(this).removeClass('search--hide');
            });

            $('.search').mouseleave(function () {
                $(this).addClass('search--hide');
                $(this).removeClass('search--show');
            });
        })(jQuery);
    </script>
@endsection
