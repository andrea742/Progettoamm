<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/Articolo_ordineFactory.php'; // da controllare
include_once basename(__DIR__) . '/../model/OrdineFactory.php';// da controllare

class VenditoreController extends BaseController { //controlla il nome della classe


    public function __construct() {
        parent::__construct();
    }

    
    public function handleInput(&$request) {

        
        $vd = new ViewDescriptor();

        
        $vd->setPagina($request['page']);

        if (!$this->loggedIn()) {
           
            $this->showLoginPage($vd);
        } else {
        
            $user = UserFactory::instance()->cercaUtentePerId(
                    $_SESSION[BaseController::user], $_SESSION[BaseController::role]);

            
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                    
                   //controlal questo caso
                    case 'i_miei_dati':
                        $_SESSION['pagina'] = 'i_miei_dati.php';   
                        $vd->setSottoPagina('i_miei_dati');
                        break;
                    
                    case 'contatti':
                        $_SESSION['pagina'] = 'contatti.php';  
                        $vd->setSottoPagina('contatti');
                        break;
                    
                    case 'metti_in_vendita':
                        $_SESSION['pagina'] = 'metti_in_vendita.php';  
                        $vd->setSottoPagina('metti_in_vendita');
                        break;
                    
                    //controlal questo caso
                    case 'le_mie_vendite':
                        $_SESSION['pagina'] = 'le_mie_vendite.php';
                        $ordini = OrdineFactory::instance()->getOrdiniNonPagati();
                        $vd->setSottoPagina('le_mie_vendite');
                        break;
                    
                  //controlal questo caso // da togliere?
                    case 'ricerca_ordini':
                        $_SESSION['pagina'] = 'ricerca_ordini.php';
                        $orari = OrarioFactory::instance()->getOrari();
                        $date = OrdineFactory::instance()->getDate();
                        $vd->setSottoPagina('ricerca_ordini');
                   
                        $vd->addScript("../js/jquery-2.1.1.min.js");
                        $vd->addScript("../js/ricercaOrdini.js");
                        break;                    
                    
                     //controlal questo caso
                    

                    default:
                        $_SESSION['pagina'] = 'home.php';
                        $vd->setSottoPagina('home');
                        break;
                }
            }


            
            if (isset($request["cmd"])) {

                switch ($request["cmd"]) {

                    
                    case 'logout':
                        $this->logout($vd);
                        break;
                           
						   
						    //controlal questo caso
						              
                    case 'dettaglio':
                        
                                              
                        $_SESSION['pagina'] = 'dettaglio_ordine.php';                            
                        $ordineId = filter_var($request['ordine'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                        $ordine = OrdineFactory::instance()->getOrdine($ordineId);
                        $POs = Articolo_ordineFactory::instance()->getPOPerIdOrdine($ordine);
                        $cliente = UserFactory::instance()->getClientePerId($ordine->getCliente());
                        $vd->setSottoPagina('dettaglio_ordine');
                        $this->showHomeUtente($vd);
                        break; 
                    
					 //controlal questo caso
					
                    
                   
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
				
               
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }

      
        require basename(__DIR__) . '/../view/master.php'; // file da fare
    }


}

?>
