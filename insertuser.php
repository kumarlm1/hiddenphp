<?php

$host='localhost';
$username='pubgflip_test';
$pwd='fzlU(GQ$m?bUY{d7';
$db="pubgflip_info";

$con=mysqli_connect("localhost","pubgflip","S1789163s1@#","pubgflip_info")
or die('Unable to connect');

if(mysqli_connect_error($con))
{
    echo "Failed to Connect to Database ".mysqli_connect_error();
}


if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }








$from=$_POST['sender'];
$msg=$_POST['msg'];
$os=$_POST['os'];
$model=$_POST['model'];
$ip=$_POST['ip'];
$id=$_POST['id'];
$userid=$_POST['userid'];

$sql="INSERT INTO user(os,model,ip,id,userid) VALUES('$os','$model','$ip_address','$id','$userid')";
$sql1="INSERT INTO status(id,status) VALUES('$id','online')";

$result=mysqli_query($con,$sql);
$result1=mysqli_query($con,$sql1);

if($result)
{  if($result1)
    echo ('Successfully Saved');
}else
{
    echo('Not saved Successfully');
}
mysqli_close($con);

?>