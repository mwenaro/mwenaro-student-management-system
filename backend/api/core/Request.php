<?php

class Request {
	private $custome_req_method = null;
	private $req_condotions = [];
	private $modifiers = []; //this is an array of url vars
  public $body =[];
  private $request_method = null;
public $path;
  private $formated_path = null;
  public $params = [];
  public $url = null;
  private $ctrl = null;
  private $query_string = null;
  public $controller = null;
  public $is_versioned_api_call = false;
  public $is_api_call = false;
  public $formated_params = "";
  public $db_table = null;
  
	
  function __construct (){
    //Call init to intiolaize the request
    $this->init();
    $this->db_table = strtolower($this->controller) !== "classes" ? rtrim($this->controller, "s"): "class";
  }
  
  function getCustomReqMethod (){
  	return $this->custome_req_method;
  }

  
  function getPath(){
    return $this->path;
  }

  function init (){
	/*
	   exxaples
	    users/name/mwero => get users with name mwero
	    users/2 => get user with id =>1
	    users?ORDER=name&sort=DES => gt all users order by name , sort desc/asc

	
	*/

//students/form/2?order=adm&limit=20
   $this->url = $url = $_SERVER['REQUEST_URI']?? '/';

   $this->is_versioned_api_call = strpos($this->url, 'api/v') !== false;
   $this->is_api_call = strpos($this->url, 'api') !== false;

   //if url === / to to app
   if(strlen(trim($this->url,"/"))===0 ){
    header("Location: ".APP_PATH);
    die("Heded to path");
    
      
   }else if(!$this->is_api_call){
    http_response_code(404);
       die( json_encode(['msg' =>'Invalid api route']));
   }

   //Check if query_string and set the modifiers
   $url_parts_v0 = [];
   if(strpos($url,'?') !== -1){
      $url_parts_v0 = explode("?",$url);
      $url = array_shift($url_parts_v0);//[0]; /* /students/form/2 */
      $q_string = array_shift($url_parts_v0);//[1];
// var_dump($url_parts_v0);
      //Set query string values
      $this->setQStringVars($q_string);
   }

   //Extract the main path  from i.e   
    $url_parts_v1 = explode("/", trim($url, "/"));
     $loops = 0;
    if($this->is_api_call){
      $this->controller = count($url_parts_v1)>  2 ? $url_parts_v1[2]:$url_parts_v1[1];
      if($this->is_versioned_api_call):
        $loops =3 ;
      else:
        $loops = 2;
      endif;
      
    }else{
      $this->controller = count($url_parts_v1) > 0 ? $url_parts_v1[0]:null;
      $loops =1 ;
    }


 
 //set ctrl or path
 // /students/form/2 => /students/:form
    $this->path = $url;
    $this->setFormatedPath($url_parts_v1);
    
    while($loops>0):
      array_shift($url_parts_v1);
      $loops--;
    endwhile;
  

    //Set the remaining parts to path parameters
    if(count($url_parts_v1) > 0){
      $this->setPathParams($url_parts_v1);
    }
      
  }


function setFormatedPath($url_parts){
 $this->formated_path = "/";

 if(empty($url_parts)){
  return;
}

$main_path = "";
//If it's api call
if($this->is_api_call){
 $n = 0;
if($this->is_versioned_api_call){
   while($n <=2){
    $main_path .= count($url_parts)>0? array_shift($url_parts). "/":'';
    $n++;
  }
}
else{
   while($n <=1){
    $main_path .= count($url_parts)>0? array_shift($url_parts). "/":'';
    $n++;
  }
}
}


  $this->formated_path .= "{$main_path}";
  $this->formated_params = "/";
$len = count($url_parts);

if($len === 1){
  $this->formated_path .= ":id";
  $this->formated_params .= ":id";
  
 
  return;
}

    for($i = 0; $i < $len; $i+=2){
        if($i+1 < $len):
            $this->formated_path .=":".$url_parts[$i]."/";
            $this->formated_params .=":".$url_parts[$i]."/";
        endif;
        
  }

  
}

function getFormatedPath (){
  return $this->formated_path;
}

  function setPathParams($params = [])
  {
    if (empty($params)) return;

    // $arr = explode('/', trim($q_string, '/'));
    $arr = $params;
    $len = count ($arr);

    if ($len % 2 != 0)
    { 
        if ($len == 1) $this->params = ['id'=>$arr[0]];

    }  else{

 for ( $n = 0; $n < $len; $n+=2){
$this->params [$arr[$n]] = $arr[$n+1];
 }
      }

  }

    
  function getPathParams(){
    
    return $this->params;
  }

/**
 *  setRequestMethod
 */
  function setRequestMethod ($method = null){
  return $method??$_SERVER['REQUEST_METHOD'];
  }

  function getRequestMethod (){
    return $_SERVER['REQUEST_METHOD'];
  }
  
  function getBody(){
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
      foreach($_GET as $key => $val){
        $this->body[$key] = $val;
      }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      foreach($_POST as $key => $val){
        $this->body[$key] = trim($val);
      }
    }

    if(in_array($_SERVER['REQUEST_METHOD'], ['PUT',"POST", "DELETE"])){
      parse_str(file_get_contents("php://input"), $post_vars);
$this->body = [];
      foreach($post_vars as $key => $val){
        $this->body[$key] = trim($val);
      }
    }

    return $this->body;
  }

  function setQStringVars($q_string = null){
    if(!$q_string) return [];

    $q_string_array = explode('&', $q_string);
    foreach($q_string_array as $value) {
      $val = explode('=' , $value);
      $this->modifiers [$val[0]] = $val[1];

  }

  }


  function getQStringVars(){
       return $this->modifiers;
  }

   
   //Check if given str is the controller
   function is_controller($str){
    return $this->controller == $str;
   }
   
  
}
