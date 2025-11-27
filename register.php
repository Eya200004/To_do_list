<?php
require "config.php";

if(isset($_POST['username'], $_POST['email'], $_POST['password'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $pdo->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");
    try{
        $query->execute([$username, $email, $password]); 
        $user_id = $pdo->lastInsertId();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    }catch(Exception $e){
        $error =" Email déjà utilisé ou erreur de saisie.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <div class="logo"> MyTasks</div>
    <nav>
        <a href="home.php" class="logout">Accueil</a>
        <a href="login.php" class="logout">Connexion</a>
        
    </nav>
</header>
<div class="auth-container">
    <div class="auth-box">
        <h1>Inscription</h1>
        <p class="subtitle">Créez votre compte</p>

        <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if(!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

        <form method="POST">
            <div class="input-group">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username"  required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label>Mot de passe</label>
                <input type="password" name="password"  required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        <p class="register-text">Déjà un compte ? <a href="login.php">Connexion</a></p>
    </div>
</div>
<footer>
    &copy; <?= date("Y") ?> MyTasks. Tous droits réservés.
</footer>
</body>
</html>
