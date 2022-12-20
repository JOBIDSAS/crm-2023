<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="image/png" rel="icon" href="{{ asset('/img/logo.png') }}" sizes="16x16">
        <title>{{env('APP_NAME')}}</title>
        <meta csrf>
        <!-- javascripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBQpnb8OB6puCxOAeQ0xnMknhQUv_z6ZFc"></script>
        <script>(function(){
            window.laravel = {
                csrfToken: '{{ csrf_token() }}',
            };
        })();
        </script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/crm.css') }}">
    </head>
    <body>

            <div id="main">
                <!-- @if(Auth::check())
                    <crm :logged="true" :userdata="{{Auth::user()}}" :userlevel="'{{Auth::user()->level->name}}'"></crm>
                @else
                    <crm :logged="false" :userdata="'Null'" :userlevel="'Null'"></crm>
                @endif -->
            </div>

        <script type="text/javascript" src="{{ asset('/js/crm.js') }}"></script>
    </body>
</html>
