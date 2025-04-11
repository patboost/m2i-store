<?php 

    $title = "MVC_STORE: Register";
    ob_start()
?>

<h1 class="text-center">Créer un compte</h1>
<form action="#" method="POST">
    <div class="mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="mb-3">
    <label for="prenom" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="prenom" name="prenom">
    </div>
    <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">S'Enregistrer</button>
</form>

<?php 
    $content = ob_get_clean();
    require "view/template.php";
?>