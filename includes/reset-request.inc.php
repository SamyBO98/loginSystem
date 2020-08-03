<?php
if(isset($_POST["reset-request-submit"])){
    require($_SERVER['DOCUMENT_ROOT']."/LoginSystem+Project/loginsystem/includes/dbh.inc.php");
    require($_SERVER['DOCUMENT_ROOT']."/LoginSystem+Project/loginsystem/PHPMailer/PHPMailerAutoload.php");
    $userEmail = $_POST["email"];
    $sql = "SELECT uidUsers FROM users where emailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../reset-password.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"s",$userEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
        //Si le mail existe
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);

            $url = "http://localhost/LoginSystem+Project/loginsystem/forgottenpwd/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);
            $expire = date("U") + 1800;



            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "There was an error";
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,'s',$userEmail);
                mysqli_stmt_execute($stmt);
            }

            $sql = "INSERT INTO pwdReset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "There was an error";
                exit();
            }else{
                $hashedToken = password_hash($token,PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,'ssss',$userEmail, $selector,$hashedToken,$expire);
                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            //Envoi mail après

    
            $mail = new PHPmailer();
            $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
            $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
            $mail->SMTPAuth = true; // Activer authentication SMTP
            $mail->Username = 'samy691600@gmail.com'; // Votre adresse email d'envoi
            $mail->Password = 'azerty1998'; // Le mot de passe de cette adresse email
            $mail->SMTPSecure = 'ssl'; // Accepter SSL
            $mail->Port = 465;

            $mail->setFrom('samy.ben1998@hotmail.fr', 'Reset Email'); // Personnalisation de l'envoyeur
            $mail->addAddress($userEmail); 

            $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

            $mail->Subject = 'Reset your password';
            $mail->Body = '<p>Une demande de changement de mot de passe a &eacutet&eacute faite. Si ce n est pas vous vous pouvez ignorer ce message</p>';
            $mail->Body .= '<p>Voici le lien pour changer votre mot de passe :</br>';
            $mail->Body.= '<a href="' . $url . '">' . $url . '</a></p>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();

            header("Location: ../reset-password.php?reset=success");
            }else{
                echo "<script>alert(\"Veuillez entrer une adresse mail valide ou existante\")
                window.location.replace('../reset-password.php?reset=fail');</script>";
            }
}


}else {
    header("Location: ../index.php");
}