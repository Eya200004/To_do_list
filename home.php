<?php
session_start();
$loggedIn = false;
if(isset($_SESSION['user_id'])) {
    $loggedIn = true;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyTasks - Bienvenue</title>

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body {
    font-family: "Inter", sans-serif;
    background:#F1F5F9;
    color:#0F172A;
}
header {
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:90px;
    background:linear-gradient(135deg, #0A0F24, #111827);
    padding:0 70px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 8px 25px rgba(0,0,0,0.35);
    z-index:200;
}

header .logo {
    color:white;
    font-size:28px;
    font-weight:700;
}
header nav a {
    color:#cbd5e1;
    margin-left:30px;
    text-decoration:none;
    font-size:16px;
    transition:0.3s;
}
header nav a:hover, header nav .active {
    color:#3B82F6;
}

.btn-primary {
    padding:10px 22px;
    background:#3B82F6;
    color:white !important;
    border-radius:10px;
    font-weight:600;
    transition:.3s;
}
.btn-primary:hover {
    background:#1E40AF;
}

.hero {
    margin-top:140px;
    padding:60px 70px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:50px;
}

.hero-text {
    max-width:45%;
}

.hero-text h1 {
    font-size:50px;
    font-weight:800;
    color:#0F172A;
}

.hero-text p {
    font-size:20px;
    margin:20px 0;
    color:#475569;
}

.btn-big {
    display:inline-block;
    background:#3B82F6;
    color:white;
    padding:18px 45px;
    border-radius:15px;
    text-decoration:none;
    font-size:20px;
    margin-top:10px;
    transition:.3s;
}
.btn-big:hover {
    background:#1D4ED8;
}
.hero-img img {
    width:520px;
    filter:drop-shadow(0 8px 25px rgba(0,0,0,0.2));
    animation:float 3s infinite ease-in-out;
}
@keyframes float {
    0% { transform:translateY(0); }
    50% { transform:translateY(-12px); }
    100% { transform:translateY(0); }
}
.slider-section {
    margin:80px auto;
    text-align:center;
    padding:0 50px;
}

.slider-section h2 {
    font-size:32px;
    font-weight:700;
    margin-bottom:25px;
    color:#0F172A;
}

.slider-container {
    display:flex;
    overflow-x:auto;
    gap:25px;
    padding:20px;
    scroll-snap-type:x mandatory;
}

.slide {
    min-width:260px;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
    scroll-snap-align:center;
    transition:.3s;
}
.slide:hover {
    transform:translateY(-5px);
}

.slide img {
    width:100%;
    border-radius:12px;
}

.slide p {
    margin-top:10px;
    font-size:17px;
    font-weight:600;
    color:#334155;
}
footer {
    margin-top:80px;
    padding:25px;
    background:white;
    text-align:center;
    border-top:1px solid #e2e8f0;
    color:#475569;
}
</style>
</head>
<body>

<header>
    <div class="logo"> MyTasks </div>

    <nav>
        <?php if($loggedIn): ?>
            <a href="home.php" class="logout">Accueil</a>
            <a href="index.php">Mes tâches</a>
            <a href="logout.php" class="btn-primary">Déconnexion</a>
        <?php else: ?>
            <a href="home.php" class="logout">Accueil</a>
            <a href="login.php">Connexion</a>
            <a href="register.php" class="btn-primary">Créer un compte</a>
        <?php endif; ?>
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <h1 id="title">Votre assistant de tâches intelligent</h1>
        <p id="subtitle">
            Planifiez vos journées, suivez vos tâches en temps réel et atteignez vos objectifs plus efficacement. Avec MyTasks, chaque idée devient une action.
        </p>
        <?php if(!$loggedIn): ?>
            <a href="register.php" class="btn-big">Commencer maintenant</a>
        <?php else: ?>
            <a href="index.php" class="btn-big">Voir mes tâches</a>
        <?php endif; ?>
    </div>

    <div class="hero-img">
        <img src="to-removebg-preview.png" alt="Hero">
    </div>
</section>

<section class="slider-section">
    <h2>Fonctionnalités principales</h2>

    <div class="slider-container" id="slider">
        <div class="slide">
            <img src="https://img.icons8.com/clouds/400/todo-list.png">
            <p>Ajout rapide de tâches</p>
        </div>

        <div class="slide">
            <img src="https://img.icons8.com/clouds/400/design.png">
            <p>Design moderne</p>
        </div>

        <div class="slide">
            <img src="https://img.icons8.com/clouds/400/time-machine.png">
            <p>Historique & gestion</p>
        </div>
    </div>
</section>

<footer>
    &copy; <?= date("Y") ?> MyTasks • Tous droits réservés
</footer>

<script>
const slider = document.getElementById("slider");
let scrollAmount = 0;

setInterval(() => {
    scrollAmount += 300;
    if (scrollAmount >= slider.scrollWidth) scrollAmount = 0;
    slider.scrollTo({ left: scrollAmount, behavior: "smooth" });
}, 3000);
</script>

</body>
</html>
