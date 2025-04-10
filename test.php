<h1>Page de test</h1>

<?php 

    require_once "model/produit.php";
    require_once "model/categorie.php";
    require_once "model/user.php";

    // $user = new User();

    // $user->setNom("Terrieur")
    //     ->setPrenom("Alain")
    //     ->setEmail("alain.terrieur@test.com")
    //     ->setStatut("ADMIN")
    //     ->setPassword("abc123");

    // $ret = addUser($user);

    // if ($ret) {
    //     $users = getAllUsers();
    //     var_dump($users);
    // }
$prods = getAllProdsWithCat();
var_dump($prods);
?>