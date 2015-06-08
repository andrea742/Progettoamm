<?php

include_once 'controller/BaseController.php';
include_once 'controller/ClienteController.php';
include_once 'controller/VenditoreController.php';

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
                $cont = new BaseController();
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
                        $cont = new ClienteController();
                        $cont->handleInput($request); 
                        break;

                   //venditore
                    case '2':
                        $cont = new VenditoreController();
                        $cont->handleInput($request);
                        break;
                }
            }
            else   
            {
                $cont = new BaseController();
                $cont->handleInput($request);            
            }
        }
    }
}

?>