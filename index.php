<?php
require "config.php";
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

$tasks = $pdo->prepare("SELECT * FROM tasks WHERE user_id=? ORDER BY created_at DESC");
$tasks->execute([$user_id]);
$tasks = $tasks->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - MyTasks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">MyTasks</div>
            <nav>
                <a href="home.php" class="logout">Accueil</a>
                <a href="index.php" class="active">Mes tâches</a>
                <a href="logout.php" class="logout">Déconnexion</a>
            </nav>
    </header>

    <main class="main-content">

        <section class="hero">
            <h1>Bienvenue <?= htmlspecialchars($username) ?> </h1>
            <p>Votre assistant personnel pour gérer vos tâches efficacement.</p>
        </section>

        <section class="controls">
            <form action="add_task.php" method="POST" class="task-add">
                <input type="text" name="task" placeholder="Ajouter une tâche..." required>
                <button type="submit">Ajouter</button>
            </form>

            <input type="text" id="search" placeholder="Rechercher une tâche...">
        </section>

        <section class="tasks-list">
            <?php foreach($tasks as $t): ?>
                <div class="task-card <?= $t['is_done'] ? 'done' : '' ?>" data-task="<?= strtolower($t['task']) ?>">
                <div class="task-info">
                    <div class="task-text"><?= htmlspecialchars($t['task']) ?></div>
                        <div class="task-date">Ajouté le : <?= date("d/m/Y", strtotime($t['created_at'])) ?></div>
                    </div>

                    <div class="actions">
                        <a href="#" class="edit" data-id="<?= $t['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                        <a href="toggle_task.php?id=<?= $t['id'] ?>" class="check"><i class="fa-solid fa-check"></i></a>
                        <a href="delete_task.php?id=<?= $t['id'] ?>" class="delete"><i class="fa-solid fa-trash"></i></a>
                    </div>

                </div>
            <?php endforeach; ?>
        </section>

    </main>

    <footer>
        &copy; <?= date("Y") ?> MyTasks — Tous droits réservés.
    </footer>


    <script>
    document.querySelectorAll('.edit').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();

            const card = btn.closest('.task-card');
            const taskText = card.querySelector('.task-text');
            const currentText = taskText.textContent;
            const id = btn.dataset.id;

            const input = document.createElement('input');
            input.type = 'text';
            input.value = currentText;
            input.className = "edit-input";

            taskText.replaceWith(input);
            input.focus();

            input.addEventListener('blur', () => updateTask(id, input.value, input, card));
            input.addEventListener('keydown', (event) => {
                if(event.key === 'Enter') updateTask(id, input.value, input, card);
            });
        });
    });

    function updateTask(id, newText, inputElem, card) {
        fetch('edit_task.php', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:`id=${id}&task=${encodeURIComponent(newText)}`
        })
        .then(res=>res.text())
        .then(res=>{
            if(res === 'success'){
                const div = document.createElement('div');
                div.className = 'task-text';
                div.textContent = newText;
                inputElem.replaceWith(div);
            } else {
            alert('Erreur lors de la mise à jour');
            }
        });
    }
    //search
    document.getElementById("search").addEventListener("input", function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll(".task-card").forEach(card => {
            card.style.display = card.dataset.task.includes(q) ? "flex" : "none";
        });
    });
    </script>

</body>
</html>
