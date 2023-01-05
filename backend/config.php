<?php
$local_host = array('127.0.0.1', "::1");
$server = $_SERVER['SERVER_NAME'];
$port = $_SERVER['SERVER_PORT'];
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';

if (!defined('HTTP_HOST')) {
    define('HTTP_HOST', $_SERVER["HTTP_HOST"]);
}

if (!defined('SP')) {

    define('SP', DIRECTORY_SEPARATOR);

    //	define('SP', '/');
}

// Always provide a TRAILING SLASH (/) AFTER A PATH
if (!defined('URL')) {
    $url = in_array($server, $local_host) ? $protocol . '' . $server . ':' . $port . SP : realpath(dirname(__FILE__)) . '/';
    define('URL', $url);
    //	define('URL', realpath(dirname(__FILE__)).SP);

}
if (!defined('DB_PATH')) {
    //define("DB_PATH", URL."api/resources/shule.sqlite3");
    define("DB_PATH", realpath(dirname(__FILE__) . SP . 'api' . SP . 'resources' . SP . 'shule.sqlite3'));
}

//DBTYPE
if (!defined("DBTYPE")) {
    define('DBTYPE', "sqlite");
}

//Resouce URI

if (!defined('URI')) {
    $uri = in_array($server, $local_host) ? "$protocol$server:$port" . SP : "$protocol$server/";
    $url = in_array($server, $local_host) ? "$protocol$server:$port/" : "$protocol$server/";
    define('URI', $url);


}

if (!defined('APP_PATH')) {
    define('APP_PATH', URI . "app/index.html");

}


if (!defined('LIBS')) {
    define('LIBS', URL . 'api' . SP . 'libs' . SP);
}
//define('LIBS', URL.'libs/');
if (!defined('CTRLS')) {
    define('CTRLS', URL . 'api' . SP . 'controllers' . SP);
}
//define('CTRLS', URL.'controllers/');
if (!defined('PATH_VIEWS')) {
    define('PATH_VIEWS', 'api' . SP . 'views' . SP);
}
if (!defined('CLS')) {
    define('CLS', URL . 'api' . SP . 'cls' . SP);
}
if (!defined('INCLUDES')) {
    define('INCLUDES', URL . 'api' . SP . 'views' . SP . 'includes' . SP);
}
if (!defined('DB_PATH')) {
    //define("DB_PATH", URL."api/resources/shule.sqlite3");
    define("DB_PATH", realpath(dirname(__FILE__) . SP . 'api' . SP . 'resources' . SP . 'shule.sqlite3'));
}
if (!defined('DB_NAME')) {
    //define("DB_NAME", URL."api/resources/shule.sqlite3");
    define("DB_NAME", realpath(dirname(__FILE__) . "/api/resources/shule.sqlite3"));
}
if (!defined('IS_REST')) {
    //define("DB_NAME", URL."api/resources/shule.sqlite3");
    define("IS_REST", TRUE);
}


if (!defined('SQL_DBPATH')) {
    //define("DB_NAME", URL."api/resources/shule.sqlite3");
    define("SQL_DBPATH", realpath(dirname(__FILE__) . "/api/resources/"));
}
// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
//define('HASH_GENERAL_KEY', 'MixitUp200');
// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');