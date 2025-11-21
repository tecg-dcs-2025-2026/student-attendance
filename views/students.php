<?php include 'partials/header.php' ?>
<header>
    <h1>Prendre les présences</h1>
</header>

<main>
    <form action="" method="POST">
        <ul class="student-list">
            <?php foreach (getAllStudents() as $student): ?>
                <li>
                    <input id="<?php echo $student['matricule']; ?>" type="checkbox" name="students[]"
                           value="<?php echo $student['matricule']; ?>">
                    <label for="<?php echo $student['matricule']; ?>"><?php echo $student['first_name']; ?><?php echo $student['last_name']; ?></label>
                </li>
            <?php endforeach; ?>
        </ul>

        <button type="submit" class="btn-submit">Enregistrer les présences</button>
    </form>
</main>

<?php include 'partials/footer.php' ?>
