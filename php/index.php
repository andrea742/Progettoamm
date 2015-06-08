<?php

include_once 'controller/ControllerBase.php';
include_once 'controller/ControllerCliente.php';
include_once 'controller/ControllerVenditore.php';

date_default_timezone_set("Europe/Rome");

ControllerMain::findUserType($_REQUEST);

class ControllerMain
{


    public static function findUserType(&$request)
    {         
       
        session_start();
        
       
        if(isset($request["logout"]))
        {
            if($request["logout"] === 'Logout') 
            {
                $cont = new ControllerBase();
                $cont->handleInput($request);
            }
        }
        else
        {   
            if(isset($_SESSION['role']))
            {
                switch($_SESSION['role'])
                {
                  //cliente
                    case '1':
                        $cont = new ControllerCliente();
                        $cont->handleInput($request); 
                        break;

                   //venditore
                    case '2':
                        $cont = new ControllerVenditore();
                        $cont->handleInput($request);
                        break;
                }
            }
            else   
            {
                $cont = new ControllerBase();
                $cont->handleInput($request);            
            }
        }
    }
}

?>