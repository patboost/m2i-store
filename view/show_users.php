<?php 

    $title = "MVC_STORE: Users";
    ob_start();
?>

<h1 class="text-center">Les Utilisateurs</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Email</th>
      <th scope="col">Statut</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach($users as $u) {
    ?>
            <tr class="table-primary">
              <th scope="row"><?= $u->getId() ?></th>
              <td><?= $u->getNom() ?></td>
              <td><?= $u->getPrenom() ?></td>
              <td><?= $u->getEmail() ?></td>
              <td><?= $u->getStatut() ?></td>
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