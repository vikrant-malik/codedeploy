

<?php
session_start();
  mysql_connect('localhost','root','');
    mysql_select_db('database name goes here');
    $error_msg=NULL;
    //log out code
    if(isset($_REQUEST['logout'])){
                unset($_SESSION['user']);
                unset($_SESSION['username']);
                unset($_SESSION['id']);
                unset($_SESSION['role']);
        session_destroy();
    }
    //

    if(!empty($_POST['submit'])){
        if(empty($_POST['username']))
            $error_msg='please enter username';
        if(empty($_POST['password']))
            $error_msg='please enter password';
        if(empty($error_msg)){
            $sql="SELECT*FROM users WHERE username='%s' AND password='%s'";
            $sql=sprintf($sql,$_POST['username'],md5($_POST['password']));
            $records=mysql_query($sql) or die(mysql_error());

            if($record_new=mysql_fetch_array($records)){

                $_SESSION['user']=$record_new;
                $_SESSION['id']=$record_new['id'];
                $_SESSION['username']=$record_new['username'];
                $_SESSION['role']=$record_new['role'];
                header('location:index.php');
                $error_msg='welcome';
                exit();
            }else{
                $error_msg='invalid details';
            }
        }       
    }

?>

// replace the location with whatever page u want the user to visit when he/she log in


