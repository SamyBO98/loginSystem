<?php

if(isset($_POST["reset-request-submit"])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/LoginSystem+Project/loginsystem/forgottenpwd/create-new-password.php?selector=".$selector."$validator=".bin2hex($token);
    $expire = date("U") + 1800;

}else {
    header("Location: ../index.php");
}