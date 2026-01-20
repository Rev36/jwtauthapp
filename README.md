1)JWT LOGIN
------------
1) jwtauthapp folder consist of jwt login and throttle
2) In which, tymon jwt is installed and api return for user registration which consist of fields name,email,password and after success registration,token will be given in response
3)Similarly for login api,if credentails are correct then token will be generated
4)Using token , detals of user api is also completed 

2)Throttle 
1)Throttle task also done in jwtauthapp folder , where displaying whole users list api can be run for only 3 times per minute.if anyone try to attenpt more than 3 times 429 code will come in response
2)Throttle referrer middleware also created and used in api.php
