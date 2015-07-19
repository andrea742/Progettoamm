<?php

include_once 'User.php';
include_once 'Venditori.php';
include_once 'Cliente.php';
include_once 'Db.php';


/**
 * Classe per la creazione degli utenti del sistema
 *
 * @author Davide Spano
 */
class UserFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare utenti
     * @return \UserFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new UserFactory();
        }

        return self::$singleton;
    }

    /**
     * Carica un utente tramite username e password
     * @param string $username
     * @param string $password
     * @return \User|\AddettoOrdini|\Cliente
     */
    public function caricaUtente($username, $password) {


        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[loadUser] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        // cerco prima nella tabella clienti
        $query = "select * from clienti where  username = ? and  password = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input ");
            $mysqli->close();
            return null;
        }

        $cliente = self::caricaClienteDaStmt($stmt);
        if (isset($cliente)) {
            // ho trovato uno studente
            $mysqli->close();
            return $cliente;
        }

        // ora cerco un addetto agli ordini
        $query = "select * from venditori where username = ? and password = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $venditore = self::caricaVenditoriDaStmt($stmt);
        if (isset($venditore)) {
            // ho trovato un docente
            $mysqli->close();
            return $venditore;
        }
    }

    
    private function caricaClienteDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaClienteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['clienti_id'], 
                $row['clienti_username'],
                $row['clienti_password'],
                $row['clienti_nome'],
                $row['clienti_cognome'],
                 $row['clienti_mail'],
                 $row['clienti_indirizzo'],
                 $row['clienti_citta'],
                $row['clienti_cap']);
                
        
        if (!$bind) {
            error_log("[caricaClienteDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaClienteDaArray($row);
    }
    /**
     * Restituisce un array con i addetti agli ordini presenti nel sistema
     * @return array
     */
    public function &getListaClienti() {
        $cliente = array();
        $query = "select * from clienti";
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaClienti] impossibile inizializzare il database");
            $mysqli->close();
            return $cliente;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaClienti] impossibile eseguire la query");
            $mysqli->close();
            return $cliente;
        }

        while ($row = $result->fetch_array()) {
            $cliente[] = self::creaClienteDaArray($row);
        }
        //togliere?
        $mysqli->close();
        return $cliente;
    }

    /**
     * Crea un cliente da una riga del db
     * @param type $row
     * @return \Cliente
     */
    
    
    
   public function creaClienteDaArray($row) {
        $venditore = new Cliente();
        $venditore->setId($row['clienti_id']); 
        $venditore->setUsername($row['clienti_username']);
        $venditore->setPassword($row['clienti_password']);        
        $venditore->setNome($row['clienti_nome']);    
        $venditore->setCognome($row['clienti_cognome']);
        $venditore->setMail($row['clienti_mail']);
        $venditore->setIndirizzo($row['clienti_indirizzo']);
        $venditore->setCitta($row['clienti_citta']);                  
        $venditore->setCap($row['clienti_cap']);       
        $venditore->setRuolo(User::Cliente);

        return $venditore;
    }
    
    /**
     * Restituisce la lista degli clienti presenti nel sistema
     * @return array
     */
    public function &getListaVenditori() {
        $venditore = array();
        $query = "select * from venditori ";
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaVenditori] impossibile inizializzare il database");
            $mysqli->close();
            return $venditore;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaVenditori] impossibile eseguire la query");
            $mysqli->close();
            return $venditore;
        }

        while ($row = $result->fetch_array()) {
            $venditore[] = self::creaVenditoriDaArray($row);
        }

        return $venditore;
    }




    /**
     * Crea un addetto ordini da una riga del db
     * @param type $row
     * @return \AddettoOrdini
     */
    public function creaVenditoriDaArray($row) {
        $venditore = new Venditori();
        $venditore->setId($row['venditori_id']);
        $venditore->setUsername($row['venditori_username']);
        $venditore->setPassword($row['venditori_password']);
        $venditore->setNome($row['venditori_nome']);
        $venditore->setCognome($row['venditori_cognome']);
        $venditore->setTelefono($row['venditori_telefono']);
        $venditore->setRuolo(User::Venditore);
        

        return $venditore;
    }

    /**
     * Salva i dati relativi ad un utente sul db
     * @param User $user
     * @return il numero di righe modificate
     */
    public function salva(User $user) {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }

        $stmt = $mysqli->stmt_init();
        $count = 0;
        switch ($user->getRuolo()) {
            case User::Cliente:
                $count = $this->salvaCliente($user, $stmt);
                break;
            case User::Venditore:
                $count = $this->salvaVenditori($user, $stmt);
        }

        $stmt->close();
        $mysqli->close();
        return $count;
    }

    /**
     * Rende persistenti le modifiche all'anagrafica di uno studente sul db
     * @param Cliente $s lo studente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaCliente(Cliente $c, mysqli_stmt $stmt) {
        $query = " UPDATE clienti SET 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    mail = ?,
                    indirizzo = ?,
                    citta = ?,
                    cap = ?,
                    WHERE clienti.id = ?";
        
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaCliente] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('ssssissii',
                $c->getPassword(),
                $c->getNome(),
                $c->getCognome(),
                $c->getMail(), 
                $c->getIndirizzo(),
                $c->getCitta(),
                $c->getCap(),
                $c->getId())) {
            error_log("[salvaCliente] impossibile" .
                    " effettuare il binding in input 2");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[caricaIscritti] impossibile" .
                    " eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    /**
     * Rende persistenti le modifiche all'anagrafica di un docente sul db
     * @param AddettoOrdini $d il docente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaVenditori(Venditori $d, mysqli_stmt $stmt) {
        $query = " update venditori set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    telefono = ?,
                    where venditori.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaVenditori] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('ssssissii', 
                $d->getPassword(), 
                $d->getNome(), 
                $d->getCognome(), 
                $d->getTelefono(),
                $d->getId())) {
            error_log("[salvaCliente] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[caricaIscritti] impossibile" . //controlla qua
                    " eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }

    /**
     * Carica un docente eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaVenditoriDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaVenditoriDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['venditori_id'], 
                $row['venditori_username'], 
                $row['venditori_password'],                
                $row['venditori_nome'], 
                $row['venditori_cognome'], 
                $row['venditori_telefono']);
        if (!$bind) {
            error_log("[caricaVenditoriDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaVenditoriDaArray($row);
    }
    
    /**
     * Cerca un utente per id
     * @param int $id
     * @return  un oggetto Cliente nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaUtentePerId($id, $role) {
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaUtentePerId] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        switch ($role) {
            case User::Cliente:
                $query = "select  * from clienti where id = ?";
                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                return self::caricaClienteDaStmt($stmt);
                break;

            case User::Venditore:
                $query = "select * from venditori where id = ?";

                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[loadUser] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                $toRet =  self::caricaVenditoriDaStmt($stmt);
                $mysqli->close();
                return $toRet;
                break;

            default: return null;
        }
                
    }
    
    /*
    * @param $id id del cliente da ricercare
    * @return dati del cliente corrispondenti all'id considerato
    */    
    public function getClientePerId($id) {
       $venditore = array();
        $query = "SELECT * FROM clienti WHERE clienti.id = ? ";          
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getClientePerId] impossibile inizializzare il database");
            $mysqli->close();
            return $cliente;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getClientePerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $cliente;
        }

        if (!$stmt->bind_param('i', $id)) {
            error_log("[getClientePerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $cliente;
        } 
        
        $cliente = self::caricaClienteDaStmt($stmt);

        $mysqli->close();
        return $cliente;        
                
    }
}

?>
