<?php
//session_start();
function logAttempt($status,$username, $useremail){
    date_default_timezone_set('Africa/Johannesburg');
    $log_file = 'loginAttemptsLog.log';
    $log_time = date('Y-m-d H:i:s');
    $user_ip = $_SERVER['REMOTE_ADDR'];

    $entry = "\r\n".$time." | ".$user_ip." | ".$username." | ".$useremail." | ".$status;
    file_put_contents($log_file, $entry, FILE_APPEND);

}
/*$status='successful';
$username = 'Caron';
logAttempt($status, $username,$useremail);
*/

?>
