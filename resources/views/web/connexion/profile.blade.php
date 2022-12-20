<style>
    body {
        background: aliceblue;
    }
    .action{
        position: fixed;
        top: 20px;
        right: 30px;
        margin-top: -10px;

    }
    .action .profile{
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }
    .action .profile img   {
        position: absolute;
        top: 0;
        left:  0;
        width: 100%;
        height: 100%;
        object-fit: cover;

    }
    .action .menu::before{
        content: '';
        position: absolute;
        top: -5px;
        right: 28px;
        width: 20px;
        height: 20px;
        background: #ffffff;
        transform: rotate(45deg);
    }
    .action .menu {
        position: absolute;
        top: 120px;
        right: -10px;
        padding: 10px 20px;
        background: #ffffff;
        width: 200px;
        box-sizing:  0 5px 25px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        transition: 0.5s;
        visibility: hidden;
        opacity: 0;
    }
    .action .menu.active {
        visibility: visible;
        opacity: 1;
        margin-top: -40px;
    }


    h3 {
        text-align: center;
        color : #000000;
    }

    .action .menu h3 {
        width: 100%;
        font-size: 18px;
        padding: 20px 0;
        font-weight: 500;
        color: #555555;
        line-height: 1.2rem;
    }
    .action .menu h3 span {
        font-size: 14px;
        color: #cecece;
        font-weight: 400;
    }
    .action .menu ul li
    {
        list-style: none;
        padding: 10px 0;
        border-top: 1px solid rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
    }
    .action .menu ul li img {
        max-width: 20px;
        margin-right: 10px;
        opacity: 0.5;
        transition: 0.5s;
    }
    .action .menu ul li:hover img {
        opacity: 1;
    }
    .action .menu ul li a{
        display: inline-block;
        text-decoration: none;
        color: #000000;
        font-weight: 500;
        transition: 0.5s;
    }
    .action .menu ul li:hover a {
        color: #000000;
    }

</style>
<body><div class="action">
    <div class="profile" onclick="menuToogle();">
        <img src="https://scontent.ftun10-1.fna.fbcdn.net/v/t1.6435-9/55496036_2290774981246196_4939820029488136192_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=uqDTqf5wamsAX-t_FWx&_nc_ht=scontent.ftun10-1.fna&oh=3ba41e3f32b45626bc54f79f9de68ad5&oe=614ED8C5" alt="avatar" width="50px" height="50px">
    </div>
    <div class="menu">
        <h3>Khalil Mecha<br><small>FullStack</small></h3>
        <ul>
            <li><img src="https://image.flaticon.com/icons/png/128/1946/1946429.png"><a href="#">Modifier profile</a></li>
            <li><img src="https://image.flaticon.com/icons/png/128/3342/3342137.png"><a href="#">Changer votre image</a></li>
            <li><img src="https://image.flaticon.com/icons/png/128/3064/3064197.png"><a href="#">Changer mot de passe</a></li>
            <li><img src="https://image.flaticon.com/icons/png/128/1828/1828427.png">
                <a href=""  onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">Déconnexion
                    <form id="logout-form" action="#" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
    </div>
</div>
</body>

<script>
    function menuToogle(){
        const toggleMenu = document.querySelector('.menu');
        toggleMenu.classList.toggle('active')
    }
</script>
@extends('web.layouts.app')

@section('content')
    <style>
        body {
            margin-top: 20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1.25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm > .col, .gutters-sm > [class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3, .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
    </style>
    <div class="container">
        <div class="main-body">


            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://scontent.ftun10-1.fna.fbcdn.net/v/t1.6435-9/55496036_2290774981246196_4939820029488136192_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=uqDTqf5wamsAX-t_FWx&_nc_ht=scontent.ftun10-1.fna&oh=3ba41e3f32b45626bc54f79f9de68ad5&oe=614ED8C5" alt="Admin"
                                     class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>Khalil Mecha</h4>
                                    <p class="text-secondary mb-1">Full Stack Developer</p>
                                    <p class="text-muted font-size-sm">Tunis,Wardia,Sousse</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    Website
                                </h6>
                                <span class="text-secondary">https://cpn.com</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-twitter mr-2 icon-inline text-info">
                                        <path
                                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                    </svg>
                                    Twitter
                                </h6>
                                <span class="text-secondary">@KhalilMecha</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-instagram mr-2 icon-inline text-danger">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>
                                    Instagram
                                </h6>
                                <span class="text-secondary">KhalilMecha</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-facebook mr-2 icon-inline text-primary">
                                        <path
                                            d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                    </svg>
                                    Facebook
                                </h6>
                                <span class="text-secondary">KhalilMecha</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom & Prénom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                   Khalil  Mecha
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    Khalilmecha@gmail.com
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    (216) XX XXX XXX
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    Tunis,Wardia,Sousse
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-danger " target="__blank" href="/edit_profile">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
@endsection
