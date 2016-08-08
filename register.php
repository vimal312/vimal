<?php
require 'Controller.php';
$conObj = new Controller();

 if(isset($_POST['action']) && $_POST['action']=='register'){
 
             $name = $_POST['name'];
             $email = $_POST['email'];
             $pass = trim($_POST['password']);
             $cpass = trim($_POST['cpassword']);
             $date = date('y-m-d');
             
     $conObj->register($name,$email,$pass,$cpass,$date);die;
 }
 
 
 if(isset($_POST['action1']) && $_POST['action1']=='login'){
 
             $email = $_POST['email'];
             $pass = $_POST['password'];
             
     $conObj->login($email,$pass);die;
 }
?>


<div id="aa">
    
</div>

#Register
**************************************************
<form id="reg" >
 <input type="hidden" value="register" name="param">
 <table>
  <tr>
    <td>Name</td>
    <td><input type="text" name="name"></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email"></td>
  </tr>
  
   <tr>
    <td>Password</td>
    <td> <input type="text" name="password"> </td>
  </tr>
   
  <tr>
    <td>Confirm Password</td>
    <td><input type="text" name="cpassword"></td>
  </tr>
  <tr>
   <td><input type="hidden" name="action" value="register"></td>
   <td><input type="submit" value="Save" ></td>
  </tr>
 </table> 
  
</form>

## Login
**************************************************
<form id="login">
 <input type="hidden" value="logi" name="param">
 <table>
  
  <tr>
    <td>Email</td>
    <td><input type="text" name="email"></td>
  </tr>
 
  <tr>
    <td>Password</td>
    <td><input type="text" name="password"></td>
  </tr>
  <tr>
   <td><input type="hidden" name="action1" value="login"></td>
   <td><input type="submit" value="Save"></td>
  </tr>
 </table> 
  
</form>

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>  
               <script type="text/javascript">

   <?php include "app.js"; ?>

    </script>


</html>

