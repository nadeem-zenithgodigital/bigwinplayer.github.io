<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["adloggedin"]) || $_SESSION["adloggedin"] !== true){
    header("location: adlogin");
    exit;
}
require_once "config.php";
   
                      
                        
$query =  "SELECT  * FROM record WHERE status='Applying' OR status='Agree'  ORDER BY id DESC ";


// result for method one
$result1 = mysqli_query($conn, $query);

// result for method two 
$result2 = mysqli_query($conn, $query);
$rowcount=mysqli_num_rows($result2);
    

$dataRow = "";

while($row2 = mysqli_fetch_array($result2))
{$query0 =  "SELECT  account,ifsc,upi FROM users  WHERE username='$row2[1]'";
$result3 =$conn->query($query0);
$row3 = mysqli_fetch_assoc($result3);
$bank=$row3['account'];
$ifsc=$row3['ifsc'];
$upi=$row3['upi'];
    $alink='"/waccept?am='.$row2[2].'&un='.$row2[1].'&id='.$row2[0].'"';
    $agree='"/agree?am='.$row2[2].'&un='.$row2[1].'&id='.$row2[0].'"';
      
    $dlink='"/wdecline?am='.$row2[2].'&un='.$row2[1].'&id='.$row2[0].'"';
    $dataRow = $dataRow."<tr><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$bank</td><td>$ifsc</td><td>$upi</td><td onclick='window.location.href=$agree;' style='background:green;'>AGREE</td><td onclick='window.location.href=$alink;' style='background:green;'>YES</td><td onclick='window.location.href=$dlink;'style='background:red;'>NO</td></tr>";
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    font-family: "Lato", sans-serif;
  }
  
  .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }
  
  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }
  
  .sidenav a:hover {
    color: #f1f1f1;
  }
  
  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }
  
  #main {
    transition: margin-left .5s;
    padding: 16px;
  }
  
  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  overflow: hidden;

}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
</head>
<body>

 <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span><span><h3 style="display:inline;">Withdraw Requests</h3></span>

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="admin" class="active" >Admin</a>
   <a href="users"  >Users</a>
  <a href="adduser">add User</a>
  <a href="inviterec">Invite Record</a>
  <a href="adpass">Password Change </a>
  <a href="adwith">Withdraw Requests</a>
  <a href="adpre">Next Predition</a>
  <a href="adreward">Reward Management</a>
  <a href="rechargeRequests">Recharge Requests</a>
  <a href="delete">Delete User</a>
  <a href="adlogout">Log Out</a>


</div>

<div>
  <table style="background-color: White;">
    <tr>
        
        <th>username</th>
        <th>amount</th>
          <th>status</th>
           <th>account no</th>
            <th>ifsc</th>
             <th>upi</th>
              <th>Agree</th>
        <th>Approve</th>
        <th>Approve</th>
      
      
    </tr>
    
    <?php echo $dataRow;?>

</table>
</div>

<script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
    }
</script>

</body>
</html>
