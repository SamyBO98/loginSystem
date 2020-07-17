
<main>
<link href="style.css" rel="stylesheet">
    <a href="index.php">
        <img src="img/logo.png" class="logo">
    </a>
        <h1>Sign Up</h1>
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