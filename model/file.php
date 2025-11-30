<?php 
    include("../util/main.php");

    $file_dir_path = $doc_root . $app_path . 'files';
    $file_dir_path = str_replace('/', DIRECTORY_SEPARATOR, $file_dir_path);
    $file_dir_path = str_replace('\\', DIRECTORY_SEPARATOR, $file_dir_path);

    class File {
        const MAX_SIZE = 5 * 1024 * 1024;
        
        /*
            upload()

            Funcion que sube un archivo
            Parametro: Nombre del input tipo file
            Devuelve: un mensaje si hubo un error
                    True si se cargo sin problema
        */
        public static function upload($fileName){
            global $file_dir_path;

            /*  Primero verifica si se envio un archivo,
                Luego verifica que se haya seleccionado un archivo
                Y por ultimo añade el archivo a la carpeta de /files/ */
            if(isset($_FILES[$fileName])) {

                $filename = $_FILES[$fileName]['name'];

                if(!empty($filename)) {

                    if($_FILES[$fileName]['size'] <= File::MAX_SIZE){

                        $tmp_name = $_FILES[$fileName]['tmp_name'];
                        $name = $file_dir_path . DIRECTORY_SEPARATOR . $_FILES[$fileName]['name'];
                        $success = move_uploaded_file($tmp_name, $name);

                        // Si no se almaceno correctamente devuelve un mensaje
                        if(!$success)
                            return 'El archivo no se pudo cargar';
                    }

                    else 
                        return 'El archivo debe ser menor de 5MB';
                }
            }
            return True;
        }

        /*
            getFile()

            Funcion que devuelve el path de un archivo
            Parametro: Nombre del archivo
            Devuelve: el path si el archivo existe
                      string vacio si el archivo no existe
        */
        public static function getFile($fileName) {
            global $app_path;

            if(isset($_FILES[$fileName])) {
                $app_path = str_replace('/', DIRECTORY_SEPARATOR, $app_path);
                $app_path = str_replace('\\', DIRECTORY_SEPARATOR, $app_path);
                return $app_path . "files". DIRECTORY_SEPARATOR . $fileName;
            }
            else
                return "";
        }

        /*
            getFileName()

            Funcion que devuelve el nombre de un archivo
            Parametro: Nombre del input con el archivo
        */
        public static function getFileName($fileName) {
            return $_FILES[$fileName]['name'];
        }

        /*
            deleteFile()

            Funcion que elimina un archivo
            Parametro: Nombre del archivo
        */
        public static function deleteFile($fileName) {
            global $file_dir_path;

            $path = $file_dir_path . DIRECTORY_SEPARATOR . $fileName;
            if(file_exists($path))
                if(unlink($path))
                    return True;
                    
            return False;
        }
    }
?>