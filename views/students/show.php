<?php view('partials.head', compact('title')) ?>

<main class="page-main">
    <h1><?= htmlspecialchars($student['first_name']) ?> <?= htmlspecialchars($student['last_name']) ?></h1>

    <dl>
        <dt>Matricule</dt>
        <dd><?= htmlspecialchars($student['matricule']) ?></dd>

        <dt>Prénom</dt>
        <dd><?= htmlspecialchars($student['first_name']) ?></dd>

        <dt>Nom de famille</dt>
        <dd><?= htmlspecialchars($student['last_name']) ?></dd>

        <dt>Email</dt>
        <dd><?= htmlspecialchars($student['email']) ?></dd>

        <dt>Date de naissance</dt>
        <dd><?= htmlspecialchars($student['birth_date'] ?? '—') ?></dd>
    </dl>

    <div>
        <a href="/etudiants" class="action">Retour à la liste</a>
    </div>
</main>


<?php view('partials.nav') ?>


<?php view('partials.footer') ?>
