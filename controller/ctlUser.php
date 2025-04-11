<?php 

    function ctlUserRegister() {
        $ret = false;

        if(isset($_POST['email'])) {
            $user = new User();

            $user->setNom(htmlspecialchars($_POST['nom']))
                ->setPrenom(htmlspecialchars($_POST['prenom']))
                ->setEmail(htmlspecialchars($_POST['email']))
                ->setPassword(htmlspecialchars($_POST['password']))
                -> setStatut("CLIENT");

            $ret = addUser($user);
            header("location: index.php?action=login");

        }
        require "view/form_register.php";
    }
?>