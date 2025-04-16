<h1>Page de test</h1>

<?php 

    // require_once "model/produit.php";
    // require_once "model/categorie.php";
    // require_once "model/user.php";

    require "model/order.php";

    // $nbOrders = getNbOrders();
    // var_dump($nbOrders);
    
    $order = new Order_m2i();

    $order->setDate(new DateTime())
        ->setMontant(12.50)
        ->setRef("MCV_REF_0")
        ->setUserId(2);
    
    $cmdId = createOrder($order);

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
// $prods = getAllProdsWithCat();
// var_dump($prods);

$prod = new Produit();
$prod->setNom("produit Test")
    ->setDescription("lkjflksjflks")
    ->setPrix(12.50)
    ->setCategorieId(1);

$ret = addProd($prod);
var_dump($ret);
?>