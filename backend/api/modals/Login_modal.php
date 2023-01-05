<?php
class Login {
private $db;
    // function verifyUser($user){
    //     $sql = "SELECT username, password"
    // }

    function __construct(Database $db){
$this->db = $db;


    }

    /**
     * Method to verify the user
     */
    function verifyUser($user) {
        $id_name = $username_field ="";


    if(!isset($user['username']) || !isset($user['password'])){
    http_response_code(404);
    die(json_encode(['flag' => false, 'msg' => "Invalid Login"]));
}
    ["username" =>$username, "password" =>$password] = $user;
    
        switch ($user) {
            
            case in_array(trim($username), ["admin", "user", "dev", "system_admin"]):
            //    $sql = "SELECT userId, username,role FROM users WHERE role = :username AND password = :password";
               $sql = "SELECT userId, password,username,role FROM users ";
                $id_name = 'userId';
                $username_field ="role";

                break;
            default:
                //$sql = "SELECT teacherId,first_name, last_name, role FROM teachers WHERE phone = :username AND password = :password LIMIT 1";
                $sql = "SELECT teacherId,first_name, last_name, password, role FROM teachers ";
                $id_name = 'teacherId';
                $username_field ="phone";
                break;
        }
        $user = [
            $username_field =>$username,
            "password" =>$password
        ];

        $d = $this->db->select($sql,$user)->getData();
       
       
        $data = !empty($d) ? $d[0] : [];
        if (count($data) > 0) {
            http_response_code(201);
            $user_data = $data;
            ["username" =>$uname, "password" =>$pwd] = $user_data;
            $user_data["userId"] =  $data[$id_name];
            $user_data["token"]  = Auth::getToken( ["username" =>$username, "password" =>$pwd] );
           
          

            print_r(json_encode($user_data));
            
        } else {
            http_response_code(404);
            die(json_encode(['flag' => false, 'msg' => "Invalid Login"]));
                   }
    }
    
}