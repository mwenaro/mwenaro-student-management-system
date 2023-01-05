<?php
require_once 'Response.php';
require_once 'Request.php';

class Router
{
  protected $routes = [];
  private $path;
  private $request_method;
  private $custom_method;
  protected $request;
  protected $response;




  function __construct(Request $req, Response $res)
  {
    $this->request = $req;
    $this->response = $res;

  }

  function get($path, $callback = null)
  {

    $method = "GET";
    if ($this->is_valid_path($path, $method)) {
      $callback($this->request, $this->response);
      exit();
    }




  }

  function post($path, $callback = null)
  {
    $method = "POST";
    if ($this->is_valid_path($path, $method)) {
      $callback($this->request, $this->response);
      exit();
    }


  }
  function put($path, $callback = null)
  {
    $method = "PUT";
    if ($this->is_valid_path($path, $method)) {
      $callback($this->request, $this->response);
      exit();
    }

  }
  function delete($path, $callback = null)
  {
    $method = "DELETE";
    if ($this->is_valid_path($path, $method)) {
      $callback($this->request, $this->response);
      exit();
    }
  }


  function any()
  {

    $this->response->status(404)->json(['message' => 'Invalid api  endpoint']);

    return;
  }

  function register_route($path, $path_value)
  {

  }

  function resolve()
  {

  }

  // private function validate_path($path, $request_method){
  //   if ($path == $this->request->getFormatedPath() && $this->request->getRequestMethod() == 'GET'){
  // }

  function is_valid_path($path, $method)
  {

    return (
      trim($path, '/') . '/' == trim($this->request->path, "/") . "/" ||
      trim($path, '/') . '/' == trim($this->request->getFormatedPath(), "/") . "/" ||
      trim($path, "/") . "/" == trim($this->request->formated_params, '/') . '/')

      && $this->request->getRequestMethod() == $method;

  }

}