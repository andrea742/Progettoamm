<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/Pizza_ordineFactory.php'; //controlla questo
include_once basename(__DIR__) . '/../model/OrarioFactory.php';//controlla questo
include_once basename(__DIR__) . '/../model/PizzaFactory.php';//controlla questo
include_once basename(__DIR__) . '/../model/OrdineFactory.php';//controlla questo

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
                     
                        $idPizze = PizzaFactory::instance()->getIdPizze();
                        
                       
                        $nPizze = $this->validaForm($idPizze, $request);
                        $flagOrario = false;
                        
                       
                        $ordine = new Ordine();
                        $ordine->setId(OrdineFactory::instance()->getLastId());
                        $ordineId = $ordine->getId();
                        
                      
                        if($nPizze){
                                
                            $orari = OrarioFactory::instance()->getOrariSuccessivi($request['orario']);  
                            foreach ($orari as $orario) {
                                if((Pizza_ordineFactory::instance()->getNPizzePerOrario($orario->getId())+$nPizze) <= $orario->getOrdiniDisponibili()){
                                    
                                    $ordine->setOrario($orario->getId());
                                    $flagOrario = true;
                                    break;
                                }else $ordine->setOrario(NULL);
                            }
                        }
                        else{
                            $msg[]='<li>I valori inseriti non sono validi. Ordine annullato</li>';
                            $vd->setSottoPagina('ordina');    
                            $this->creaFeedbackUtente($msg, $vd, "");
                            $this->showHomeUtente($vd);
                        break;                            
                        }
                        
						if($flagOrario){
                            
                            OrdineFactory::instance()->nuovoOrdine($ordine);     //controlla                      

                            foreach($idPizze as $idPizza){
                                $quantita = filter_var($request[$idPizza.'normali'], FILTER_VALIDATE_INT,  FILTER_NULL_ON_FAILURE);
                                if (isset($quantita)){
                                   Pizza_ordineFactory::instance()->creaPO($idPizza, $ordineId, $quantita, "normale");}
                                $quantita = filter_var($request[$idPizza.'giganti'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);    
                                if (isset($quantita)){
                                   Pizza_ordineFactory::instance()->creaPO($idPizza, $ordineId, $quantita, "gigante");}
                            }
                            OrdineFactory::instance()->aggiornaOrdine($user, $ordine, $request['domicilio']);                     
                        } 
                
                        else {
                            Pizza_ordineFactory::instance()->cancellaPO($ordineId);
                            OrdineFactory::instance()->cancellaOrdine($ordineId);                           
                            $msg[]= '<li>Non è possibile ordinare questo quantitativo di pizze in nessuna fascia oraria odierna';
                            $vd->setSottoPagina('ordina');                            
                        }
                        $this->creaFeedbackUtente($msg, $vd, "");
                        $this->showHomeUtente($vd);
                        break;
						
						
						//controlla questo caso 
						
						case 'dettaglio':
                       
                        $_SESSION['pagina'] = 'dettaglio_ordine.php'; 
                        $ordineId = filter_var($request['ordine'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                        $ordine = OrdineFactory::instance()->getOrdine($ordineId);
                        $POs = Pizza_ordineFactory::instance()->getPOPerIdOrdine($ordine);
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
					
					
                    case 'cancella_ordine':
                      
                        $msg = array();
                        $ordineId = $request['ordineId'];
                        $p = Pizza_ordineFactory::instance()->cancellaPO($ordineId);
                        $o = OrdineFactory::instance()->cancellaOrdine($ordineId);
                        if ($p && $o) {
                            $this->creaFeedbackUtente($msg, $vd, "Ordine ".$ordineId." cancellato.");
                        }else $this->creaFeedbackUtente('<li>Errore cancellazione</li>', $vd, "");
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
 
   //questa funzione è da modificare
    private function validaForm($idPizze , $request) {
         $valide = 0;
         foreach($idPizze as $idPizza){
            $quantitaN = filter_var($request[$idPizza.'normali'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            if (isset($quantitaN) && ($quantitaN != 0)) $valide+=$quantitaN;
            $quantitaG = filter_var($request[$idPizza.'giganti'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            if (isset($quantitaG) && ($quantitaG != 0)) $valide+=$quantitaG;   
         }
         
         return $valide;
    }

}

?>
