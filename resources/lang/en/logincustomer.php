<?php

return [
  /*
    |--------------------------------------------------------------------------
    | Customer Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for announcement screen.
    |
    */

  // This part is used for validation purpose
  
  'name' => [
    'required' => 'Please Enter the First Name',
    'string' => 'Name is string only',
    'min'=>'Minimum 3 letters required',
    'max'=>'Maximum 20 letters only allowed',
  ],
  
  'email' => [
    'required' => 'Please Enter the Email',
    'email' => 'Please Enter Valid Email',
    'unique' => 'Email already exist'
  ],
 
  'password' =>  [
    'required' => 'Please Enter the Password',
    'min' => 'Minimum 6 letters required',
    'max'=>'Maximum 8 letters only allowed',
  ],
  'phone' =>  [
    'required' => 'Please Enter the Phone'
  ],
  'role' =>  [
    'required' => 'Please Enter the Role'
  ],
  

  // Response
  'loginSuccess'  => 'Login Successfully',
  'loginFailed'  => 'Login Failed Please Check your credentials',
  'logout'=>'Logged out Successfully',
  'details'=>'Details displayed Successfully',
  'register'=>'Registered Successfully',
];
