<?php
require 'includes/dbh.inc.php';
?>

<link href="style.css" rel="stylesheet">
<div class="login-page">
                <div class="form">
                    <form  method="post" class="login-form">
                        <input type="text" name="verifPassWord" placeholder="Vérification du compte">
                        <button type="submit" name="verif-submit">Vérification</button>
                    </form>
                </div>
</div>

<?php
if(isset($_POST['verif-submit'])){
$verif = $_POST['verifPassWord'];
$sql = "SELECT code FROM users ORDER BY code DESC LIMIT 1;";
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck>0){
    while($row = mysqli_fetch_assoc($result)){
        $finalResult = $row['code'];
        if($finalResult == $verif){
            echo 'code bon';
        }
        else {
            echo 'code mauvais';
        }

}
}
}


?>




