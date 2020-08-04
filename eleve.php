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
        <h2>Accès Etudiant</h2>
        <body>
            
            <h3>Plaintes par mail
            <ul>
                <li><a href = "mailto:samy.ben1998@hotmail.fr">
                    BEN OTHMAN Samy (Prof de ....) Page de l'UE ....
                    </a>
                </li>

                <li><a href = "mailto:mehdi.ben1963@hotmail.fr">
                    BEN OTHMAN Mehdi (Prof de ....) Page de l'UE ....
                    </a>
                </li>
            </ul>
            </h3>
            <h4>Notation des cours</h4>
            <ul>
                <li>
                    <a href="https://perso.liris.cnrs.fr/vincent.nivoliers/lifap6/" target="_blank">Cours de Monsieur NIVOLIER Lifap6</a> 
                    <br>
                    <label for="NoteLifap6">Notation de l'UE LIFAP6:</label>
                    <form action="" method="POST">
                        <input type="number" id="NoteLifap6" name="NoteLifap6"
                        min="0" max="20">
                        <button id="LIFAP6" name="LIFAP6">Envoyer</button>
                        <button id="LIFAP6PasSuivi">Pas Suivi cette UE</button>
                    </form>    


                </li>

                <li>
                    <a href="https://perso.univ-lyon1.fr/olivier.gluck/supports_enseig.html" target="_blank">Cours de Monsieur Gluck Réseau</a> 
                    <br>
                    <label for="NoteRéseau">Notation de l'UE Réseau:</label>
                    <form action="" method="POST">
                        <input type="number" id="NoteRéseau" name="NoteRéseau"
                        min="0" max="20">
                        <button name="NoteGluck">Envoyer</button>
                        <button id="RéseauPasSuivie">Pas Suivi cette UE</button>
                    </form>    

                </li>
            </ul>
        </body>
        <p id='message'></p>
    </head>
</html>

<?php
if(isset($_POST['NoteLifap6'])){
    $noteLifap6 = $_POST['NoteLifap6'];
    if(!empty($noteLifap6)){
        $sql = "UPDATE users SET noteLifap6 = ? WHERE emailUsers = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: eleve.php?mail=".$emailUser."&error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "is", $noteLifap6,$emailUser);
            mysqli_stmt_execute($stmt);
            header("Location: eleve.php?mail=".$emailUser."&success=sendLifap6Value");
            exit();
        }
    }else{
        $sql = "UPDATE users SET noteLifap6 = NULL WHERE emailUsers = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: eleve.php?mail=".$emailUser."&error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s",$emailUser);
            mysqli_stmt_execute($stmt);
            header("Location: eleve.php?mail=".$emailUser."&success=sendLifap6Null");
            exit();
        }
    }

}

?>
