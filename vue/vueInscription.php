<h1>Créer un compte</h1>

<form action="./?action=inscription" method="POST">

    <label for="mailU">Adresse email *</label>
    <input type="email" id="mailU" name="mailU" placeholder="votre@email.com" required /><br />

    <label for="pseudoU">Pseudo *</label>
    <input type="text" id="pseudoU" name="pseudoU" placeholder="Votre pseudo" required /><br />

    <label for="mdpU">Mot de passe *</label>
    <input type="password" id="mdpU" name="mdpU" placeholder="Min. 8 caractères, 1 chiffre, 1 symbole spécial" required minlength="8" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*(),.?&quot;:{}|<>_\-+=\[\]\\\/]).{8,}$" title="Le mot de passe doit contenir au moins 8 caractères, un chiffre et un symbole spécial" /><br />

    <label for="mdpU2">Confirmer le mot de passe *</label>
    <input type="password" id="mdpU2" name="mdpU2" placeholder="Confirmer le mot de passe" required minlength="8" /><br />

    <div class="mentions-legales">
        <h3>Protection de vos données personnelles</h3>
            Consultez nos <a href="./?action=cgu" target="_blank">Conditions Générales d'Utilisation</a>
            pour plus d'informations sur le traitement de vos données.
        </p>
    </div>

    <div class="consentement">
        <input type="checkbox" id="acceptCGU" name="acceptCGU" required />
        <label for="acceptCGU">
            J'accepte les <a href="./?action=cgu" target="_blank">Conditions Générales d'Utilisation</a>
            et je consens au traitement de mes données personnelles *
        </label>
    </div>

    <br />
    <input type="submit" value="Créer mon compte" />

</form>

<p class="champs-obligatoires">* Champs obligatoires</p>

<div id="password-strength" style="display:none; margin: 10px 5px; padding: 10px; border-radius: 5px;">
    <strong>Force du mot de passe :</strong>
    <ul id="password-requirements" style="list-style-type: none; padding-left: 0;">
        <li id="length-check">❌ Au moins 8 caractères</li>
        <li id="number-check">❌ Au moins un chiffre</li>
        <li id="special-check">❌ Au moins un symbole spécial</li>
    </ul>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('mdpU');
    const strengthDiv = document.getElementById('password-strength');
    const lengthCheck = document.getElementById('length-check');
    const numberCheck = document.getElementById('number-check');
    const specialCheck = document.getElementById('special-check');

    passwordInput.addEventListener('input', function() {
        const password = this.value;

        if (password.length > 0) {
            strengthDiv.style.display = 'block';

            if (password.length >= 8) {
                lengthCheck.innerHTML = 'Au moins 8 caractères';
                lengthCheck.style.color = 'green';
            } else {
                lengthCheck.innerHTML = '❌ Au moins 8 caractères';
                lengthCheck.style.color = 'red';
            }

            if (/[0-9]/.test(password)) {
                numberCheck.innerHTML = 'Au moins un chiffre';
                numberCheck.style.color = 'green';
            } else {
                numberCheck.innerHTML = '❌ Au moins un chiffre';
                numberCheck.style.color = 'red';
            }

            if (/[!@#$%^&*(),.?":{}|<>_\-+=\[\]\\\/]/.test(password)) {
                specialCheck.innerHTML = 'Au moins un symbole spécial';
                specialCheck.style.color = 'green';
            } else {
                specialCheck.innerHTML = '❌ Au moins un symbole spécial';
                specialCheck.style.color = 'red';
            }
        } else {
            strengthDiv.style.display = 'none';
        }
    });
});
</script>

<br />
<p>Vous avez déjà un compte ? <a href="./?action=connexion">Connectez-vous</a></p>

<?php if (isset($erreur)) { ?>
    <div class="erreur">
        <?= $erreur ?>
    </div>
<?php } ?>

<?php if (isset($success)) { ?>
    <div class="success">
        <?= $success ?>
    </div>
<?php } ?>
