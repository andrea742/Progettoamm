<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/Pizza_ordineFactory.php'; // da controllare
include_once basename(__DIR__) . '/../model/OrarioFactory.php';// da controllare
include_once basename(__DIR__) . '/../model/PizzaFactory.php';// da controllare
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
                    case 'anagrafica':
                        $_SESSION['pagina'] = 'anagrafica.php';   
                        $vd->setSottoPagina('anagrafica');
                        break;
                    
                    //controlal questo caso
                    case 'gestione_ordini':
                        $_SESSION['pagina'] = 'gestione_ordini.php';
                        $ordini = OrdineFactory::instance()->getOrdiniNonPagati();
                        $vd->setSottoPagina('gestione_ordini');
                        break;
                    
                  //controlal questo caso
                    case 'ricerca_ordini':
                        $_SESSION['pagina'] = 'ricerca_ordini.php';
                        $orari = OrarioFactory::instance()->getOrari();
                        $date = OrdineFactory::instance()->getDate();
                        $vd->setSottoPagina('ricerca_ordini');
                   
                        $vd->addScript("../js/jquery-2.1.1.min.js");
                        $vd->addScript("../js/ricercaOrdini.js");
                        break;                    
                    
                     //controlal questo caso
                    case 'filtra_ordini':
                        $vd->toggleJson();
                        $vd->setSottoPagina('ricerca_ordini_json');
                        
                        $errori = array();

                        if (isset($request['myData']) && ($request['myData'] != '')) {
                            $data = $request['myData'];
                        } else {
                            $data = null;
                        }

                        if (isset($request['myOra']) && ($request['myOra'] != '')) {
                            $ora = $request['myOra'];
                        } else {
                            $ora = null;
                        }
                       
                        $ordini = OrdineFactory::instance()->getOrdiniPerDataOra($data, $ora);
                        

                        
                        break;

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
                        $POs = Pizza_ordineFactory::instance()->getPOPerIdOrdine($ordine);
                        $cliente = UserFactory::instance()->getClientePerId($ordine->getCliente());
                        $vd->setSottoPagina('dettaglio_ordine');
                        $this->showHomeUtente($vd);
                        break; 
                    
					 //controlal questo caso
					
                    case 'paga':
                        
                        $msg = array();
                        $ordineId = filter_var($request['ordine'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                        if (OrdineFactory::instance()->setPagato($ordineId, $user)) {
                            $this->creaFeedbackUtente($msg, $vd, "Ordine ".$ordineId." pagato.");
                        }else $this->creaFeedbackUtente($msg, $vd, "Errore cancellazione"); 
                        
                        $vd->setSottoPagina('gestione_ordini');
                        $ordini = OrdineFactory::instance()->getOrdiniNonPagati();
                        $this->showHomeUtente($vd);                        
                        break;

                   
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
