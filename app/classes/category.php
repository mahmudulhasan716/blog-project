<?php

namespace App\classes;
use App\classes\Database;

class Category{
    public function add_category($data){

        $category_name=$data['category_name'];
        $status=$data['status'];

        $sql="INSERT INTO `category`(`category_name`, `status`) VALUES ('$category_name', '$status')";

    
       $result= mysqli_query(Database::dbcon(),$sql);

       if($result){
           $error= "saved";
            return $error;   
       }else{
        $error= "failed";
        return $error;  
       }   
    }

    public function allCatagory(){
       $result= mysqli_query(Database::dbcon(), "SELECT * FROM `category`");
       return $result;
    }

    public function allActiveCatagory(){
        $result= mysqli_query(Database::dbcon(), "SELECT * FROM `category` WHERE `status`='1' ");
        return $result;
     }

     public function allActivePost(){
        $result= mysqli_query(Database::dbcon(), "SELECT * FROM `blog` WHERE `status`='1' ");
        return $result;
     }

    public function show($id=''){
        return mysqli_query(Database::dbcon(), "SELECT * FROM `category` WHERE `ID`='$id' ");
     }


    public function active($id){
        mysqli_query(Database::dbcon(),"UPDATE `category` SET `status`='1' WHERE `ID`='$id'");

    }
    public function inactive($id){
        mysqli_query(Database::dbcon(),"UPDATE `category` SET `status`='0' WHERE `ID`='$id'");

    }

    public function delete($id){
        mysqli_query(Database::dbcon(),"DELETE FROM `category` WHERE `ID`='$id'");

    }

    public function singlePost($id){
        $result= mysqli_query(Database::dbcon(), "SELECT * FROM `blog` WHERE `ID`='$id' ");
        return $result;
    }

    public function catPost($cat_id){
        $result= mysqli_query(Database::dbcon(), "SELECT * FROM `blog` WHERE `status`=1 and `cat_id`='$cat_id' ");
        return $result;
     }

     public function searchpost($text){
        $result= mysqli_query(Database::dbcon(), "SELECT * FROM `blog` WHERE `content` like '%$text%' and `status`='1' ");
        return $result;
     }
   


    public function update_category($data){

        $category_name=$data['category_name'];
        $status=$data['status'];
        $id=$data['id'];

       

       $sql="UPDATE `category` SET `category_name`='$category_name',`status`='$status' WHERE `ID`='$id'";

    
       $result= mysqli_query(Database::dbcon(),$sql);

        if($result){
           header('location:cat-edit.php?id='.$id);   
       }else{
        $error= "failed";
       return $error;  
       }   
    }

}

?>