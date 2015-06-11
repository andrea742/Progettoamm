<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/OrdineFactory.php';
include_once basename(__DIR__) . '/../model/Articolo_ordineFactory.php';//controlla questo

class ClienteController extends BaseController { // questa funzione è da modificare

    
   
    public function __construct() {
        parent::__construct();
    }
    
	
	public function handleInput(&$request) {

        
        $vd = new ViewDescriptor();


        // imposto la pagina
        $vd->setPagina($request['page']);

        

        if (!$this->loggedIn()) {
           

            $this->showLoginPage($vd);
        } else {
            
            $user = UserFactory::instance()->cercaUtentePerId(
                            $_SESSION[BaseController::user], $_SESSION[BaseController::role]);


          
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                   
                    case 'anagrafica':
                        $_SESSION['pagina'] = 'anagrafica.php';   //controlla questa pagina, è anche da fare
                        $vd->setSottoPagina('anagrafica');
                        break;

                   //controlla questo caso 
                    case 'ordina':                        
                        $_SESSION['pagina'] = 'ordina.php';
                        $pizze = PizzaFactory::instance()->getPizze();
                        $orari = OrarioFactory::instance()->getOrari();
                        $vd->setSottoPagina('ordina');
                        break;

                     //controlla questo caso 
                    case 'elenco_ordini':
                        $_SESSION['pagina'] = 'elenco_ordini.php'; 
                        $ordini = OrdineFactory::instance()->getOrdiniPerIdCliente($user);
                        $vd->setSottoPagina('elenco_ordini');
                        break;                    

                     //controlla questo caso 
                    case 'contatti':
                        $_SESSION['pagina'] = 'contatti.php';  
                        $vd->setSottoPagina('contatti');
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
                        
						//controlla questo caso
                    case 'procedi_ordine':
                        
                        $vd->setSottoPagina('conferma_ordine');
                        $msg = array();
                     
                        $idOrdine = OrdineFactory::instance()->getIdOrdine();
                        
                       
                        $nOrdine = $this->validaForm($idOrdine, $request);
                        $flagOrario = false;
                        
                       
                        $ordine = new Ordine();
                        $ordine->setId(OrdineFactory::instance()->getLastId());
                        $ordineId = $ordine->getId();
                        
                      
                        
                        
						
                
                       
                        $this->creaFeedbackUtente($msg, $vd, "");
                        $this->showHomeUtente($vd);
                        break;
						
						
						//controlla questo caso 
						
						case 'dettaglio':
                       
                        $_SESSION['pagina'] = 'dettaglio_ordine.php'; 
                        $ordineId = filter_var($request['ordine'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                        $ordine = OrdineFactory::instance()->getOrdine($ordineId);
                        $POs = Articolo_ordineFactory::instance()->getPOPerIdOrdine($ordine);
                        $vd->setSottoPagina('dettaglio_ordine');
                        $this->showHomeUtente($vd);
                        break; 
                    
					//controlla questo caso 
					
                    case 'conferma_ordine':
                        
                        $msg = array();
                        $ordineId = $request['ordineId'];                        
                        $this->creaFeedbackUtente($msg, $vd, "Ordine ".$ordineId." creato con successo.");
                        $vd->setSottoPagina('home');
                        $this->showHomeUtente($vd);                        
                        break;
                    
					
					//controlla questo caso 
					
					
                    
					
                    case 'indirizzo':
                     
                        $msg = array();
                        $this->aggiornaIndirizzo($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Indirizzo aggiornato");
                        $this->showHomeCliente($vd);
                        break;


                    //controlla questo caso 
					
					
                    case 'password':
                       
                        $msg = array();
                        $this->aggiornaPassword($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password aggiornata");
                        $this->showHomeCliente($vd);
                        break;


                    default : $this->showHomeUtente($vd);
                }
            } else {
                
                $user = UserFactory::instance()->cercaUtentePerId($_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
            
            
        }

       
        require basename(__DIR__) . '/../view/master.php'; //file da fare
		
		
		 }
 
  

}

?>
