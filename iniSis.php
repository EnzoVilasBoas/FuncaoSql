<?php
class Environment{
    /**
     * Carrega variáveis de ambiente 
     * **/
    public static function load($diretorio){
         $file = file($diretorio.'.env');
        foreach($file as $file){
            putenv(trim($file));
        }
    }
}

Environment::load(__DIR__.'\\');

define("TITULO",getenv('TITULO'));
define("DESCRICAO",getenv('DESCRICAO'));
define("AUTOR",getenv('AUTOR'));
define("BASE",getenv('BASE'));
define("BASESIS",getenv('BASESIS'));
define("HOST",getenv('HOST'));
define("PORT",getenv('PORT'));
define("USER",getenv('USER'));
define("PASS",getenv('PASS'));
define("DBSA",getenv('DBSA'));
define("MAILHOST",getenv('MAILHOST'));
define("MAILUSER",getenv('MAILUSER'));
define("MAILPASS",getenv('MAILPASS'));
define("MAILPORT",getenv('MAILPORT'));
define("VERSION",getenv('VERSION'));
define("LOG",getenv('LOG'));
