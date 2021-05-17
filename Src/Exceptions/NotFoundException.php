<?php
namespace App\Src\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{

    public function  __construct ( string $message = "" , int $code = 0 , ?Throwable $previous = null ){

        parent::__construct( $message, $code, $previous);
    }

    public function erreur404(){
        http_response_code(404);
        $contenu = '<div class = "mx-auto text-center"><p>La page demandée est introuvable ! </p></div>';
        require '../Src/Views/default.php';
    }

    public function errorPDO(){
        http_response_code(404);
        $contenu = '<div class = "mx-auto text-center"><p>L\'application est en maintenance ! <br>Réessayez plutard </p></div>';
        require '../Src/Views/default.php';
    }

}