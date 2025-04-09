<?php 
$title = "MVC_STORE : Create Cat";
    ob_start();
?>
<form action="index.php?action=add_cat" method="POST">
  <div class="mb-3">
    <label for="nom" class="form-label">nom</label>
    <input type="text" class="form-control" id="nom"  name="nom">
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <input type="text" class="form-control" id="desc"  name="desc">
  </div>
  
  <button type="submit" class="btn btn-success">Créer catégorie</button>
</form>
<?php 
    $content=ob_get_clean();
    require "view/template.php";
    ?>