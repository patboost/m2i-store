<?php 

    $title = "MVC_STORE : NEW PROD";

    ob_start();
?>

<h1 class="text-center">Ajouter un produit</h1>

<form action="#" method="POST">
  <div class="mb-3">
    <label for="nom" class="form-label">nom</label>
    <input type="text" class="form-control" id="nom"  name="nom" required>
  </div>

  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <input type="text" class="form-control" id="desc"  name="desc" required>
  </div>

  <div class="mb-3">
    <label for="prix" class="form-label">Prix</label>
    <input type="text" class="form-control" id="prix"  name="prix" required>
  </div>

  <div class="mb-3">
    <label for="cat" class="form-label">Catégorie</label>
    <select name="cat" id="cat" required>
        <option value="">-- Sélectionnez une Catégorie --</option>

        <!-- TODO : AFFICHER Les Catégories -->
      <?php 
        foreach($cats as $cat){
      ?>
          <option value=<?=$cat->getId() ?>><?= $cat->getNom() ?></option>
      <?php
        }
      ?>

    </select>
  </div> 
  <button type="submit" class="btn btn-success">Créer Produit</button>
</form>

<?php 
    $content = ob_get_clean();
    require "template.php";
?>