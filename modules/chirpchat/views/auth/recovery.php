<?php

namespace chirpchat\views\auth;

class Recovery {

    public function show() : void {
        ob_start();
        ?>

    <form id="loginForm" action="index.php?action=loginUser" method="post">
        <p>
            <br>
            <input id="recoveryChamps" type="text" name="email" placeholder="E-mail de récuperation"> <br> <!-- L'utilisateur rentre son e-mail ici -->

            <br>
            <input id="recoveryChamps" type="text" name="placeholder" placeholder="placeholder"> <br>

            <br>
            <input id="submitRecovery" type="submit" value="Réinitialiser mot de passe"><br> <!-- Bouton pour valider les champs -->

        <?php
        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Mot de passe oublié", $content))->show();
    }
}
?>
