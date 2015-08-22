<?php

// Session::put('user_id', 112);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Route::get('/authtest', array('before' => 'auth.basic', function()
// {
//     return View::make('hello');
// }));

// // Route group for API versioning
// Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
// {
//     Route::resource('url', 'UrlController');
// });

// Route::group(array('prefix' => 'admin'), function(){
//     Route::get('login', array('as' => 'admin.login', 'uses' => 'AdminAuthController@getLogin'));
//     Route::post('login', array('as' => 'admin.login.post', 'uses' => 'AdminAuthController@postLogin'));
//     Route::get('logout', array('as' => 'admin.logout', 'uses' => 'AdminAuthController@getLogout'));
// });

Route::get('/', function()
{
	
    return View::make('index');
});

// Route::get('/admin/session', function()
// {
// 	$session_id = Request::get('session_id');
// 	$user = User::where('session_id', $session_id) = get();
// 	$user = $user->lists('session_id');
// 	if (!empty($member)){
// 	// foreach ($user as $use) {
// 	// 	if (!empty($user->session_id) {
// 		return View::make('session');	
// 		}
// 	// } else {
// 	// 	return 'you are stupid'
// 	// }
    
// });

// Route::get('/authtest', array('before' => 'auth.basic', function()
// {
//     return View::make('hello');
// }));
// Auth::loginUsingId(1);
// Auth::loginUsingSession_id(123);
Route::get('/authtest', function()
{
	// Auth::loginUsingId(1);
			// $user = User::find(1);
			// Auth::login($user);
	Auth::attempt(['admin_id' => 'firstdmin@school.edu', 'password' => '123456']);
	if (Auth::check()){
		return Redirect::to('/');
	}
    return View::make('hello');
});

// Route group for API versioning
// Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
// {
//     Route::resource('member', 'MemberController');
// });



