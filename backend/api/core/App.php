<?php

class App extends Router
{
    public $modal = null;
    protected $db;
    private $req;


    function __construct(Database $db)
    {

        parent::__construct($req = new Request, $res = new Response);
        $this->db = $db;

    }

    function setModel($modal)
    {
        $this->modal = $modal;
    }


    function _use($path)
    {
        // $this->routes[] = $path;
        $req = $this->request;
        $res = $this->response;
        $app = $this;

        $trimmed_path = trim(trim($path, "/"));
        $pat = realpath(dirname(__FILE__) . "/../routes/$trimmed_path-route.php");
        if (is_file($pat) && $req->is_controller($trimmed_path)) {
            include_once $pat;

        }
    }

    function any()
    {
        $req = $this->request;
        $res = $this->response;
        $app = $this;

        $resources_str = parse_ini_file(__DIR__ . '/settings.ini.php')["resources"];
        if (in_array($req->controller, explode(",", $resources_str))) {

            include_once realpath(dirname(__FILE__) . "/../routes/default-route.php");
            die();

        }

        parent::any();
    }


}