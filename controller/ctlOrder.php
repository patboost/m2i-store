<?php 

require_once "model/order.php";
require_once "model/order_line.php";
require_once "model/produit.php";

function ctlCommanderPanier() {

    $panier = [];

    if(isset($_SESSION['panier'])){
        $panier = $_SESSION['panier'];
    }
    else {
        // Protection contre accès malveillant
        // appel direct avec URL
        header('location: index.php?action=get_all_prods');
    }

    // Création de la commande
    // ***********************

    $order = new Order_m2i();
    $nbOrders = getNbOrders();

    $order->setRef("REF_MVC_".++$nbOrders)
        ->setDate(new DateTime())
        ->setUserId($_SESSION['user']->getId())
        ->setMontant($_SESSION['total_cmd']);

    $orderId = createOrder($order);

    // Création des lignes de la commande
    // **********************************
    foreach ($panier as $prodId=>$qty){ // Eviter de manipuler des tableau dans la boucle
        $ol = new OrderLine_m2i();
        $prod = getProdById($prodId);

        $ol->setOrderId($orderId)
            ->setProdId($prodId)
            ->setOlQty($qty)
            ->setMontant($qty*$prod->getPrix());

        $ret = create_ol($ol);
    }

    // Vider le panier
    // ***************
    unset($_SESSION['panier']);

    header("location: index.php?action=get_all_prods");
}

?>