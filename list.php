<?php
require 'Controller.php';
if(empty($_SESSION))
{
    header('Location: http://localhost/test1/register.php'); 
}

$conObj = new Controller();

if(isset($_GET['uid']) && isset($_GET['value']) && $_GET['value'] == 'logout')
{
    $conObj->destroy_session();
}

if($_POST['action']=='invite')
{
     $date = date('y-m-d');
     $conObj->request_sent($_POST['id'],$date);die;
}

if($_POST['action']=='accept')
{
    // $date = date('y-m-d');
     $conObj->request_accept($_POST['id']);die;
}

?>
#Listing
**************************************************
<html>
<head>
<style>
#list table {
    border: 1px solid black;
}
#list th {
    border: 1px solid black;
}
#list td {
    border: 1px solid black;
}
</style>
</head>

<form id="list" method="get">
    <input type="hidden" value="listing" name="param">

    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
            $sql = $conObj->get_list();//print_r($sql);
            while($res = mysql_fetch_assoc($sql)) {//print_r($_SESSION['id']);echo $res['reg_id'];  
                if($_SESSION['id'] == $res['reg_id']){
                    echo "Hello" .$res['username'];
            ?>
             <?php   }else{ ?>
             <input type="hidden" value="<?php echo $res['reg_id']; ?>" name="reg_id">
        <tr>
            <input type="hidden" value="<?php echo $res['reg_id']; ?>" name="id">
            <td><?php echo $res['username']; ?></td>
            <td><?php echo $res['email']; ?></td>
            <td><?php if($conObj->get_status($res['reg_id'])){ echo '<a href="">Request Sent</a>';}else{ echo '<a class="invite" data-value="'.$res[reg_id].'" href="javascript:void(0)">Invite</a>'; }?></td>
           
        </tr><?php   } } ?>
    </table>
</form>

</html><a href="?uid=<?php echo $_SESSION['id'] ?>&value=logout" >Logout</a>





<form id="" method="get">

    <input type="hidden" value="get_request" name="param">

    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php $sql1 = $conObj->get_request();
    
    
       foreach($sql1 as  $sv)
       {
        $sender_user = $conObj->get_sender_user($sv);
          ?>   
        <tr>
            <input type="hidden" value="<?php $sv;?>" name="id">
            <td><?php echo $sender_user['username'];?></td>
            <td><?php echo $sender_user['email'];?></td>
            <td><a href="javascript:void(0)" data-value="<?php echo $sender_user['reg_id'];?>" class="accept">Accept</td>
           
        </tr><?php  }?>
    </table>
</form>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>  
               <script type="text/javascript">
                 <?php include "app.js"; ?>
               </script>
               
               <html>
<body>

<p>Required fields are <b>bold</b></p>

<form action="contact.php" method="post">
<p><b>Your Name:</b> <input type="text" name="yourname" /><br />
<b>Subject:</b> <input type="text" name="subject" /><br />
<b>E-mail:</b> <input type="text" name="email" /><br />
Website: <input type="text" name="website"></p>

<p>Do you like this website?
<input type="radio" name="likeit" value="Yes" checked="checked" /> Yes
<input type="radio" name="likeit" value="No" /> No
<input type="radio" name="likeit" value="Not sure" /> Not sure</p>

<p>How did you find us?
<select name="how">
<option value=""> -- Please select -- </option>
<option>Google</option>
<option>Yahoo</option>
<option>Link from a website</option>
<option>Word of mouth</option>
<option>Other</option>
</select>

<p><b>Your comments:</b><br />
<textarea name="comments" rows="10" cols="40"></textarea></p>

<p><input type="submit" value="Send it!"></p>

<p> </p>
<p>Powered by <a href="http://myphpform.com">PHP form</a></p>

</form>

</body>
</html>
               
              