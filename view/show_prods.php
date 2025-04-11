<?php 

    $title = "MVC_STORE: PRODUITS";

    ob_start();

?>

<h1 class="text-center">Nos Produits</h1>

 <!-- TODO Afficher les produits  $prods -->

 <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Description</th>
      <th scope="col">Catégorie</th>
      <th scope="col">Prix</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach($prods as $p) {
    ?>
            <tr class="table-primary">
              <th scope="row"><?= $p->getId() ?></th>
              <td><?= $p->getNom() ?></td>
              <td><?= $p->getDescription() ?></td>
              <td><?= $p->getCategorieNom() ?></td>
              <td><?= $p->getPrix() ?></td>
            </tr>
    <?php
        }
    ?>
    
  </tbody>
</table>

<?php
  // Ajouter bouton "ajout produit"
  // Si ADMIN ou USER connecté
  if (isset($_SESSION['user'])) {
    if(($_SESSION['user']->getStatut() === "ADMIN") || 
        ($_SESSION['user']->getStatut() === "USER")) {
?>
      <a href="index.php?action=add_prod" class="btn btn-primary">Ajouter un produit</a>
<?php 
    }
  }
    $content = ob_get_clean();
    require "view/template.php";
?>