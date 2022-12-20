@extends('web.layouts.app')

@section('content')
    @if(auth()->guest())
  <div class="agenda_container">
    <div class="agenda_wrapper">
      <div class="container pt-4 px-4 g-0">
        <div class="row g-0 align-items-center justify-content-center">
          <div class="col-md-6">
            <div class="row g-0 justify-content-center">
              <div class="col-md-8 d-flex flex-column justify-content-center align-items-center">
                <h1 style="font-weight:700; text-align:center; color:#111D5E">Choisissez votre rendez-vous</h1>
                <a style="border: none;
                    background: red;
                    border-radius: 25px;
                    color: white;
                    padding: 5px 15px;" href="{{route('login')}}" class="btn btn-danger">rendez-vous</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row justify-content-center align-items-center">
              <img style="width:100%" src="http://localhost/public//img/calendar.png" alt="calendar">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    @else
        <div class="agenda_container">
            <div class="agenda_wrapper">
                <div class="agenda_content">
                    <div class="calendar_date" id="calendarContainer"></div>
                    <div class="calendar_event" id="organizerContainer"></div>
                </div>
            </div>
        </div>
    @endif
  <script src="{{asset('js/calendar+.js')}}"></script>

@endsection
