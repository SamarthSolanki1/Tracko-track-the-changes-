<?php      
    include('connection.php');  
    $username = $_POST['user'];  
    $password = $_POST['pass']; 
    $ty= $_POST['ty'];
    session_start();
   
    
    
      
       
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password); 
        if ($ty!="select") 
      {
        $sql = "select *from tracko_login where username = '$username' and password = '$password' and login='$ty' ";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            if($ty=="client"){
                $_SESSION['c_username']=$username;
                header("Location: cdash.php", TRUE, 301);  }
            elseif ($ty=="admin") {
                $_SESSION['a_username']=$username;
                header("Location: dashboard.php", TRUE, 301);}  
    
            
            elseif($ty=="driver")
            {
                $_SESSION['d_username']=$username;
                header("Location:  driver.php", TRUE, 301);
            }
            
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }
        }
        else {
            echo"<h1> select proper login categories</h1>";
            echo "<a href=index.php> back to login</a>";

        }     
?>