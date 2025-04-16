<?php 

    require "controller/ctlProduit.php";
    require "controller/ctlCategorie.php";
    require "controller/ctlSecurity.php";
    require "controller/ctlUser.php";
    require "controller/ctlCart.php";
    require "controller/ctlOrder.php";
    
    session_start();

    function home() {
        $title = "MVC_STORE";

        ob_start();
?>      
        <h3 class="text-center mt-5">Bienvenue sur MVC_STORE</h3>

        <p class="text-center mt-5">Ici vous trouverez votre bonheur !!!</p>

<?php 
        $content = ob_get_clean();
        require "view/template.php";

    }

    // ********
    // ROUTEUR
    // ********
    if(isset($_GET['action'])){
        $action = htmlspecialchars($_GET['action']);

        // Controle d'accès
        // ****************
        if(!getAccess($action)) {
            $action = 'access_denied';
        }


        // Routage suivant l'action demandée
        // *********************************
        switch ($action) {

            // Page par défaut
            case 'home':
                home();
                break;

            // *********
            // PRODUITS
            // *********
            case 'get_all_prods':
                //ctlGetAllProd();
                ctlGetAllProductWithCategorie();
                break;

            case 'add_prod':
                if(getAccess($action)) {
                    ctlAddProd();
                }
                break;


            // ***********
            // CATEGORIES
            // ***********
            case 'get_all_cats':
                if(getAccess($action)) {
                    ctlgetAllCats();
                }
                break;

            case 'form_cat':
                if(getAccess($action)) {
                    ctlshowCatForm();
                }
                break;


            // *********
            // SECURITY
            // *********
            case 'login':
                ctlLogin();
                break;

            case 'logout':
                ctlLogout();
                break;

            case 'user_register':
                ctlUserRegister();
                break;

            case 'access_denied':
                ctlAccessDenied();
                break;
                

            // ******
            // USERS
            // ******
            case 'get_all_users':
                if(getAccess('get_all_users')) {
                    ctlGetAllUsers();
                }
                else {
                    header('location: index.php?action=access_denied');
                }
                break;

                // *******
                // PANIER
                // *******
                case 'show_cart':
                    ctlShowCart();
                    break;

                case 'add_cart':
                    ctlAddProdCart();
                    break;

                case 'cart_prod_dec':
                    ctlDecProdQty();
                    break;

                case 'cart_prod_del':
                    ctlProdDel();
                    break;

                case 'commander':
                    ctlCommanderPanier();
                    break;
                    

            // ******************
            // ACTIONS INCONNUES
            // ******************
            default:
                // Si action inconnue
                header("location: index.php?action=home");
                break;
        }
    }
    else {
        // Si pas action lors on envoie sur la page home
        header("location: index.php?action=home");
    }
?>