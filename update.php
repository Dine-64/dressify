<?php  
session_start();
include 'db.php';
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {


if(isset($_POST['username']) && 
   isset($_POST['email'])){
    

    $email = $_POST['email'];
    $uname = $_POST['username'];
    $old_pp = $_POST['old_pp'];
    $id = $_SESSION['user_id'];

    if (empty($email)) {
    	$em = "Email is required";
    	header("Location: edit.php?error=$em");
	    exit;
    }else if(empty($uname)){
    	$em = "User name is required";
    	header("Location: edit.php?error=$em");
	    exit;
    }else {

      if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
         
        
         $img_name = $_FILES['pp']['name'];
         $tmp_name = $_FILES['pp']['tmp_name'];
         $error = $_FILES['pp']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $new_img_name = uniqid($uname, true).'.'.$img_ex_to_lc;
               $img_upload_path = 'upload/'.$new_img_name;
               // Delete old profile pic
               $old_pp_des = "upload/$old_pp";
               if(unlink($old_pp_des)){
               	  // just deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }else {
                  // error or already deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }
               

               // update the Database
               $sql = "UPDATE users 
                       SET email='$email', username='$uname', pp='$new_img_name'
                       WHERE id=$id";
               
               $query = $conn->query($sql);
               $_SESSION['fname'] = $uname;
               header("Location: edit.php?success=Your account has been updated successfully1");
                exit;
            }else {
               $em = "You can't upload files of this type";
               header("Location: edit.php?error=$em&$data");
               exit;
            }
         }else {
            $em = "unknown error occurred!";
            header("Location: edit.php?error=$em&$data");
            exit;
         }

        
      }else {
         
        
       	$sql = "UPDATE users SET email='$email', username='$uname'
                WHERE id=$id";

       	
         
          if($conn->query($sql) === true){ 
            header("Location: edit.php?success=Your account has been updated successfully2");
          } else{ 
              echo "ERROR: Could not able to execute $sql. "  
                                                  . $mysqli->error; 
          } 
          $conn->close(); 

   	    
      }
    }


}else {
	header("Location: ../edit.php?error=error");
	exit;
}


}else {
	header("Location: login.php");
	exit;
} 



