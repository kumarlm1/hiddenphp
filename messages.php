<html>
    <body>
        <form action="/sendtoken.php">
  <input type="submit" name="sendtoken"value="Submit">
</form> 
        <form action="/sendrefresh.php">
  <input type="submit" name="sendtoken"value="check status">
</form> 
        <form action="">
  <input type="submit" name="sendtoken"value="refresh">
</form> 
       <form action="" method="post">
           <select id="animal" name="animal">                      
  <option value="userid">User id</option>
  <option value="id">Device id</option>
  <option value="ip">Ip</option>
  <option value="os">Os</option>
   <option value="model">Model</option>
</select>
 
  <input type="text" name="tests"value=""><br>
  <input type="submit" name="sendtoken"value="Submit">
 
</form> 

<?php
 
   $animal=$_POST['animal'];
   $value=$_POST['tests'];
  
  
$con=mysqli_connect("localhost","pubgflip","S1789163s1@#","pubgflip_info")
or die('Unable to connect');
echo "connected";
$result2=mysqli_query($con,"select * from user where $animal ='$value'");
echo"<center><h1>Search result</h1></center>



<br><table border='1'>
	<td>User id</td><td>Device id</td><td>Os</td>
	<td>Model</td>
	<td>Ip</td>
	<td>Status</td></tr>";
while($row=mysqli_fetch_array($result2))
{   
    $result1=mysqli_query($con,"select * from status where id='".$row['id']."' "); 
  
   while($row1 = mysqli_fetch_array($result1)){
   //echo $row1['status'];
   
	echo "<tr><td>".$row['userid']."</td>";
	echo"<td>".$row['id']."</td>";
	echo"<td>".$row['os']."</td>";
		echo"<td>".$row['model']."</td>";
			echo"<td>".$row['ip']."</td>";
			echo"<td>".$row1['status']."</td><td>";
			 
			
?>
				
        <form method="post">
            <input type="hidden" name="ids" value="<?php echo $row['id']; ?>" />
		<input name="submit2" type="submit" value="go" data-id="<?php echo $row['id']; ?>" />
		</form></td></tr>

<?php
}
}



?>


<?php			
echo"</table>";
mysqli_close($con);

?>
















<?php
$con=mysqli_connect("localhost","pubgflip","S1789163s1@#","pubgflip_info")
or die('Unable to connect');
echo "connected";
$result=mysqli_query($con,"select * from user");
echo"<center><h1>USERS</h1></center><br><table border='1'>
";
?>
<?php 
	echo"<tr>
	<td>User id</td><td>Device id</td><td>Os</td>
	<td>Model</td>
	<td>Ip</td>
	<td>Status</td></tr>";
	 
while($row=mysqli_fetch_array($result))
{   $result1=mysqli_query($con,"select * from status where id='".$row['id']."' "); 
  
  
   ?>
    <?php
   while($row1 = mysqli_fetch_array($result1)){
   //echo $row1['status'];
   
	echo "<tr><td>".$row['userid']."</td>";
	echo"<td>".$row['id']."</td>";
	echo"<td>".$row['os']."</td>";
		echo"<td>".$row['model']."</td>";
			echo"<td>".$row['ip']."</td>";
			echo"<td>".$row1['status']."</td><td>";
   }
			 
			
			?>
				
        <form method="post">
            <input type="hidden" name="ids" value="<?php echo $row['id']; ?>" />
		<input name="submit2" type="submit" value="go" data-id="<?php echo $row['id']; ?>" />
		</form></td></tr>

<?php

}

echo"</table>";
mysqli_close($con);
?>



</body>
<?php
if(isset($_POST['submit2'])){
 $id=$_REQUEST['ids'];
 $conn=mysqli_connect("localhost","pubgflip","S1789163s1@#","pubgflip_info")
or die('Unable to connect');
echo "connected";
$result=mysqli_query($conn,"select * from info where id = '$id'");
echo"<center><h1>MESSAGES</h1></center>


 
<br><table border='1'>
";
while($row=mysqli_fetch_array($result))
{
	echo"<tr><td>From:".$row['sender']."<br>";
	echo"Message:".$row['msg']."<br></tr>";
}
echo"</table>";
mysqli_close($con);
// echo "submit is called".$id;
}
?>






























</html>
