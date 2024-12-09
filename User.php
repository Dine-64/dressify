<?php 

function getUserById($id, $db){
    include 'db.php';
    $query = $conn->query("SELECT * FROM users WHERE id = '$id'");
    
    
    if($query->num_rows == 1){
    
        $user = $query->fetch_assoc();
        return $user;
    }else {
        return 0;
    }
}

 ?>