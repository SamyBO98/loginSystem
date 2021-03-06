<?php
if(isset($_POST['login-submit'])){
    require($_SERVER['DOCUMENT_ROOT']."/LoginSystem+Project/loginsystem/includes/dbh.inc.php");

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                $finalResult = $row['validation'];
                $emailUse = $row['emailUsers'];
                if($finalResult == 0 && $pwdCheck == 1){
                    header("Location: ../verifyPassword.php?notvalidateYet&verify=".$emailUse);
                   // header('Refresh: 2; url= index.php');
                    exit();
                }
                if($pwdCheck == false){
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
                else if($pwdCheck == true && $finalResult == 1){
                    
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    // Verification d'email
                    
                    header("Location: ../index.php?login=success&mail=".$emailUse);
                    exit();
                }
                else{
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
}
else{
    header("Location: ../index.php");
    exit();
}

?>