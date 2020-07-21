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
    $mailToSend= $_GET['verify'];
    $sql = "SELECT code FROM users WHERE emailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../verifyPassword.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$mailToSend);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_bind_result($stmt,$result);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
            while($row = mysqli_fetch_assoc($result)){
                $finalResult = $row['code'];
                if($finalResult == $verif){
                    echo 'code bon';
                }
                else{
                    echo 'code mauvais';
                }
            }
        }
    
}
}


?>




