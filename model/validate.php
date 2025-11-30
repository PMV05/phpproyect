<?php 
    // Este namespace tiene funciones para poder validar algunos datos 
    namespace validate{
        /*
            userID()

            Valida el id del usuario (username)
            Parametros: id del usuario
            Devuelve: true si cumple con el patron, y 
                      false si el username no es valido
        */
        function userID(string $userID){
            return preg_match('/^[[:alnum:]]+\.[[:alnum:]]+$/', $userID);
        } 

        /*
            password()

            Valida el password
            Parametros: password del usuario
            Devuelve: true si cumple con los requisitos, y 
                      false si la contraseña no es valida
        */
        function password(string $password){
            $pattern = '/^ (?=.*[[:digit:]]) (?=.*[[:upper:]]) (?=.*[[:lower:]]) (?=.*[[:punct:]]) [[:graph:]] {8,}$/';

            return preg_match('[[:alnum:]]+[\.][[:alnum:]]+', $userID);
        } 

        /*
            url()

            Valida el url
            Parametros: url adjuntado
            Devuelve: true si es valido, y 
                      false si no es valido
        */
        function url(string $url){
            if(filter_var($url, FILTER_VALIDATE_URL))
                return true;
            else 
                return false;
        }   

        /*
            email()

            Valida el email
            Parametros: email para validar
            Devuelve: true si es valido, y 
                      false si no es valido
        */
        function email(string $email){
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
                return true;
            else 
                return false;
        }        

        /*
            requiredField()
        
            Valida que hayan valores en los campos requeridos
            Parametro: el valor que se va a validar
            Devuelve: true si es valido
                    false si no es valido
        */
        function requiredField($value) {
            if(empty($value))
                return False;

            return True;
        }
    }
?>