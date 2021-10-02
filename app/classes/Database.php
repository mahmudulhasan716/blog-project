<?php


namespace App\classes;

class Database{
    public function dbcon(){
        $host= "localhost";
        $user="root";
        $password="";
        $db="blog";

        $link= mysqli_connect( $host,$user,$password,$db);
        return $link;
        
    }
}



?>