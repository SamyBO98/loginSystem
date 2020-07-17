<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="LoginSystem">
        <title></title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>


    <header>
        <nav>
            <a href="index.php">
            <img src="img/logo.png" alt="logo" class="logo">
            </a>
            <div class="login-page">
                <div class="form">
                    <form action="includes/login.inc.php" method="post" class="login-form">
                        <input type="text" name="mailuid" placeholder="Email"/>
                        <input type="password" name="pwd" placeholder="Password"/>
                        <button type="submit" name="login-submit" >Login</button>
                        <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
                    </form>
                    <form action="includes/logout.inc.php" method="post" class="login-form">
                        <button type="submit" name="logout-submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    </body>
</html>