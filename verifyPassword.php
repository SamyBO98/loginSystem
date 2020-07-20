<?php
require 'includes/dbh.inc.php';
$sql = "SELECT code FROM users ORDER BY code DESC LIMIT 1;";
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck>0){
    while($row = mysqli_fetch_assoc($result)){
        echo $row['code'];
        $test = $row['code'];
    }
}

?>
