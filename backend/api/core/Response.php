<?php
class Response {

function status($code){

http_response_code($code);
return $this;
}

function json($data){
	echo json_encode($data);
return $this;
}
function send($data){
	echo json_encode($data);
return $this;
}




}
