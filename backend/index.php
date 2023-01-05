<?php
//Redirect to clint side if not a api request
//redirectToApp();
iniHeaders();


/**
 * 
 */
require 'config.php';
require_once('vendor/autoload.php');

/**
 * Auto import of the varu=ious files
 */
spl_autoload_register(function ($class) {
    $sources = [
        realpath(dirname(__FILE__) . '/api/core/' . $class . ".php"),
        realpath(dirname(__FILE__) . '/api/controllers/' . $class . ".controller.php"),
        realpath(dirname(__FILE__) . '/api/modals/' . $class . "_modal.php"),
    ];

    foreach ($sources as $file) {

        if (is_file($file)) {
            // echo '<br> '.$file . 'is found <br>';
            require_once $file;
        } else {
            // echo '<h2 style= "color:red;">'.$file. '</h2>';
        }
    }
});

/**
 * Initilization of the Essensial classes, Database and the App class
 */
$db = new Database("sqlite", DB_PATH);
$app = new App($db);
/*$tb = new Table("UserDB");
$tb->tableName("NewUser2")
    ->addColumn("id")
    ->integer(1)
    ->primaryKey()
    ->autoIncrement()
    ->addColumn("adm")
    ->integer()
    ->addColumn("username")
    ->varchar(50)
    ->notNull()
    ->addColumn("password")
    ->varchar(150)
    ->print()
    ->create();
// $tb->tableName("User2")
//      ->addInteger("id",1,0,"PRIMARY KEY") 
//      ->addTextField("USERNAME")
//     ->print()
//     ->create();

exit();
*/

/**
 * Routes start here.
 */

//Login route
$app->post("/api/v0/login/", function ($req, $res) {
    global $db;

    $login = new Login($db);
    $login->verifyUser($req->getBody());
    die();
});

//Refreshtoken
$app->post("/api/v0/refreshtoken/", function ($req, $res) {

    ["username" => $username, "password" => $password, "token" => $token] = $req->getBody();
    $isValidUser = Auth::isvalidToken($token, ["username" => $username, "password" => $password]);

    if (!$isValidUser) {
        $res->status(404)->send(["msg" => " UnAuthorized user"]);
        die();
    }
    $res->status(200)->send([
        "token" => Auth::getToken(["username" => $username, "password" => $password])
    ]);


});

//Other routes each on their own files

//Students routes
$app->_use("students");

//Teachers
$app->_use("teachers");







$app->any();


function iniHeaders()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header("Access-Control-Allow-Origin:*");
}

function redirectToApp()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header("Access-Control-Allow-Origin:*");

    $isNotAnApiCall = strpos($_SERVER['REQUEST_URI'], 'api') === false;

    if ($isNotAnApiCall) {


        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            $file1 = "http://" . $_SERVER['HTTP_HOST'] . "/app/index.html";
            $file2 = "http://" . $_SERVER['HTTP_HOST'] . "/webapp/app/index.html";
            $file = in_array($_SERVER['SERVER_NAME'], ['127.0.0.1', "::1"]) ? $file1 : $file2;
            header("location: $file");

            exit();
        }

        http_response_code(404);
        exit();
    }
}
