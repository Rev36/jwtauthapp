<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use App\Services\Auth\AuthService;
use Log;
use Auth;
class AuthController extends Controller
{
    //
    private $service;
    public function __construct(AuthService $authservice){
        $this->service=$authservice;
    }
    public function login(LoginRequest $request){
        try{
            Log::INFO('Login Api starts',[$request->all()]);
            $data=$this->service->loginAttempt($request->all());
            if($data['token']!=''){
             return $this->success(__('logincustomer.loginSuccess'), $data); 
            }   
            return $this->errorResponse(__('logincustomer.loginFailed'),null,200);
            Log::INFO('Login Api ends');
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function register(RegisterRequest $request){
         Log::INFO('Register Api starts',[$request->all()]);
        $data= $this->service->register($request->all());
         Log::INFO('Register Api ends');
        return $this->success(__('logincustomer.register'), $data);
    }

    public function viewDetails(){
        Log::INFO('viewDetails Api starts',[]);
        $data= $this->service->viewDetails();
        Log::INFO('viewDetails Api ends');
        return $this->success(__('logincustomer.details'), $data);
    }

    public function getAllUsers(){
         Log::INFO('getAllUsers Api starts');
          $data= $this->service->getAllUsers();
         Log::INFO('getAllUsers Api ends');
         return $this->success(__('logincustomer.details'), $data);
    }

    public function logout()
    {
        
        try{
            Log::INFO('logout Api starts');
            $user = Auth::user();
            Auth::logout();
            Log::INFO('logout Api ends');
            return $this->success(__('logincustomer.logout'));

        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }



}
