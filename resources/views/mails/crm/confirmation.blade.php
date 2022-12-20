<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/html1/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">  <title>Validation Rendez-vous</title>
  <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      background-color: #d8d7db !important;
    }
    *{
      font-family: "Poppins", sans-serif !important;
    }
    table {
      border-spacing: 0;
    }
    td {
      padding: 0;
    }
    img {
      border: 0;
    }
    .wrapper{
      width:100%;
      table-layout: fixed;
      background-color: white !important;
      padding-bottom: 40px;
    }
    .webkit{
      max-width: 600px;
    }
    .outer{
      Margin: 0 auto;
      width: 100%;
      max-width: 600px;
      border-spacing: 0;
      font-family: sans-serif;
      color: blueviolet;
    }

    @media screen and(max-width: 600px) {
    }
    @media screen and(max-width: 500px) {
    }
  </style>
</head>
  <body>
    <center class="wrapper">
      <div class="webkit">
        <table class="outer" align="center">

          <tr>
            <td>
              <table width="100%" style="border-spacing:0; padding:10px">
                <tr>
                  <td width="50"><a target="_blank" href="http://cpn-aide-aux-entreprises.com"><img width="50" height="40" src="http://crm.cpn-aide-aux-entreprises.com/public/img/logo-cpn2.png" alt=""></a></td>
                  <td>
                    <h1 style="margin:0; color:#111D5E; text-align:center">{{$data["date"]}}</h1>
                    <p style="margin:0; color:#111D5E; text-align:center">Lien zoom <a target="_blank" href="{{$data['join_url']}}"><img width="20" height="20" src="http://crm.cpn-aide-aux-entreprises.com/public/img/zoom.png" alt=""></a></p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table width="100%" style="border-spacing:0; padding:10px">
                <tr>
                  <td align="top">
                    <table width="100%" style="border-spacing:0">
                      <tr>
                        <td align="top">
                          <img style="margin-bottom: 10px;" width="120" src="http://crm.cpn-aide-aux-entreprises.com/public/img/valide-bouton.png" alt="">
                          <h2 style="margin:0; margin-bottom:20px; font-size:30px; color:#111D5E; text-transform:uppercase;">Félicitation, votre entreprise est éligible à <span style="margin:0; font-size:30px; color:#CE1212; text-transform:uppercase;">{{$data["amount"]}} €</span> </h2>
                        </td>
                      </tr>
                      <tr>
                        <td align="top">
                          <h3 style="margin:0; margin-bottom:20px; font-size:15px; color:gray">Votre conseiller numérique confirmera avec vous votre présence.</h3>
                        </td>
                      </tr>
                      <tr>
                        <td align="top">
                          <p style="margin:0; color:gray">Veuillez conserver ce mail d'invitation.</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td width="250">
                    <table width="100%" style="border-spacing:0">
                      <img width="250" src="http://crm.cpn-aide-aux-entreprises.com/public/img/man.jpg" alt="">
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table width="100%" style="border-spacing:0; padding:10px">
                <tr>
                  <td><h3 style="text-align:center; margin:0; color:#111D5E; font-size:25px; text-align:center">Rendez-vous</h3></td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table width="100%" style="border-spacing:0; padding:0 10px">
                <tr>
                  <td align="right" style="padding:0 10px">
                    <a style="text-align: center; text-decoration:none; color:#111D5E;" target="_blank" href="{{env('APP_URL')}}mail/confirm/{{$data['token']}}/{{$data['cid']}}">
                      <img style="text-align: center;" width="70" height="70" src="http://crm.cpn-aide-aux-entreprises.com/public/img/confirm.png" alt="">
                      <p style="text-align: right; margin:0;">Confirmer</p>
                    </a>
                  </td>
                  <td align="left" style="padding:0 10px">
                    <a style="text-align: center; text-decoration:none; color:#111D5E;" href="https://cpn-aide-aux-entreprises.com/cpn/agenda">
                      <img style="text-align: center;" width="70" height="70" src="http://crm.cpn-aide-aux-entreprises.com/public/img/change.png" alt="">
                      <p style="text-align: left; margin:0;">Changer</p>
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table width="100%" height="260" style="border-spacing:0; margin-top:20px; border-radius: 0 0 40px 40px; background:#111D5E; padding:10px">
                <tr>
                  <td>
                    <div style="margin-left: 183px;">

                        <img style="width:200px; height:200px; object-fit:cover; position:relative; top:0;border-radius: 22px;display: flex; flex-direction: row; align-items: center; " src="http://crm.cpn-aide-aux-entreprises.com/public/img/mailconfi.png" alt="">

                      <h2 style="margin-left:29px; width:75%;    font-size: 22px; color:white;">Martin cleave</h2>
                      <p style="width:75%; color:white;margin-left: 25px;">Conseiller numérique</p>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table width="100%" style="border-spacing:0; padding:10px">
                <tr>
                  <td>
                    <div style="width:100%; height:1px; background:#111D5E"></div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table width="100%" style="border-spacing:0; padding:10px;">
                <tr>
                  <td width="480">
                    <table width="100%" style="border-spacing:0">
                      <tr align="left" height="30">
                        <a target="_blank" href="mailto:Conseiller@cpn-aide-aux-entreprises.com" style="text-decoration: none;">
                          <td><img style="margin-right:5px;" width="20" src="http://crm.cpn-aide-aux-entreprises.com/public/img/mail.png" alt=""></td>
                          <td><p style="font-size:14px; line-height:14px; margin:0; color:#111D5E">Conseiller@cpn-aide-aux-entreprises.com</p></td>
                        </a>
                      </tr>
                      <tr align="left" height="30">
                        <a target="_blank" href="tel:0033184142394" style="text-decoration: none;">
                          <td><img style="margin-right:5px;" width="20" src="http://crm.cpn-aide-aux-entreprises.com/public/img/phone.png" alt=""></td>
                          <td><p style="font-size:14px; line-height:14px; margin:0; color:#111D5E">+33 1 87 66 04 83</p></td>
                        </a>
                      </tr>
                      <tr align="left" height="30">
                        <a target="_blank" href="https://www.cpn-aide-aux-entreprises.com" style="text-decoration: none;">
                          <td><img style="margin-right:5px;" width="20" src="http://crm.cpn-aide-aux-entreprises.com/public/img/website.png" alt=""></td>
                          <td><p style="font-size:14px; line-height:14px; margin:0; color:#111D5E">www.cpn-aide-aux-entreprises.com</p></td>
                        </a>
                      </tr>
                    </table>
                    </ul>
                  </td>
                  <td width="120">
                    <img width="120" src="http://crm.cpn-aide-aux-entreprises.com/public/img/logo-cpn-text.png" alt="">
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table width="100%" style="border-spacing:0; padding:10px">
                <tr>
                  <td>
                    <div style="width:100%; height:1px; background:#111D5E"></div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr align="center" >
            <td>
              <table style="border-spacing:0;">
                <tr align="center" style="display: flex;">
                  <td>
                    <a target="_blank" href="https://www.facebook.com/CPN.aideauxentreprises"><img style="width:40px" src="http://crm.cpn-aide-aux-entreprises.com/public/img/facebook_b.png" alt="facebook_b"></a>
                  </td>
                  <td>
                    <a style="margin:0 2px" target="_blank" href="https://www.instagram.com/cpn_aideauxentreprises"><img style="width:40px" src="http://crm.cpn-aide-aux-entreprises.com/public/img/instagram_b.png" alt="instagram_b"></a>
                  </td>
                  <td>
                    <a target="_blank" href="https://www.linkedin.com/company/76078573"><img style="width:40px" src="http://crm.cpn-aide-aux-entreprises.com/public/img/linkedin_b.png" alt="linkedin_b"></a>
                  </td>
                  <td>
                    <a style="margin:0 2px" target="_blank" href="https://www.youtube.com/channel/UC2KAUP-XzalYUGGPLEXBUBQ"><img style="width:40px" src="http://crm.cpn-aide-aux-entreprises.com/public/img/youtube_b.png" alt="youtube_b"></a>
                  </td>
                  <td>
                    <a target="_blank" href="tel:0033184142394"><img style="width:40px" src="http://crm.cpn-aide-aux-entreprises.com/public/img/whatsapp_b.png" alt="whatsapp_b"></a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr align="center">
            <td>
              <table style="border-spacing:0; padding: 30px 0">
                <tr align="center">
                  <td>
                    <a href="#" style="margin:0auto; text-decoration:none; color:white; padding:10px; border:none; outline:none; border-radius:20px; background:#CE1212;">S'inscrire à la newsletter</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table width="100%" style="border-spacing:0; background-color:#111D5E; padding:20px">
                <tr>
                  <td width="200">
                    <div style="width:100%">
                      <a href="#"><img width="50" src="http://crm.cpn-aide-aux-entreprises.com/public/img/logo-cpn3.png" alt=""></a>
                      <p style="margin:0; margin-top:10px; color:white; font-size:8px">Le cabinet de propulsion numérique aide les entreprises à se
                      propulser numériquement et à bénéficier de financement.
                      </p>
                      <p style="margin:0; margin-top:5px; color:white; font-size:8px">Le CPN est un organisme de finanacement à but non lucratif.</p>
                    </div>
                  </td>
                  <td width="400">
                    <table width="100%" style="border-spacing: 0;">
                      <tr>
                        <td align="center" width="120" style="vertical-align: top;">
                          <ul style="margin:0px;padding:0px; text-align:center">
                            <li style="list-style:none; color:white;">Liens</li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="https://www.facebook.com/CPN.aideauxentreprises">Facebook</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="https://www.instagram.com/cpn_aideauxentreprises">Instagram</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="https://www.linkedin.com/company/76078573">Linkedin</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="https://www.youtube.com/channel/UC2KAUP-XzalYUGGPLEXBUBQ">Youtube</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="tel:0033184142394">Whatsapp</a></li>
                          </ul>
                        </td>
                        <td align="center" width="120" style="vertical-align: top;">
                        <ul style="margin:0px;padding:0px; text-align:center">
                            <li style="list-style:none; color:white;">Support</li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="#Facebook">FAQ</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="#Facebook">Inscription</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="#Facebook">Connexion</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="#Facebook">Actualité</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" target="_blank" href="#Facebook">Contact</a></li>
                          </ul>
                        </td>
                        <td align="center" width="120" style="vertical-align: top;">
                          <ul style="margin:0px;padding:0px; text-align:center">
                            <li style="list-style:none; color:white;">Liens</li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" href="tel:0033184142394">+33 1 87 66 04 83</a></li>
                            <li style="list-style:none;"><a style="text-decoration:none; font-size:10px; color:white;" href="mailto:Conseiller@cpn-aide-aux-entreprise.com">Conseiller@cpn-aide-aux-entreprise.com</a></li>
                          </ul>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

        </table>
      </div>
    </center>
  </body>
</html>
