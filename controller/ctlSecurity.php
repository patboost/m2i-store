<?php 

require "model/user.php";

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

function ctlRegister() {

}

