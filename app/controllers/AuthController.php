<?php
session_start();
class AuthController extends BaseController{

    public function Login(){
        // Auth::attempt(['admin_id' => Request::get('admin_id'), 'password' => Request::get('password')]);
        // return Auth::user();
        // if (Auth::attempt(['admin_id' => Request::get('admin_id'), 'password' => Request::get('password')], true)) {
        // if (Auth::attempt(['admin_id' => Request::get('admin_id'), 'password' => Request::get('password')], 'remember' => Input::has('remember'))) {
        // $var1 = Auth::attempt(['admin_id' => Request::get('admin_id'), 'password' => Request::get('password')], true);
        // if($var1){
         // if(Auth::attempt(['admin_id' => Request::get('admin_id'), 'password' => Request::get('password')])){
        if(Auth::attempt(['admin_id' => Input::get('admin_id'), 'password' => Input::get('password')])){
            // Auth::login();
            // $auth = true;
            // return Auth::user();
            Session::put('user_id', 123458);
         //    // Cookie::make('user_id', '123', 60);
            // return Auth::user();
         //    //         $id = Auth::user()->id;
         //    // // $user_data = Auth::user();
         //    // // Session::put('user_id', Auth::user()['id']);
         //    //         Session::set('user_id', $id);
         // // $_SESSION['login'] = md5(123456);
         // // // // $_SESSION['user_id'] = 111;
                         $id = Auth::user()->id;
                         // $user = User::find($id);
                         // Auth::login($user);
// Auth::loginUsingId($id);
                        $login = Login::find(1);
                        $login->user_id = $id;
                        $login->login_session = md5(rand());
                        $login->save();
                        // // echo $login->user_id;
                        // $login->login_session = 12345789;
                        // echo $login->login_session;
                        // $login->user_id = $id;
                        // $login->login_session = 12345;
                        // $login->login_session = 12345;

                        // $login->lists('login_session') = 123;
                        // var_dump($login);die();
                        
                        // $login->login_session = md5(123);
                        // $login->save();

             // $id = Auth::user()->id;
             $user = User::find($id);
              // $user->session_id = Session::getId();
             $user->session_id = Session::get('user_id');
             // $user->session_id = $_SESSION['user_id'];
             $user->save();

         //     $value = Request::get('cookies');
         // echo $_SESSION['Cookie'] = Input::get('sessionToken');
         // $_SESSION['Cookie'] = Request::header('Cookie');
         $dashboard = Dashboard::get();
         $response =  Response::json(['dashboard' => $dashboard->toArray()
         // ])->withCookie(Cookie::make('session-id', $_SESSION['login']));
         // ])->header('SessionID', $_SESSION['login'])->header('Content-Type', 'application/json')->withCookie('SessionID', Request::get('HTTP_COOKIE'));
         ]);



         return $response;
         // var_dump($user_data);

         // $session_id = $response->headers->get('Session-Id');
         // echo 'Grabbed'.$session_id;

         // var_dump($response->headers);
                            // $h1 = $response->headers->get('Session-Id');
                            // echo 'grabbing login sessid'.$h1;
         // echo 'grabbing login sessid'.Response::header('Session-Id');
                                 // $header = getallheaders();
            // ])->withCookie('login', $value);
         //$response->headers->set('Content-type', 'application/json');
         // echo 'Cookie='.$_COOKIE['session-id'];
         // echo 'SessionID = '.$_SESSION['login'];
         // echo Session::get('cookie');
            // echo $user->remember_token;
         // var_dump(Auth::user('remember_token')['id']);
         // return $response->withCookie('PHPSESID', 'value');
                                 // return $response->header('Content-Type', 'application/json');
         // var_dump($header);
        //  foreach ($response->getHeader('Set-Cookie') as $name => $values) {
        //     echo $name . ': ' . implode(', ', $values) . "\r\n";
        // }

         // var_dump($response);
         // return Auth::user();
         // print_r($_SESSION);
        } else {
            return 'invalid admin_id/pass combo';
        }

    }
    

    public Function Logout(){
        Auth::logout();
        // $auth = false;

            // $session = Session::first();
            // $session->login_session = null;
            // $session->save();
            $login = Login::first();
            $login->user_id = null;
            $login->login_session = null;
            $login->save();

             $user = User::first();
              // $user->session_id = Session::getId();
             $user->session_id = null;
             // $user->session_id = $_SESSION['user_id'];
             $user->save();

        session_destroy(); 
        return 'logged out';
    }

}