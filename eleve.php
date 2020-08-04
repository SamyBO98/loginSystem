<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    session_destroy();
    header("Location: index.php");
    exit;
}

?>

<html>
    <meta charset="UTF-8">
    <head>
        <h1>Accès Etudiant</h1>
        <body>
            
            <h2>Plaintes par mail</h2>
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

            <h2>Notation des cours</h2>
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


?>
