<?php

class Auth
{
    private static $secret_key = "";
    private static $res;
    private static $salt = "1234567890abdcefghijklmnopqrstuvwxyz@$&*%#";

    function __contruct()
    {
        ["secret_word" => $secret_key] = parse_ini_file("settings.ini.php");

        self::$secret_key = $secret_key;
        self::$res = new Response();

    }

    static function generateJWToken($user_details, $expiryAt)
    {

        $secret_key = self::$secret_key; //YOUR_SECRET_KEY";
        $issuer_claim = $_SERVER['DOCUMENT_ROOT']; //"THE_ISSUER"; // this can be the servername
        $audience_claim = $user_details["username"]; //"THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; //not before in seconds
        $expire_claim = $issuedat_claim + 1200; // expire time in seconds

        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => $user_details
        );

        //     array(
        //         "id" => $user_id,
        //         "firstname" => $firstname,
        //         "lastname" => $lastname,
        //         "email" => $email
        // ))
        return JWT::encode($token, $secret_key);
    }

    static function isJWTokenValid($token = [])
    {

        if (!preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $token)) {
            header('HTTP/1.0 400 Bad Request');
            // echo json_encode(['msg'Token not found in request']);
            self::$res->status(400)->send(['msg' => 'Token not found in request']);

            return false;
           
        }
        $jwt = $matches[1];
        if (!$jwt) {
            // No token was able to be extracted from the authorization header
            header('HTTP/1.0 400 Bad Request');
            exit;
        }


    }


    static function getToken($user)
    {
        $user_str = json_encode($user);
        return password_hash($user_str, PASSWORD_BCRYPT);

    }

    /**
     * @token - 
     * @user
     */

    static function isValidToken($token, $user)
    {
        return password_verify(json_encode($user), $token);

    }

}