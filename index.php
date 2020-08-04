<?php
  require($_SERVER['DOCUMENT_ROOT']."/LoginSystem+Project/loginsystem/header.php");
?>


    <main>
      <?php
    

      if(isset($_SESSION['userId'])){
        $emailUser = $_GET['mail'];
        

        if(!isset($_SERVER['HTTP_REFERER'])){
          session_destroy();
          header("Location: index.php");
        exit;
        }
        echo "<a href='index.php?login=success&mail=$emailUser'>
        <img src='img/logo.png' alt='logo' class='logo'>
        </a>";
        echo '<p1>You are logged in!</p1>';
        echo '<html>
        <link href="style.css" rel="stylesheet">
          <div class="loginChoice">
                  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                  <head>
                  <button onclick="alertVerifProf()">Accès Prof</button>
                  <button onclick="alertVerifEtudiant()">Accès Etudiant</button>
                  </head>
          </div>        
              </html>';
        echo '<br>';
        echo "<p3>Hello {$emailUser}</p3>";
      }
      else{
        echo  '<p2>You are logged out!</p2>';
      }

      ?>

    </main>

<?php

require "footer.php"

?>


<script>
function alertVerifProf(){
    if(confirm("Êtes vous sûr de vouloir accéder à la partie prof ?")) parent.location = 'prof.php';
}

function alertVerifEtudiant(){
    var user = "<?php echo $emailUser ?>";
    if(confirm("Êtes vous sûr de vouloir accéder à la partie étudiant ?")) parent.location = 'eleve.php?mail='+user;
}
</script> 