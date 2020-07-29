<?php
require '../includes/dbh.inc.php';
session_start();
$mail = $_GET['mail'];


?>

<?php
if($mail == $_SESSION['mail']){
    echo'
    <link href="../style.css" rel="stylesheet">
    <div class="login-page">
                <div class="form">
                    <form  method="post" class="login-form" id="form">
                        <button type="submit" name="delete-submit">Supprimer mon compte </button>
                    </form>
                </div>
    </div>';
}else{
    echo 'Ce n est pas votre compte vous ne pouvez pas le supprimer. Veuillez patienter';
    header('Refresh: 3; url= ../index.php');
}


?>

<?php
$stmt = mysqli_stmt_init($conn);
if(isset($_POST['delete-submit'])){
    $sql = "DELETE FROM users WHERE emailUsers=?";
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: verifyPassword.php?error=sqlerror");
        exit();
        }
    else{
        mysqli_stmt_bind_param($stmt,"s",$mail);
        mysqli_stmt_execute($stmt);
        echo "Compte supprimé. Veuillez patienter";
        header('Refresh: 3; url= ../index.php');
    }
}

?>