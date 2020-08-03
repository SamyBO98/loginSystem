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
                    <form action="includes/reset-request.inc.php" method="post" class="login-form" id="form">
                        <input type="text" name="email" placeholder="Enter your email address">
                        <button type="submit" name="reset-request-submit">Reset Your Password</button>
                        <p>An email will be sent to reset your password</p>
                    </form>
                    <?php 
                    if(isset($_GET["reset"])){
                        if($_GET["reset"] == "success"){
                            echo '<p class="signupsuccess">Check your e-mail!</p>';
                        }
                    }
                    ?>
                </div>
</div>
<?php