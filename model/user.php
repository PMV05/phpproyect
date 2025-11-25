<?php

# Clase para guardar la informaci0n de lo usuario
class User {
    private string $userID ;
    private string $email ;
    private string $password ;
    private int $userRole ;

    # Constructor para inicializar los atributos de la clase
    public function __construct(
        string $userID = "",
        string $email = "",
        string $password = "",
        int $userRole = 0
    ) 
    
    {
        $this->userID = $userID;
        $this->email = $email;
        $this->password = $password;
        $this->userRole = $userRole;
    }

    # setUserID()
    #
    # Asigna valor al atributo userID
    # Recibe: el ID del usuario
    public function setUserID(string $userID){
        $this->userID = $userID;
    }

    # getUserID()
    #
    # Devuelve el valor del atributo userID
    public function getUserID(){
        return $this->userID;
    }

    # setEmail()
    #
    # Asigna valor al atributo email
    # Recibe: el email del usuario
    public function setEmail(string $email){
        $this->email = $email;
    }

    # getEmail()
    #
    # Devuelve el valor del atributo email
    public function getEmail(){
        return $this->email;
    }

    # setPassword()
    #
    # Asigna valor al atributo password
    # Recibe: la contraseña del usuario
    public function setPassword(string $password){
        $this->password = $password;
    }

    # getPassword()
    #
    # Devuelve el valor del atributo password
    public function getPassword(){
        return $this->password;
    }

    # setUserRole()
    #
    # Asigna valor al atributo userRole
    # Recibe: el rol del usuario 
    public function setUserRole(int $userRole){
        $this->userRole = $userRole;
    }

    # getUserRole()
    #
    # Devuelve el valor del atributo userRole
    public function getUserRole(){
        return $this->userRole;
    }
}
?>



