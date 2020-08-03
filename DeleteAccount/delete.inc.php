<?php
require($_SERVER['DOCUMENT_ROOT']."/LoginSystem+Project/loginsystem/includes/dbh.inc.php");
session_start();
$mail = $_GET['mail'];
$ciphering = "AES-256-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$decryption_iv = '9453201532123687'; 
$decryption_key = "MailToSendForDeleteFunction";
$decryption=openssl_decrypt ($mail, $ciphering,$decryption_key, $options, $decryption_iv);  



?>

<?php
    echo'
    <link href="../style.css" rel="stylesheet">
    <div class="login-page">
                <div class="form">
                    <form  method="post" class="login-form" id="form">
                        <button type="submit" name="delete-submit">Supprimer mon compte </button>
                    </form>
                </div>
    </div>';
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
        mysqli_stmt_bind_param($stmt,"s",$decryption);
        mysqli_stmt_execute($stmt);
        echo "Compte supprimé. Veuillez patienter";
        echo '<br>';
        echo $decryption;
        header('Refresh: 3; url= ../index.php');
    }
}

?>