// Session::set('sesija',123);
Route::group(['prefix' => 'admin'], function() {
	
	// if (Auth::attempt(array('admin_id' => Request::get('admin_id'), 'password' => Request::get('password')))){

// echo Auth::user()->laravel_session;
	// Route::group(['prefix' => 'admin', 'after' => 'allowOrigin'], function() {
		// Route::post('/login', function () {
		// 	Auth::attempt(['admin_id' => Request::get('admin_id'), 'password' => Request::get('password')]);
		// 	if(Auth::attempt(['admin_id' => Request::get('admin_id'), 'password' => Request::get('password')])){
		// 		$dashboard = Dashboard::get();
	 //        	$response =  Response::json(['dashboard' => $dashboard->toArray()
	 //        	]);
	 //        	//$response->headers->set('Content-type', 'application/json');
	 //        	return $response;
	 //        }
	 //        return 'Check your admin_id/pass combo';
 	//     });

	Route::post('login', array('as' => 'admin.login', 'uses' => 'AuthController@Login'));
	Route::post('logout', array('as' => 'admin.logout', 'uses' => 'AuthController@Logout'));

	Route::post('/forgottenpassword', function () {
	    	$email = Request::get('email_address');
	    	// var_dump($email);
	    	// $session_id = Request::get('Session-Id');
	    	// var_dump($session_id);
	    	// $member = DB::table('members')->where('email_address', $email)->first();
	    	// $member = Member::where('email_address', $email)->first();
	    	$member = Member::where('email_address', $email)->get();
	    	// var_dump($member);die();
			    	$member = $member->lists('email_address');
			    	// var_dump($member->lists('email_address'));die();
			    	// var_dump($member); die();
			    	// $member = $member->toArray();
			    	// $member_email = $member[0]["email_address"];
			    	// var_dump($member_email);
	    	// var_dump($member_email); die();
	    	// echo $member[0]["email_address"]; die();
	    	// if (strcmp($email, $member_email) !== 0){
	    	// if ($email === $member_email){
	    	if (!empty($member)){
	    	// if (isset($member)){
		    // if ($member){
	        	return Response::json(['msg' => 'Confirmation email sent.'
	        	]);
    		} else {
    		// if (!isset($member)) {
				return Response::json(['msg' => 'Please, check again email address you entered.'
				]);
    		}
	});
	// }

	// if (Request::get('cookie'){
// $user = User::get();
// if(isset(Auth::user()['session_id'])){
// if(isset(Auth::user()){ 

				    // Route::get('/all-members', array('before' => 'MyFilter', function () {
				    // 	$members = Member::where('status', '1')->get();
			     //    	return Response::json(['members' => $members->toArray()
			     //    	]);
				    // }));
	    // Route::get('/all-members', array('before' => 'myFilter'), function () {
	    Route::get('/all-members', [ 'before' => 'auth', function () {
	    	// $user = User::first();
	    	// if (!empty($user->session_id)){
	    	// $session_id = Request::get('Session-Id');
	    	// var_dump($session_id);
	    	$members = Member::where('status', '1')->get();
        	return Response::json(['members' => $members->toArray()
        	]);
        	// ])->header('Foo', 'Bar');  <-- ovako dodaje header u response
        	// } 
        	// return "Login first";
	    // });
		}]);
// }

	    // Route::post('/remove-member/{id}', function ($id) {
	    //     $member = Member::find($id);
	    //     $member->delete();

	    //     return Response::json(['status' => 200, 'mesg' => 'member deleted'
	    //     ]);	 
	    // });

	    Route::post('/remove-member', function () {
	    	$id = Request::get('id');
	    	$reason = Request::get('reason');
			// $member = Member::where('id', $id)->get();
	        $member = Member::find($id);
	        // echo $member;
	        $member->delete();

	        // return Response::json(['status' => 200, 'mesg' => 'Member deleted - '.$reason
	        // ]);	 
	        // return Response::json();	 
	    });
//EVO RESENJA ZA ZASTITU RUTA!!!!!!! TREBALO BI, ALI SAD NECE DA RADI!!!!
	    Route::get('/join-requests', function () {
	    	if (Auth::check()){
	    	$members = Member::where('status', '0')->get();
        	return Response::json([ $members->toArray()
        	]);
        	}
        	return 'Login first';
	    });

	    // Route::post('/join-requests/accept/{id}', function ($id) {
	    // 	$member = new Member;
	    // 	$member->member = Request::get(id);
	    // 	$member->status = '1';
	    	
		   //  $member->save();

     //    	return Response::json(['status' => 200, 'mesg' => 'member added'
     //    	]);
	    // });

	    // Route::post('/join-requests/accept/{id}', function ($id) {
	    // 	$members = Member::where('id', Request::get('id'));
	    // 	$member->status = '1';
	    	
		   //  $member->save();

     //    	return Response::json(['status' => 200, 'mesg' => 'member added'
     //    	]);
	    // });

	  //   Route::post('join-requests', function () {
	  //   	$accept = Request::get('accept');
	  //   	$reject = Request::get('reject');
			
			// // $members = Member::find($id);

	  //   	if($accept!='')
	  //   	{ 
	  //   		$id = $accept;
	  //   		$members = Member::find($id);   	
	  //   		$members->status='1';
	  //   		$members->save();
	  //   	}
	  //   	// elseif($reject!='')
	  //   	if($reject!='')
	  //   	{
	  //   		$id = $reject;
	  //   		$members = Member::find($id);  
	  //   		$members->delete();
	  //   	}

	  //   	return Response::json(['status' => 200, 'mesg' => 'Membership join-requests updated']);

	    	
   //      });

//NESTED JSON OBJECT
	    Route::post('join-requests', function () {
	    	$accept = Request::get('accept');
	    	$numberOfAcceptIds = count($accept);
	    	$numberA = $numberOfAcceptIds-1;
	    	// var_dump($accept[0]['id']);
	    	// var_dump($accept[1]['id']);
	    	// var_dump($numberOfAcceptIds);

	    	$reject = Request::get('reject');
	    	$numberOfRejectIds = count($reject);
	    	$numberR = $numberOfRejectIds-1;
	    	// var_dump($numberR);
	    	// var_dump($reject[0]['id']);
	    	// var_dump($reject[1]['id']);
			


	    	if($accept!='') {

		    	for ($i=0; $i <= $numberA; $i++) {
		    			$id = $accept[$i]['id'];
			    		$members = Member::find($id);  
			    		$members->status='1';
			    		$members->save();
			    		// continue;

		    	}
		    // echo "Izasao iz for loopa";
		    } 
		    
		    if ($reject!='') {

		    	for ($n=0; $n <= $numberR; $n++) {
		    			$id = $reject[$n]['id'];
			    		$members = Member::find($id);  
			    		$members->delete();
		    	}

		    }

		    // if($reject!='') {


		    // }

	    	return Response::json(['status' => 200, 'mesg' => 'Membership join-requests updated']);
	    	
        });


	    // Route::post('/join-requests/reject/{id}', function ($id) {
	    // 	$members = Member::where('id', Request::get('id'))->find($id);
	    	
		   //  $member->delete();

     //    	return Response::json(['status' => 200, 'mesg' => 'member rejected'
     //    	]);
	    // });
//JOS JEDNO RESENJE ZA ZASTITU RUTA
	    Route::get('/community-settings', function () {
	    	$login = Login::first();
	    			if(!empty($login->login_session)){
	    	// $access_token = Request::header('Session-Id');
		    	// var_dump(Request::input('Session-Id'));die();
		    	// $access_token = Input::get('Session-Id');

		    	// if($access_token = 567){
			$settings = Settings::get();
        	return Response::json(['settings' => $settings->toArray()
        	]);
		        	}
		        	return 'Login first';
	    });

	  //   Route::put('/community-settings', function () {
	  //   	$settings = new Settings;
		 //    $settings->color1 = Request::get('color1');
		 //    $settings->color2 = Request::get('color2');
		 //    $settings->color3 = Request::get('color3');
		 //    $settings->welcome_logo = Request::get('welcome_logo');
			// $settings->app_header = Request::get('app_header');
		 //    $settings->settings = Request::get('menu_header');
		 
		 //    $settings->save();

   //      	return Response::json(['status' => 200, 'mesg' => 'settings updated'
   //      	]);
	  //   });


	  //   Route::put('/community-settings/{id}', function ($id) {
			// // $settings = new Settings;
			// $settings = Settings::find($id);
			// // # = %23

		 // 	//return Response::json(  print_r(Input::all()) );
		 //    if ( Request::get('color1') )
		 //    {
		 //        $settings->color1 = Request::get('color1');
		 //    }
		 
		 //    if ( Request::get('color2') )
		 //    {
		 //        $settings->color2 = Request::get('color2');
		 //    }

		 //    if ( Request::get('color3') )
		 //    {
		 //        $settings->color3 = Request::get('color3');
		 //    }

		 //    if ( Request::get('welcome_logo') )
		 //    {
		 //        $settings->welcome_logo = Request::get('welcome_logo');
		 //    }

		 //    if ( Request::get('app_header') )
		 //    {
		 //        $settings->app_header = Request::get('app_header');
		 //    }

		 //    if ( Request::get('menu_header') )
		 //    {
		 //        $settings->menu_header = Request::get('menu_header');
		 //    }
		 
		 //    $settings->save();

   //      	return Response::json(['status' => 200, 'mesg' => 'settings updated'
   //      	]);
	  //   });

	    Route::post('/community-settings', function () {
	    	//settings with id=1
	    	// $color1 = Request::getPutData('color1');
	    	$color1 = Request::get('color1');
	    	// echo $color1;
	    	$color2 = Request::get('color2');
	    	// echo $color2;
	    	$color3 = Request::get('color3');
	    	// echo $color3;
	    	$welcome_logo = Request::get('welcome_logo');
	    	$app_header = Request::get('app_header');
	    	$menu_header = Request::get('menu_header');

			$settings = Settings::find(1);
			// // # = %23

		 // 	//return Response::json(  print_r(Input::all()) );
		 //    // $settings->color1 = $color1;
		 //    // $settings->color2 = $color2;
		 //    // $settings->color3 = $color3;
		 //    // $settings->welcome_logo = $welcome_logo;
		 //    // $settings->app_header = $app_header;
		 //    // $settings->menu_header = $menu_header;

		    if ($color1)
		    {
		        $settings->color1 = $color1;
		    }
		 
		    if ($color2)
		    {
		        $settings->color2 = $color2;
		    }

		    if ($color3)
		    {
		        $settings->color3 = $color3;
		    }

		    if ($welcome_logo)
		    {
		        $settings->welcome_logo = $welcome_logo;
		    }

		    if ($app_header)
		    {
		        $settings->app_header = $app_header;
		    }

		    if ($menu_header)
		    {
		        $settings->menu_header = $menu_header;
		    }
		 
		    $settings->save();

        	return Response::json(['status' => 200, 'mesg' => 'Settings updated'
        	]);
	    });


	    // Route::post('/join-requests/reject/{id}', function ($id) {
	    // 	$members = Member::where('status', '0')->find($id);

		   //  if ( Request::get('id') = $member->id )
		   //  {
		   //      $member->status = 1;
		   //  }
		   //  $member->save();

     //    	return Response::json(['status' => 200, 'mesg' => 'member rejected'
     //    	]);
	    // });

	// });
	// } 
});
