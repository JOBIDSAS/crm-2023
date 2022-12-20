@extends('web.layouts.app')

@section('content')

  <div class="calendar_container">
    <div class="calendar_wrapper">
      <div class="container pt-4 px-4 g-0">
        <div class="calendar_info">
          <div class="row g-0 justify-content-center mb-3">
            <div class="col-auto">
              <div class="row justify-content-center">
                <div class="col-auto">
                  <div class="info_title d-flex flex-row">
                    <h1 class="info_text">Vous n'êtes pas disponible</h1>
                    <div class="info_bull">?</div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-auto">
                  <p class="info_desc">Programmer votre rendez-vous.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="calendar" id='calendar'></div>
        <div id="eventEditor" class="calendar_modal">
          <div class="modal_content">
            <div class="container_fluid">
              <div class="row p-2 g-0 justify-content-center">
                <div class="col-auto mb-3">
                  Changer l'événement
                </div>
                <div class="col-12 md-12 mb-3">
                  <input class="modal_input_custom w-100" id="eventName" name="eventName" type="text" disabled>
                </div>   
                <div class="col-12 md-12 mb-3">
                  <input class="modal_input_custom w-100" id="eventDate" name="eventDate" type="date">
                </div>         
                <div class="col-12 md-12 mb-3">
                  <input class="modal_input_custom w-100" id="eventTime" name="eventTime" type="time">
                </div>
                <div class="row justify-content-between g-0">
                  <div class="col-4">
                    <button id="eventCancel" class="modal_button_custom cancel w-100">Fermer</button>
                  </div>
                  <div class="col-4">
                    <button id="eventConfirm" class="modal_button_custom confirm w-100">Confirmer</button>
                  </div>
                </div>       
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('js/calendar.js')}}"></script>
@endsection