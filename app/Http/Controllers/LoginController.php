<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function login(){
        $data = array(
            'loginAction' => route('/login_action'),
            'signupBtn' => route('signup')
        );

        return view('login.login',$data);
    }

    public function loginAction(Request $request){
        $this->rules($request);
        $email = $request->input('email');
        $password = $request->input('password');
        
        $loginModel = new Login();
        $checkUserExist = $loginModel->checkUserEmailExist($email);
        if(!empty($checkUserExist)){
            $userData = $loginModel->getData($email);

            if(Hash::check($password,$userData['password'])){

                    Session::put('id',$userData['id']);
                    Session::put('email',$userData['email']);
                    // Session::put('userType',$userData['userType']);
                    Session::put('is_login',TRUE);
                // if($userData['userType']==1){
                //     return redirect()->route('buyer.list');
                // }else{
                //     return redirect()->route('broker.list');
                // }
                
                
                return redirect()->route('home');
            }else{
             return redirect()->route('admin')->with('alert','Invalid Credential')->class('');
            }
        }else{
                return redirect()->route('admin')->with('alert','User Not Found');
        }
    }

    public function rules($request)
    {

      $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            ],
            [
            'email.required'    => 'Please enter email.',
            'password.required'    => 'Please enter password.',
            ]
        );
    }

    public function signup(){
        $data = array(
            'signupAction' => route('signup_action')
        );

        return view('login.signup',$data);
    }

    public function signup_rules($request)
    {
      $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'confirm_password' => 'required',
            'password' => 'required|same:confirm_password',
            ],
            [
            'name.required'    => 'Please enter name.',
            'email.required'    => 'Please enter email.',
            'confirm_password.required'    => 'Please enter confirm password.',
            'password.required'    => 'Please enter password.',
            ]
        );
    }
    
    public function signupAction(Request $request){ 
        $this->signup_rules($request);
        $userModel = new User();

        $userModel->name = $request->name; 
        $userModel->email = $request->email; 
        $userModel->password = $request->password; 
        if($userModel->save()){
            return redirect()->route('admin')->with('alert','Please Login with New Credential');
        }else{
        return redirect()->route('signup')->with('alert','Invalid Credential');
        }
    }


    public function dashboard(){
        $data = array(
            'dashboard' => route('home')
        );
        return view('dashboard.home',$data);
    }

    public function logout(){
        Session::flush();
         return redirect()->route('admin');
    }
}