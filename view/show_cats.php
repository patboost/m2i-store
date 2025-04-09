<?php 
    $title = "MVC_STORE: CATEGORIES";

    ob_start();
    ?>

    <h1 class="text-center">Les catégories</h1>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach($cats as $c) {
    ?>
            <tr class="table-primary">
              <th scope="row"><?= $c->getId() ?></th>
              <td><?= $c->getNom() ?></td>
              <td><?= $c->getDescription() ?></td>
            </tr>
    <?php
        }
    ?>
    
  </tbody>
</table>

<a href="#" class="btn btn-primary">Créer catégorie</a>

    <?php 
        $content = ob_get_clean();
        require "view/template.php";

    ?>