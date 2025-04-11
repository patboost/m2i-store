<?php 

require_once "model/dbaccess.php";

$BddUser = "comptes_m2i";

class User {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;
    private string $statut;
    


    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of passwd
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of passwd
     */
    public function setPassword(string $passwd): self
    {
        $this->password = $passwd;

        return $this;
    }

    /**
     * Get the value of statut
     */
    public function getStatut(): string
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     */
    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    // Hash du mot de passe
    public function encryptPasswd($clearPswd) {
        $this->password = password_hash($clearPswd, PASSWORD_DEFAULT);
        return $this->password;
    }

    // Vérification du mot de passe
    public function checkPasswd(string $clearPasswd):bool {
        return password_verify($clearPasswd, $this->password);
        // return true;
    }
}

function getAllUsers() {
    $users = [];
    $sqlReq = "SELECT * FROM comptes_m2i";

    try {
        $ctxDb = dbConnect( );
        $req = $ctxDb->query($sqlReq);

        $req->setFetchMode(PDO::FETCH_CLASS, 'User');
        $users = $req->fetchAll();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $users;
    }
}


function getUserById(int $id){
    $user = null;
    $sqlReq = "SELECT * FROM comptes_m2i WHERE id=:id";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS, 'User');
        $ret = $req->execute();

        if ($ret){
            $user = $req->fetch();
        }
    }
    catch (Exception $ex) {
        var_dump ($ex->getMessage());
    }
    finally {
        return $user;
    }
}


function getUserByEmail(string $email){
    $user = null;
    $sqlReq = "SELECT * FROM comptes_m2i WHERE email=:email";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->setFetchMode(PDO::FETCH_CLASS, 'User');
        $ret = $req->execute();

        if ($ret){
            $user = $req->fetch();
        }
    }
    catch (Exception $ex) {
        var_dump ($ex->getMessage());
    }
    finally {
        return $user;
    }
}


function addUser(User $user){
    $ret = false;

    $sqlReq = "INSERT INTO comptes_m2i (nom, prenom, email, password, statut)";

    $sqlReq .= " VALUES(:nom, :prenom, :email, :password, :statut)";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':nom', $user->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $user->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':statut', $user->getStatut(), PDO::PARAM_STR);

        // Hash du mot de passe avant l'écriture en BDD
        $hashPassword = $user->encryptPasswd($user->getPassword());
        $req->bindValue(':password', $hashPassword, PDO::PARAM_STR);

        $ret = $req->execute();
    }

    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}


// Changer le statut d'un utilisateur
// **********************************
function changeUserStatut(int $id, string $newStatus): bool {
    $ret = false;

    $sqlReq = "UPDATE comptes_m2i SET statut = :statut WHERE id = :id";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':statut', $newStatus, PDO::PARAM_STR);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $ret = $req->execute();
    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}
