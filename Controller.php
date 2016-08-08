<?php
session_start();
include_once 'Database.php';


class Controller extends Database
{
    
    
    function __construct()
        {
		parent::__construct();
        }
    
    
    function register($name,$email,$pass,$cpass,$date)
    {
        
            //$name = $_POST['name'];
            //$email = $_POST['email'];
            //$pass = trim($_POST['password']);
            //$cpass = trim($_POST['cpassword']);
            //$date = date('y-m-d');
        
        //if(strlen($name) == 0)
        //    {
        //        $ret_arr['error'] = 1;
        //        $ret_arr['error_mess'] = 'Please fill the Name field';
        //    }
        //else
        //    if(strlen($email) == 0)
        //    {
        //        $ret_arr['error'] = 1;
        //        $ret_arr['error_mess'] = 'Please fill the Email field';
        //    }
        //else
        //    if(($pass != $cpass) || strlen($pass) == 0  || strlen($cpass) == 0)
        //    {
        //        $ret_arr['error'] = 1;
        //        $ret_arr['error_mess'] = 'Please fill the Password field';
        //    }
        //if($ret_arr['error'] == 1)
        //    {
        //      $ret_arr['success_mess'] = 'Unsuccessfull';
        //    }
    
        if((isset($email) && ($email != "") && ($name != "")) && (($pass!= "") && ($cpass != "") && ($pass == $cpass)))
            {
               $q1="SELECT * FROM register WHERE email = '".$email."'";
               $sql = mysql_query($q1);//echo "select * from register where email = `.$email.`";
            
               $row = mysql_num_rows($sql);
                    if(!$row)
                        {
                         $pass = md5($pass);
                         $cpass = md5($cpass);
                         $q ="INSERT INTO `register` (`username`, `email`, `password`, `c_password`, `created_at`) VALUES ('$name', '$email', '$pass', '$cpass', '$date')";
                         
                         $result = mysql_query($q) or die(mysql_error());
                                            
                                if ($result=== TRUE)
                                {
                                    
                                    $ret_arr['data'] ='Successful';
                                }
                        }else
                            {
                                $ret_arr['data'] ='User Already Exist...';
                            }
                                                   
                        
            }else
                {
                      $ret_arr['data'] ='Please fill all the fields';
                }
                
       echo json_encode($ret_arr);
    
    }
    
     
     function login($email,$pass)
     { $ret_arr = array(
                        "success" => 0,
                        "success_mess" => '',
                         "error" => 0,
                        "error_mess" => '',
                        );
            $sql = mysql_query("SELECT * FROM register WHERE email = '".$email."' and password = '".md5($pass)."'");

             $row = mysql_fetch_assoc($sql);
             if($row)
             {
                $_SESSION['id'] = $row['reg_id'];
               $ret_arr['success'] = '1';
               $ret_arr['success_mess'] = 'Login Success';
               //header("Location: http://localhost/test1/list.php");exit;
             }else
                {
                    $ret_arr['error'] ='1';
                    $ret_arr['error_mess'] ='Login Failed';
                }
                
        echo json_encode($ret_arr);
     }
     
     function get_list()
     {
        $sql = mysql_query("SELECT * FROM register");
        return $sql;
     }
     
     function get_status($id)
    {
        $sql = mysql_query("SELECT * FROM frnd_tab WHERE sender_id=".$_SESSION['id']." AND reciever_id = ".$id." AND status = 1");
        $count = mysql_num_rows($sql);
        if($count > 0)
        {
            return 1;
        }else
        {
           return 0; 
        }
    }
     
    
    //SESSION DESTROY
    function destroy_session()
    {
            session_destroy();
            header('Location: http://localhost/test1/register.php');
        
    }
    
  
    function request_sent($id,$date)
    {
        
        
                //$id = $_GET['id'];
                //$date = date('y-m-d');
                
                $sql = mysql_query("SELECT * FROM frnd_tab WHERE sender_id=".$_SESSION['id']." AND reciever_id = ".$id." AND status = 1") or die("MYSQL");
                
                $count = mysql_num_rows($sql);
        
             if($count == 0)
             {
                     $status = $sql['status'];
                 
                     if($status == 0)
                     {
                         $sql1 = mysql_query("INSERT INTO `frnd_tab` (`sender_id`, `reciever_id`, `status`, `created_at`) VALUES ('$_SESSION[id]', '$id', '1', '$date')");
                         if($sql1)
                         {
                            
                            echo 'Request Sent';
                         }
                     }
             }
        }
        
        
        function request_accept($id)
    {

                $sql = mysql_query("SELECT * FROM frnd_tab WHERE sender_id=".$id." AND reciever_id = ".$_SESSION['id']." AND status = 1") or die("MYSQL");
                
                $count = mysql_num_rows($sql);
        
             if($count == 1)
             {
                         $sql1 = mysql_query("UPDATE `frnd_tab` SET status = '2' WHERE sender_id = ".$id." AND reciever_id = ".$_SESSION['id']."");
                         if($sql1)
                         {
                            
                            echo 'Request Accepted';
                         }
                     
             }
        }
        
        
        function get_request()
        {
           
            $sql1 = mysql_query("SELECT sender_id FROM frnd_tab WHERE reciever_id = ".$_SESSION['id']." AND status = 1") or die("MYSQL");
            
            $count = mysql_num_rows($sql1);
            
            if($count > 0)
            {
                 while($row = mysql_fetch_assoc($sql1))
                    {
                        $data[]=$row['sender_id'];        
                    }
                    return $data;
            }else
            {
                return 0;
            }
        }
    
    
    function get_sender_user($id)
        {
            $sql2 = mysql_query("SELECT * FROM register WHERE reg_id = $id ") or die("MYSQL");
            
            $count = mysql_num_rows($sql2);
            
            if($count > 0)
            {
                return $row = mysql_fetch_assoc($sql2);
            }else
            {
                return 0;
            }
        }
    
}    
     
  

                // echo json_encode($ret_arr);