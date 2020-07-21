
<main>
<link href="style.css" rel="stylesheet">
    <a href="index.php">
        <img src="img/logo.png" class="logo">
    </a>
        <h1>Sign Up</h1>
        <?php
        
            require 'PHPMailer/PHPMailerAutoload.php';
            require 'includes/dbh.inc.php';
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfields"){
                    echo "<script>alert(\"Veuillez remplir tout les champs \")</script>";
                }
                else if($_GET['error'] == "invalidmail"){
                    echo "<script>alert(\"Mail invalide \")</script>";
                }
                else if($_GET['error'] == "invaliduid"){
                    echo "<script>alert(\"Pseudo invalide \")</script>";
                }
                else if($_GET['error'] == "invalidmailuid"){
                    echo "<script>alert(\"Pseudo et email invalide \")</script>";
                }
                else if($_GET['error'] == "passwordcheck"){
                    echo "<script>alert(\"Veuillez saisir 2 fois le même mot de passe \")</script>";
                }
                else if($_GET['error'] == "userOrMailAlreadytaken"){
                    echo "<script>alert(\"Mail ou pseudo déja pris \")</script>";
                }
                // Refaire des else if pour tout les messages d'erreurs
            }
            if(isset($_GET['signup'])){
            if($_GET['signup'] == "success"){
                    echo "Validation de votre inscription. Un mail vient de vous être envoyé";
                    $mailToSend= $_GET['email'];
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
                    header('Refresh: 4; url= verifyPassword.php?&verify='.$mailToSend);
                    
                    //$mail->SMTPDebug = 1;
                    
                }
            }
            
        ?>
            <div class="login-page">
                <div class="form">
                    <form action="includes/signup.inc.php" method="post" class="login-form">
                        <input type="text" name="uid" placeholder="Username">
                        <input type="text" name="mail" placeholder="Email">
                        <input type="password" name="pwd" placeholder="Password">
                        <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                        <button type="submit" name="signup-submit">Sign Up</button>
                    </form>
                </div>
            </div>
</main>           

<?php
require "footer.php"

?>
