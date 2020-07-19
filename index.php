<?php
  require "header.php"
?>

    <main>
      <?php
      if(isset($_SESSION['userId'])){
        echo '<p1>You are logged in!</p1>';
        // mettre le html du site ici
      }
      else{
        echo  '<p2>You are logged out!</p2>';
      }

      ?>

    </main>

<?php

require "footer.php"

?>