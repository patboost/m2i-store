<?php 

require "model/user.php";
require "access.php";

function ctlLogin() {

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $user = getUserByEmail($email);
        if($user){
            if ($user->checkPasswd($password)){
                $_SESSION['user'] = $user;
            }
        }
        // Redirection de l'utilisateur après authentification
        header("location: index.php?action=home");
    }

    require "view/login_form.php";
}

function ctlLogout() {
    unset($_SESSION['user']);
    setcookie('PHPSESSID', '', time()-3600);
    header("location: index.php?action=home");
}

function getAccess(string $action) {
    global $accessList;
    $ret = false;
    $actionStatus = [];
    
    // Liste des statuts pour l'action demandée
    if(isset($accessList[$action])) {
        // action inconnue
        $actionStatus = $accessList[$action];
    } 
    else {
        return $ret;
    }

    if(count($actionStatus) == 0) {
        // Pas de restriction d'accès
        return true;
    }
    elseif (isset($_SESSION['user']) && in_array($_SESSION['user']->getStatut(), $actionStatus)){
        // Accès autorisé
        return true;
    }
    
    // Accès interdit
    return $ret;
}

function ctlAccessDenied() {
    require "view/access_denied.php";
}

