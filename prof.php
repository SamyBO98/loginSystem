<?php
require 'includes/dbh.inc.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    session_destroy();
    header("Location: index.php");
    exit;
}
$emailUser = $_GET['mail'];

echo "
<style>
img {width:20%;}
</style>
<a href='index.php?login=success&mail=$emailUser'>
<img src='img/logo.png' alt='logo' class='logo'>
</a>";

?>

<html style="background-color:#87bf67;">
    <meta charset="UTF-8">
    <head>
        <h2>Accès Prof récapitulatif</h2>
        <body>
            <h4>Note des cours</h4>
</html>

<?php
    $sql = "SELECT avg(noteLifap6) as `avgLifap6` FROM users;";
    $result = mysqli_query($conn,$sql);
    $data=mysqli_fetch_array($result);

    echo "Moyenne Lifap6: ".$data['avgLifap6'];



?>

