<?php 
    // Este namespace tiene funciones para poder validar algunos datos 
    namespace validate{
        /*
            title()

            Valida que se haya entrado un titulo
            Parametros: titulo de una oportunidad
            Devuelve: true si se entro algo, y false 
                      si no se entro nada
        */
        function title(string $title){
            return !empty($title);
        }

        /*
            type()

            Valida que se haya entrado un tipo
            Parametros: id del tipo de la oportunidad
            Devuelve: true si se entro un id valido, y 
                      false si se entro un id invalido
        */
        function type(int $type){
            return $type > 0;
        }

        /*
            userID()

            Valida el id del usuario (username)
            Parametros: id del tipo de la oportunidad
            Devuelve: true si cumple con el patron, y 
                      false si el username no es valido
        */
        function userID(string $userID){
            return preg_match('[[:alnum:]]+[\.][[:alnum:]]+', $userID);
        }

        /*
            description()

            Valida que se haya entrado una descripcion
            Parametros: descripcion de la oportunidad
            Devuelve: true si se entro una descripcion, y 
                      false si no se entro una descripcion
        */
        function description(string $description){
            return !empty($description);
        }  

        /*
            sponsor()

            Valida que se haya entrado un patrocinador
            Parametros: patrocinador de la oportunidad
            Devuelve: true si se entro una patrocinador, y 
                      false si no se entro un patrocinador
        */
        function sponsor(string $sponsor){
            return !empty($sponsor);
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
    }
?>