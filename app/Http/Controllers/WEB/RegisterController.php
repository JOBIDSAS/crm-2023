<?php

namespace App\Http\Controllers\WEB;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Self_;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function reg_page()
    {
        return view('web.connexion.register');
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        $user = auth()->user();
        switch ($user->role) {
            case "tpe":
                $client=new User();
                $client->user_id=auth()->user()->id;
                $client->save();
                return
                    route("home");

                break;
            case "ag":
                $client=new User();
                $client->user_id=auth()->user()->id;
                $client->save();
                return route("contact");
                break;
            case "col":
                $client=new User();
                $client->user_id=auth()->user()->id;
                $client->save();
                return route("actuality");
                break;
            default:
                return route("home");
        }
    }
    public function trait_reg(Request $request){
//    dd($request->all());
//        $rules=    [
//            'first_name' => 'required',
//            'email' => 'required | unique:users,email',
//            'password'=>'required | confirmed',
//            'password_Confirmation'=>'required',
//'inlineRadioOptions'=>'in:tpe,ag,col'
//        ];
//        $messages=    [
//            'first_name.required' => 'Ce champ est obligatoire',
//            'email.required' => 'Ce champ est obligatoire',
//            'email.unique' => "l'email doit etre unique",
//            'password.required'=>'Ce champ est obligatoire',
//            'password_Confirmation.required'=>'Ce champ est obligatoire',
//
//        ];
//        $validator = Validator::make($request->all(),$rules,$messages);
//        if($validator->fails()){
//            return redirect()->back()->withErrors($validator)->withInputs($request->all());
//        }


        //to do check if mail already exist
//        request()-> validate([
//            'first_name' => ['required'],
////            'last_name' => ['required'],
//            'email' => ['required','email'],
//            'password' => ['required','confirmed','min:8'],
//            'password_confirmation' => ['required'],
//        ],
//            [
//                'password.min'=> 'Pour des raisons de sécurité,votre mot de passe doit faire :min caractères.'
//            ]);


        $user=new User();
        $user->first_name=$request->first_name;
//        $user->last_name= $request->last_name;
        $user->email= $request->email;
        $user->password= bcrypt($request->password);
        $user->verification_code=date('Y-m-d H:i:s');;
        $user->role=$request->inlineRadioOptions;
        $user->save();
        if  ($user!=null)
        {
            VerfiedController::sendSignupEmail($user->first_name,$user->email,$user->verification_code);
            return redirect()->back()->with(session()->flash('alert_success','Compte Crée avec succées.Please Check your Email for verification'));
        }
        //

        if($request->inlineRadioOptions=='tpe')
        {
            return redirect('/home');
        }
        elseif ($request->inlineRadioOptions=='ag')
        {
            return redirect('/contact');
        }
        elseif ($request->inlineRadioOptions=='col')
        { return redirect('/actuality'); }
        else {
            return 'vous avez besoins de choisir une bouton !';
        }

//        return redirect()->back()->with(session()->flash('alert_danger','something went wrong  '));
    }

}

