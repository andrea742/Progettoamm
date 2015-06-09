<?php

include_once basename(__DIR__) . '/../view/ViewDescriptor.php'; //file da fare
include_once basename(__DIR__) . '/../model/User.php';//file da fare
include_once basename(__DIR__) . '/../model/UserFactory.php';//file da fare

class BaseController {

    const user = 'user';
    const role = 'role';
	
	 public function __construct() {
        
    }
	
	public function handleInput(&$request) {
 
        $vd = new ViewDescriptor();
		 $vd->setPagina($request['page']);
		 
		 if (isset($request["cmd"])) {
           
            switch ($request["cmd"]) {
                case 'login':
                    $username = isset($request['user']) ? $request['user'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    $this->login($vd, $username, $password);
                   
                    if ($this->loggedIn())
                        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
                    break;
                default : $this->showLoginPage();
            }
        } else {
            if ($this->loggedIn()) {
            
                $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);

                $this->showHomeUtente($vd);
            } else {
               
                $this->showLoginPage($vd);
            }
        }
		
		 require basename(__DIR__) . '/../view/master.php';//file da fare
    }
	
	protected function loggedIn() {
        return isset($_SESSION) && array_key_exists(self::user, $_SESSION);
    }

 protected function showLoginPage($vd) {//controlla il nome della funzione e cosa deve fare
	 
	 $vd->setTitolo("Purchase.it - login");
        $vd->setMenuFile(basename(__DIR__) . '/../view/login/menu.php');
        $vd->setLogoFile(basename(__DIR__) . '/../view/login/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/login/leftBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/login/content.php');
    }
	
	 protected function showHomeCliente($vd) {//controlla il nome della funzione e cosa deve fare
		 
		 
		 $vd->setTitolo("Purchase.it - gestione cliente ");
        $vd->setMenuFile(basename(__DIR__) . '/../view/cliente/menu.php');
        $vd->setLogoFile(basename(__DIR__) . '/../view/cliente/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/cliente/leftBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/cliente/content.php');
    }
	
	 protected function showHomeAddettoOrdini($vd) {//controlla il nome della funzione e cosa deve fare
      
        $vd->setTitolo("Purchase.it - gestione addetto ordini");
        $vd->setMenuFile(basename(__DIR__) . '/../view/addettoOrdini/menu.php');
        $vd->setLogoFile(basename(__DIR__) . '/../view/addettoOrdini/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/addettoOrdini/leftBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/addettoOrdini/content.php');
    }
	
	protected function showHomeUtente($vd) {
        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
        switch ($user->getRuolo()) {
            case User::Cliente:
                $this->showHomeCliente($vd);
                break;

            case User::AddettoOrdini://controlla qua
                $this->showHomeAddettoOrdini($vd);//controlla qua
                break;

        }
    }
	
	 protected function login($vd, $username, $password) {
      

        $user = UserFactory::instance()->caricaUtente($username, $password);
        if (isset($user) && $user->esiste()) {
           
            $_SESSION[self::user] = $user->getId();
            $_SESSION[self::role] = $user->getRuolo();
            $this->showHomeUtente($vd);
        } else {
            $vd->setMessaggioErrore("Utente sconosciuto o password errata");
            $this->showLoginPage($vd);
        }
    }
	
	
	 protected function logout($vd) {
    
        $_SESSION = array();
   
        if (session_id() != '' || isset($_COOKIE[session_name()])) {
        
            setcookie(session_name(), '', time() - 2592000, '/');
        }
      
        session_destroy();
        $this->showLoginPage($vd);
    }
	
	
	
	
protected function aggiornaIndirizzo($user, &$request, &$msg) { //attenzione a questa funzione è da modificare tutta

        if (isset($request['via'])) {
            if (!$user->setVia($request['via'])) {
                $msg[] = '<li>La via specificata non &egrave; corretta</li>';
            }
        }
        if (isset($request['civico'])) {
            if (!$user->setCivico($request['civico'])) {
                $msg[] = '<li>Il formato del numero civico non &egrave; corretto</li>';
            }
        }
        if (isset($request['citta'])) {
            if (!$user->setCitta($request['citta'])) {
                $msg[] = '<li>La citt&agrave; specificata non &egrave; corretta</li>';
            }
        }
        if (isset($request['cap'])) {
            if (!$user->setCap($request['cap'])) {
                $msg[] = '<li>Il CAP specificato non &egrave; corretto</li>';
            }
        }
        if (isset($request['telefono'])) {
            if (!$user->setTelefono($request['telefono'])) {
                $msg[] = '<li>Il telefono specificato non &egrave; corretto</li>';
            }
        }        //la funzione è da modificare sino a qua
		
		
		
		if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
    }
    
        protected function aggiornaPassword($user, &$request, &$msg) { //attenzione a questa funzione è da modificare
        if (isset($request['pass1']) && isset($request['pass2'])) {
            if ($request['pass1'] == $request['pass2']) {
                if (!$user->setPassword($request['pass1'])) {
                    $msg[] = '<li>Il formato della password non &egrave; corretto</li>';
                }
            } else {
                $msg[] = '<li>Le due password non coincidono</li>';
            }
        }//è da modificare sino a qua
		
		if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
    }
	
	protected function creaFeedbackUtente(&$msg, $vd, $okMsg) {
        if (count($msg) > 0) {
            
            $error = "Si sono verificati i seguenti errori: \n<ul>\n";
            foreach ($msg as $m) {
                $error = $error . $m . "\n";
            }
          
            $vd->setMessaggioErrore($error);
        } else {
         
            $vd->setMessaggioConferma($okMsg);
        }
    }

}

?>

	
	
	
	
	
	
	