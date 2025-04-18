<?php

if(isset($_SESSION['panier'])){
  // POur afficher le badge du nombre d'article
  $CartQty = array_sum(array_values($_SESSION['panier']));
}

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MVC STORE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/m2i/mvc_store/index.php?action=home">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/m2i/mvc_store/index.php?action=get_all_prods">Produits</a>
        </li>
        <?php
        if (isset($_SESSION['user'])) {
          if(($_SESSION['user']->getStatut() === "ADMIN") || 
            ($_SESSION['user']->getStatut() === "USER")) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/m2i/mvc_store/index.php?action=get_all_cats">Catégories</a>
            </li>
      <?php 
          }
        }
      ?>

    <?php
        if (isset($_SESSION['user'])) {
          if(($_SESSION['user']->getStatut() === "ADMIN")) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/m2i/mvc_store/index.php?action=get_all_users">Utilisateurs</a>
            </li>
      <?php 
          }
        }
 
        if(!isset($_SESSION['user'])){
      ?>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/m2i/mvc_store/index.php?action=user_register">Enregistrement</a>
          </li>
      <?php 
        }
      ?>
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/m2i/mvc_store/index.php?action=show_cart">Panier</a>
            
            <?php 
              if(isset($CartQty)) {
            ?>
                <h6 class="badge bg-danger"><?= $CartQty ?></h6>
            <?php 
              }
            ?>
        </li>
  <?php 
        // Connexion / Déconnexion
        if (isset($_SESSION['user'])){
          $cnxLink = "http://localhost/m2i/mvc_store/index.php?action=logout";

          $cnxLabel = "Déconnexion";
        }
        else {
          $cnxLink = "http://localhost/m2i/mvc_store/index.php?action=login";

          $cnxLabel = "Connexion";
        }
 ?>
        <li class="nav-item">
          <a class="nav-link " href=<?= $cnxLink ?>><?= $cnxLabel ?></a>
        </li>
      </div>
  </div>
</nav>