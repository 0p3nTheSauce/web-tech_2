<?php 
$password = "Spider1!";
$hased_password = password_hash($password, PASSWORD_DEFAULT);
$verified = password_verify($password, $hased_password);
if ($verified) {
    echo "verified";
}else{
    echo "not verified";
}
?>