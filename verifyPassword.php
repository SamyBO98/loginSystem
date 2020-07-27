<?php
require 'includes/dbh.inc.php';
require 'PHPMailer/PHPMailerAutoload.php';

?>
<header>
<a href="index.php">
            <img src="img/logo.png" alt="logo" class="logo">
</a>
</header>
<link href="style.css" rel="stylesheet">
<div class="login-page">
                <div class="form">
                    <form  method="post" class="login-form">
                        <input type="text" name="verifPassWord" placeholder="Vérification du compte">
                        <button type="submit" name="verif-submit">Vérification</button>
                        <button type="submit" name="send-another">Envoyer l'email à nouveau </button>
                    </form>
                </div>
</div>

<?php
if(isset($_POST['send-another'])){
    $mailToSend= $_GET['verify'];
    $sql = "SELECT code FROM users WHERE emailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $mailToSend);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_bind_result($stmt,$result);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
            while($row = mysqli_fetch_assoc($result)){
                 $finalResult = $row['code'];
            }
        }

    }

    $mail = new PHPmailer();
    $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
    $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
    $mail->SMTPAuth = true; // Activer authentication SMTP
    $mail->Username = 'samy691600@gmail.com'; // Votre adresse email d'envoi
    $mail->Password = 'azerty1998'; // Le mot de passe de cette adresse email
    $mail->SMTPSecure = 'ssl'; // Accepter SSL
    $mail->Port = 465;

    $mail->setFrom('from@example.com', 'Confirmation du compte'); // Personnalisation de l'envoyeur
    $mail->addAddress($mailToSend); 

    $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

    $mail->Subject = 'Code de confirmation';
    $mail->Body = 'Veuillez rentrer le code suivant pour vous identifier '.$finalResult;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
}

if(isset($_POST['verif-submit'])){
    $verif = $_POST['verifPassWord'];
    $mailToSend= $_GET['verify'];
    $codeBon = false;
    $number = 0;
    $countFalse = 0;
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
                    echo 'Code bon Redirection en cours';
                    $codeBon = true;
                    header('Refresh: 2; url= index.php');
                }
                else{

                }
            }
        }
        if($codeBon = true){
            $sql = "UPDATE users SET validation = '1' where emailUsers=?";
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../verifyPassword.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt,"s",$mailToSend);
                mysqli_stmt_execute($stmt);
            }
           
        }
    
}
}


?>




