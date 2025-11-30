<?php
    namespace text{
        /*
            addTap()

            Funcion que cambiar los escape 
            sequence por tags de html
            Parametros: texto a modificar
            Devuelve: el texto con los tags 
        */
        function addTags($text) {
    
            // Sustituye los saltos de lineas (proxima linea)
            $text = str_replace("\r\n", "\n", $text);   // Para que funcione en Windows
            $text = str_replace("\r", "\n", $text); // Para que funcione en Mac

            // Sustituye los saltos dobles (parrafos)
            $paragraphs = explode("\n\n", $text);

            // Ciclo para añadir las etiquetas de html de los parrafos y listas 
            $text = "";
            foreach($paragraphs as $p){
                $p = ltrim($p);

                $first_char = substr($p, 0, 1);
                // Se crea un lista desordenada
                if($first_char == '*') {
                    $p = "<ul>" . $p . "</li></ul>";
                    $p = str_replace("*", "<li class='desc-list'>", $p);
                    $p = str_replace("\n", "</li>", $p);
                }

                // Se crea un parrafo
                else {
                    $p = "<p>" . $p . "</p><br>";
                }

                $text .= $p;
            }

            return $text;
        } 
    }
?>