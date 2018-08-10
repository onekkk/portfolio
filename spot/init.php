<?php
session_start();

function generate_token()
{
    return hash('sha256', session_id());
}

function token_check($token_post){
	$token = generate_token();
	if($token == $token_post){
		return true;
	}
	return false;
}

function login_check(){
	if(isset($_SESSION['username'])){
                return true;
        }else{
                return false;
        }
}



