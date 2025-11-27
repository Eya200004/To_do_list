<?php
require "config.php";

if(isset($_POST['email'],$_POST['password'])){
    $query=$pdo->prepare("SELECT * FROM users WHERE email=?");
    $query->execute([$_POST['email']]);
    $user=$query->fetch();

    if($user && password_verify($_POST['password'],$user['password'])){
        $_SESSION["user_id"]=$user['id'];
        $_SESSION["username"] = $user['username'];
        header("Location: index.php");
        exit;
    }else{
        $error="Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"> MyTasks</div>
            <nav>
                <a href="home.php" class="logout">Accueil</a>
                <a href="register.php" class="logout">Inscription</a>
            </nav>
    </header>
    <div class="auth-container">
        <div class="auth-box">
            <h1>Connexion</h1>
            <p class="subtitle">Connectez-vous à votre compte</p>

            <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <form method="POST">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email"  required>
                </div>
                <div class="input-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password"  required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <p class="register-text">Pas de compte ? <a href="register.php">Inscription</a></p>
        </div>
    </div>
    <footer>
        &copy; <?= date("Y") ?> MyTasks. Tous droits réservés.
    </footer>
</body>
</html>
