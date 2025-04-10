<?php 
$title = "MVC_STORE : LOGIN";
ob_start();
?>

<form action="#" method="POST">
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php 
    $content = ob_get_clean();
    require "view/template.php";
?>

