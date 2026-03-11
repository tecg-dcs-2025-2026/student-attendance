<?php view('partials.head', compact('title')) ?>

<main class="page-main">
    <h1><?= $title ?></h1>
    <form action="/etudiants" method="post" enctype="multipart/form-data">
        <div>
            <label for="first-name">Prénom <sup>*</sup></label>
            <input id="first-name" name="first_name" type="text" placeholder="Jean" required>
        </div>
        <div>
            <label for="family-name">Nom de famille <sup>*</sup></label>
            <input id="family-name" name="last_name" type="text" placeholder="Valjean" required>
        </div>
        <div>
            <label for="email">Email <sup>*</sup></label>
            <input id="email" name="email" type="email" placeholder="jean.valjean@miserables.fr" required>
        </div>
        <div>
            <label for="matricule">Matricule <sup>*</sup></label>
            <input id="matricule" name="matricule" type="text" placeholder="tecg01234" required>
        </div>
        <div>
            <label for="birth-date">Date de naissance</label>
            <input id="birth-date" name="birth_date" type="date" placeholder="01/01/2000" required>
        </div>
        <div>
            <label for="profile-photo">Photo</label>
            <input id="profile-photo" name="profile_photo" type="file" placeholder="jean" required>
        </div>
        <div>
            <button type="submit">Enregistrer l’étudiant</button>
        </div>
    </form>
</main>


<?php view('partials.nav') ?>


<?php view('partials.footer') ?>
