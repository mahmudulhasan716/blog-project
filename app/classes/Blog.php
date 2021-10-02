<?php

namespace App\classes;
use App\classes\Database;


class Blog{
    public function addBlog($data){
        $file_name=$_FILES['photo']['name'];
        $file_ex= explode('.',$file_name);
        $file_ex= end($file_ex);
        $file_name=date('dmy.').$file_ex;



        $title= $data['title'];
        $status= $data['status'];
        $content= $data['content'];
        $cat_id=$data['cat_id'];
        $name=$_SESSION['Name'];
        

        $sql="INSERT INTO `blog`(`cat_id`, `title`, `content`, `photo`, `name`, `status`) VALUES ('$cat_id','$title','$content','$file_name','$name','$status')";

    
       $result= mysqli_query(Database::dbcon(),$sql);

       if($result){
           move_uploaded_file($_FILES['photo']['tmp_name'],'../uploads/'.$file_name);
           $error= "saved";
            return $error;   
       }else{
        $error= "failed";
        return $error;  
       }   
    }


    public function allBlog(){
        $result= mysqli_query(Database::dbcon(), "SELECT `blog`.*,`category`.`category_name`
        FROM `blog`
        INNER JOIN `category` ON `blog`.`cat_id`=`category`.`ID` ORDER BY `ID` DESC");
        return $result;
    }



    public function active($id){
        mysqli_query(Database::dbcon(),"UPDATE `blog` SET `status`='1' WHERE `ID`='$id'");

    }
    public function inactive($id){
        mysqli_query(Database::dbcon(),"UPDATE `blog` SET `status`='0' WHERE `ID`='$id'");

    }

    public function delete($id){
        mysqli_query(Database::dbcon(),"DELETE FROM `blog` WHERE `ID`='$id'");

    }

    public function show($id=''){
        return mysqli_query(Database::dbcon(), "SELECT * FROM `blog` WHERE `ID`='$id' ");
     }

     public function selectRow( $id=''){
        $result= mysqli_query(Database::dbcon(), "SELECT * FROM `blog` WHERE `status`='1' ");
        return $result;
     }

     

    public function update_blog($data){
        $file_name=$_FILES['photo']['name'];
        $file_ex= explode('.',$file_name);
        $file_ex= end($file_ex);
        $file_name=date('dmy.').$file_ex;



        $title= $data['title'];
        $status= $data['status'];
        $content= $data['content'];
        $cat_id=$data['cat_id'];
        $name=$_SESSION['Name'];
       
        $id= $_POST['id'];

        if($_FILES['photo']['name']==NULL){
            $sql="UPDATE `blog` SET `cat_id`='$cat_id',`title`='$title',`content`='$content',`name`='$name',`status`=' $status' WHERE `ID`='$id'";

        }else{
        $file_name=$_FILES['photo']['name'];
        $file_ex= explode('.',$file_name);
        $file_ex= end($file_ex);
        $file_name=date('dmy.').$file_ex;
         $sql="UPDATE `blog` SET `cat_id`='$cat_id',`title`='$title',`name`='$name',`content`='$content',`photo`='$file_name',`status`='$status' WHERE `ID`='$id'";
         move_uploaded_file($_FILES['photo']['tmp_name'],'../uploads/'.$file_name);
        }

    
       $result= mysqli_query(Database::dbcon(),$sql);

        if($result){
           header('location:edit-blog.php?id='.$id);   
       }else{
        header('location:edit-blog.php?id='.$id);  
       }   
    }
}


?>