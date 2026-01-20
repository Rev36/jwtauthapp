<?php
declare(strict_types=1);

namespace App\Services\Auth;

// Request
use Illuminate\Http\Request;

//Facades
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use DB;
//Others
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;

class AuthService{

	/**
     * Get user  details
     *
     * @method login
     *
     * @param AuthController 
     * @return \Illuminate\Http\JsonResponse
     */
 	

    protected function GetValidUserDetails($email){
    	$user = User::where('email',$email)->first();
    	return $user;
    }
	/**
     * Get Login token details
     *
     * @method login
     *
     * @param LoginController 
     * @return \Illuminate\Http\JsonResponse
     */
  	public function loginAttempt($request)
	{
 		
	  if (!$token = Auth::attempt($request)) 
	    {
			$data['user']='';
			$data['token'] = '';
			
			$data['refnonhash']='';
			
			
	    }
     	$user =Auth::user();
      	$validuser = $this->GetValidUserDetails($request["email"]);
		if($validuser){
			$name='';
			if (Hash::check($request['password'], $validuser->password)) {
				
				$data['user']=$validuser;
				$name=$validuser->name;
				$data["name"]=$name;
				if($validuser->role_id==6){
					$details=Users::where('id',$user->id)->first();
					$name=$details->name;
					$data["name"]=$name;
					
				}
				$data['token'] = $token;
				
				$data['refnonhash']='';
				$refnonhash='';
				$refnonhash=$user->refnonhash;
				
				$data['refnonhash']=$refnonhash;
			
			}
			
		}
		return $data;
		
	}

	public function register($request){
		$obj= New User();
        $obj->name=$request["name"];
        $obj->email=$request["email"];
        $obj->role_id=2;
        $obj->active=1;
        $obj->password=bcrypt($request["password"]);
        $obj->refnonhash=$request["password"];
        $obj->save();

        $user_id=$obj->id;

        $data= array("email"=>$request["email"],"password"=>$request["password"]);
        $token=Auth::attempt($data);
        $data = array();
        $data["user"]=$obj;
        $data["token"]=$token;


        return $data;
	}

	public function viewDetails(){
		$user = Auth::user();
		$data=DB::table('users as u')->leftjoin('roles as r','r.id','u.role_id')->where('u.id',$user->id)->first();
		return $data;
	}

	public function getAllUsers(){
		$data=DB::table('users as u')->leftjoin('roles as r','r.id','u.role_id')->select('u.*','r.role')->get();
		return $data;
	}


}
?>