<?php
  require 'header.php';
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
        echo '<p3> Quizz </p3>';
        echo '<br>';
        echo "Hello {$emailUser}";
      }
      else{
        echo  '<p2>You are logged out!</p2>';
      }

      ?>

    </main>

<?php

require "footer.php"

?>