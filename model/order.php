<?php 

require_once "model/dbaccess.php";

class Order_m2i{
    private int $id;
    private string $ref;
    private float $montant;
    private DateTime $date;
    private int $user_id;
    

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
     * Get the value of ref
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * Set the value of ref
     */
    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get the value of montant
     */
    public function getMontant(): float
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     */
    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}


/**
 * Création d'une nouvelle commande
 *
 * @param Order_m2i $order la commande à créer
 * @return bool $ret Resultat création (true / false)
 */
function createOrder(Order_m2i $order): int {
    $ret = false;
    $lastId = 0;

    $sqlReq = "INSERT INTO order_m2i (order_ref, order_montant, order_date, user_id)";
    $sqlReq .= " VALUES(:ref, :montant, :date, :client)";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':ref', $order->getRef(), PDO::PARAM_STR);
        $req->bindValue(':montant', $order->getMontant());
        $req->bindValue(':date', $order->getDate()->format("Y-m-d"));
        $req->bindValue(':client', $order->getUserId());

        $ret = $req->execute();
        if ($ret) {
            $lastId = intval($ctxDb->lastInsertId());
        }
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        // id de la commande que l'on vient de créer
        return $lastId;
    }
}

/**
 * REtorune le nombre de commandes
 *
 * @return integer
 */
function getNbOrders(): int {

    $nbOrders = 0;

    $sqlReq = "SELECT COUNT(order_id) as nb_orders FROM order_m2i GROUP BY order_id";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->query($sqlReq);
        $retNb = $req->fetch();

        if(!$retNb) {
            $nbOrders = 0;
        }
        else {
            $nbOrders = $retNb['nb_orders'];
        }

    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
    }
    finally {
        return $nbOrders;
    }

}