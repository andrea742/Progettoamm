<?php


class Settings {

   
    public static $db_host = 'localhost';
    public static $db_user = 'sabiuAndrea';
    public static $db_password = 'talpa816';
    public static $db_name='amm14_sabiuAndrea';
    
    private static $appPath;
	
	
	public static function getApplicationPath() {
        if (!isset(self::$appPath)) {
            
            switch ($_SERVER['HTTP_HOST']) {
                case 'localhost':
                    // configurazione locale
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/Progettoamm/';
                    break;
                case 'spano.sc.unica.it':
                    // configurazione pubblica
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2014/sabiuAndrea/Progettoamm/';
                    break;

                default:
                    self::$appPath = '';
                    break;
            }
        }
        
        return self::$appPath;
    }

}

?>
