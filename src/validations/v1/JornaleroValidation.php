<?php
namespace Src\Validations\v1;

use Src\Libs\UtilResponse, DateTime;

class JornaleroValidation{

    public static function validate($data){
        
        $utilResponse = new UtilResponse();
        
        $key = 'nombres';
        
        if(empty($data[$key])){
            $utilResponse->errors[$key][] = "El campo ".$key." es obligatorio";
        }
        else{
            if(strlen($data[$key]) < 4){
                $utilResponse->errors[$key][] = "El campo ".$key." debe ser mayor a 3 letras";
            }else{
                $pattern = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';
                if(!preg_match($pattern, $data[$key])){
                    $utilResponse->errors[$key][] = "El campo ".$key." debe contener solo letras y espacios";
                }
            }
        }

        $isValid = count($utilResponse->errors) === 0;

        $utilResponse->setResponse($isValid);
        $utilResponse->object = $data;
        return $utilResponse;
    }
}
?>