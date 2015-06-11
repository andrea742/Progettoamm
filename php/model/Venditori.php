<?php

include_once 'User.php';

/**
 * Classe che rappresenta un AddettoOrdini
 *
 * @author Davide Spano
 */
class Venditori extends User {


    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Venditori);
    }


}

?>