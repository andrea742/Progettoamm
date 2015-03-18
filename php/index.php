<?php

include_once 'controller/ControllerBase.php';
include_once 'controller/ControllerSeller.php';
include_once 'controller/ControllerBuyer.php';

date_default_timezone_set("Europe/Rome");

FrontController::dispatch($_REQUEST);

class FrontController {
	
	public static function dispatch(&$request) {
		
        session_start();
        if (isset($request["page"])) {

            switch ($request["page"]) {
                case "login":
                    
                    $controller = new BaseController();
                    $controller->handleInput($request);
                    break;
					
					
				case 'seller':
                    
                    $controller = new ControllerSeller();
                    if (isset($_SESSION[ControllerBase::role]) &&
                        $_SESSION[ControllerBase::role] != User::Seller) {
                        self::write403();
                    }
                    $controller->handleInput($request);
                    break;
					
				case 'buyer':
                    
                    $controller = new ControllerBuyer();
                    if (isset($_SESSION[ControllerBase::role]) &&
                        $_SESSION[ControllerBase::role] != User::Buyer) {
                        self::write403();
                    }
                    $controller->handleInput($request);
                    break;
					
					default:
                    self::write404();
                    break;
            }
        } else {
            self::write404();
        }
    }
	
	
	
	
	
	
	 public static function write404() {
        header('HTTP/1.0 404 Not Found');
        $titolo = "File non trovato!";
        $messaggio = "La pagina che hai richiesto non &egrave; disponibile";
        include_once('error.php');
        exit();
    }
	
	
	
	
	
	
	    public static function write403() {
        header('HTTP/1.0 403 Forbidden');
        $titolo = "Accesso negato";
        $messaggio = "Non hai i diritti per accedere a questa pagina";
        $login = true;
        include_once('error.php');
        exit();
    }

}

?>
					
				