@extends('web.layouts.app')

@section('content')
    <style>
        .primary_body .row .form-control
        {
            width: 100%;

        }
    </style>
  <div class="contact_container">
    <div class="contact_wrapper">
      <section class="goolge_map">
          <div style="padding: 10px 0 0 0;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2618.488730301625!2d2.4286297150925718!3d48.982256099932144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66b3cb769345d%3A0x13d4251fce224e53!2sOff%20Agency!5e0!3m2!1sfr!2stn!4v1628594788116!5m2!1sfr!2stn" width="1500" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>      </section>
        </div>
        <section class="section_contact">
          <div class="container pt-4 px-4 g-0">
            <h2 style="margin:0; font-weight:800">Contactez-nous</h2>

            <div class="row mt-5 g-5" >
              <div class="col-md-6">
                <form class="row g-4" action="">
                  <div class="col-md-6">
                    <input class="form-control" type="text" placeholder="Nom">
                  </div>
                  <div class="col-md-6">
                    <input class="form-control"  placeholder="Prénom">
                  </div>
                  <div class="col-md-12">
                    <input class="form-control" placeholder="Email">
                  </div>
                  <div class="col-md-12">
                    <textarea class="form-control" placeholder="Votre message"></textarea>
                  </div>
                  <div class="col-md-12">
                    <input id="check-box" type="checkbox" class="">
                    <label for="check-box" style="color: darkgray">j'ai lu et accepté les CGU et la Politique de confidentialité</label>
                  </div>
                  <div class="col-md-12 d-flex justify-content-end">
                  <button style="border: none;
                  background: red;
                  border-radius: 25px;
                  color: white;
                  padding: 5px 15px;">Envoyez</button>
                  </div>
                </form>
              </div>

                <div class="col-md-6">
                <ul style="margin:0; padding: 0; display: flex; flex-direction: column; justify-content: center; align-items: center;" class="items">
                  <li style="list-style: none; width: 300px;" class="item_list">
                    <h3 style="margin:0; color:#111D5E; font-weight:700">Notre adresse</h3>
                    <p style="color:#111D5E">31 Rue de Professeur Esclangon</p>
                  </li>
                  <li style="list-style: none; width: 300px;" class="item_list">
                    <h3 style="margin:0; color:#111D5E; font-weight:700">Notre numéro</h3>
                    <p style="color:#111D5E">+33 6 73 46 65 64</p>
                  </li>
                  <li style="list-style: none; width: 300px;" class="item_list">
                    <h3 style="margin:0; color:#111D5E; font-weight:700">Notre email</h3>
                    <p style="color:#111D5E">votreconseiller@cpn-aide-aux-entreprise.com</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>
    </div>

      </div>

@endsection
