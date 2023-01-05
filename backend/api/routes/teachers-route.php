<?php

$app ->get('/',function($req, $res){
    global $db;
   extract($req->params);
    $data = $db->select("SELECT * FROM teachers ", ["isPresent"=>1])->getData();
    $res->status(200)->send($data);
  
});
$app ->get('/:id',function($req, $res){
    global $db;
   extract($req->params);
    
    $data = $db->getRow("teachers", ["teacherId"=>$id, "isPresent"=>1])->getData();
    $res->status(200)->send($data);
  
});

$app ->get('/api/v0/teachers/:isPresent',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    $data = $db->select("SELECT * FROM teachers", ["teacherId"=>$isPresent])->getData();
    $res->status(200)->send($data);
});

$app ->post('/',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
     // $data = $db->select("SELECT * FROM teachers", ["teacherId"=>$isPresent])->getData();
     $res->status(200)->send(['params'=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->put('/',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    // $data = $db->select("SELECT * FROM teachers", ["teacherId"=>$isPresent])->getData();
    $res->status(200)->send(['params'=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->delete('/:id',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    // $data = $db->select("SELECT * FROM teachers", ["teacherId"=>$isPresent])->getData();
    $res->status(200)->send(['params'=>$req->params,'body'=>$req->getBody()],$req->getRequestMethod());
});

$app ->get('/:sql',function($req, $res){
    global $db;
    // extract($req->params);
    extract($req->params);
    
    $data = $db->select($sql)->getData();
    $res->status(200)->send($data);
});





