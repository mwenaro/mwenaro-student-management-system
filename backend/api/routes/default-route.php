<?php

$app ->get('/',function($req, $res){
    global $db;
 
   extract($req->params);
    $data = $db->select("SELECT * FROM {$req->controller}", ['isDeleted' => 0])->getData();
    $res->status(200)->send($data);
  
});

$app ->get('/:id',function($req, $res){
    global $db;
   extract($req->params);
  
    $data = $db->getRow($req->controller, ["{$req->db_table}Id"=>$id, 'isDeleted' => 0])->getData();
    $res->status(200)->send($data);
  
});

$app ->get('/:adm',function($req, $res){
    global $db;
   extract($req->params);
    
    $data = $db->getRow($req->controller, ["adm"=>$adm]);
    $res->status(200)->send($data);
  
});

$app ->get("/api/v0/{$req->controller}/:gen",function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    $data = $db->select("SELECT * FROM {$req->controller}", ["gen"=>$gen])->getData();
    $res->status(200)->send($data);
});

$app ->post("/",function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
     // $data = $db->select("SELECT * FROM {$req->controller}", ["studentId"=>$isPresent])->getData();
     $res->status(200)->send(["params"=>$req->params,"body"=>$req->getBody()],$req->getRequestMethod());
});

$app ->put("/",function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    // $data = $db->select("SELECT * FROM {$req->controller}", ["studentId"=>$isPresent])->getData();
    $res->status(200)->send(["params"=>$req->params,"body"=>$req->getBody()],$req->getRequestMethod());
});

$app ->delete("/:id",function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    // $data = $db->select("SELECT * FROM {$req->controller}", ["studentId"=>$isPresent])->getData();
    $res->status(200)->send(["params"=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->delete('/:adm',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    // $data = $db->select("SELECT * FROM {$req->controller}", ["studentId"=>$isPresent])->getData();
    $res->status(200)->send(['params'=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->get('/:sql',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    $data = $db->select($sql)->getData();
    $res->status(200)->send($data);
});





