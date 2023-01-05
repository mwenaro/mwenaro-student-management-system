<?php

$app ->get('/',function($req, $res){
    global $db;
 
   extract($req->params);
    $data = $db->select("SELECT * FROM students ")->getData();
    $res->status(200)->send($data);
  
});

$app ->get('/:id',function($req, $res){
    global $db;
   extract($req->params);
    
    $data = $db->getRow("students", ["studentId"=>$id])->getData();
    $res->status(200)->send($data);
  
});

$app ->get('/:adm',function($req, $res){
    global $db;
   extract($req->params);
    
    $data = $db->getRow("students", ["adm"=>$adm]);
    $res->status(200)->send($data);
  
});

$app ->get('/api/v0/students/:gen',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    $data = $db->select("SELECT * FROM students", ["gen"=>$gen])->getData();
    $res->status(200)->send($data);
});

$app ->get('/api/v0/students/:form/:gen',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    $data = $db->select("SELECT * FROM students", ["gen"=>$gen,"form" =>$form])->getData();
    $res->status(200)->send($data);
});

$app ->post('/',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
     // $data = $db->select("SELECT * FROM students", ["studentId"=>$isPresent])->getData();
     $res->status(200)->send(['params'=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->put('/',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    // $data = $db->select("SELECT * FROM students", ["studentId"=>$isPresent])->getData();
    $res->status(200)->send(['params'=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->delete('/:id',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    // $data = $db->select("SELECT * FROM students", ["studentId"=>$isPresent])->getData();
    $res->status(200)->send(['params'=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->delete('/:adm',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    // $data = $db->select("SELECT * FROM students", ["studentId"=>$isPresent])->getData();
    $res->status(200)->send(['params'=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->get('/:sql',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    $data = $db->select($sql)->getData();
    $res->status(200)->send($data);
});





