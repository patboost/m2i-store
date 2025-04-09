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
            <tr>
            <th scope="row"><?= $p->getId() ?></th>
            <td><?= $p->getNom() ?></td>
            <td><?= $p->getDescription() ?></td>
            <td><?= $p->getCategorieId() ?></td>
            <td><?= $p->getPrix() ?></td>
            </tr>
    <?php
        }
    ?>
    
  </tbody>
</table>

<?php 

    $content = ob_get_clean();
    require "view/template.php";
?>