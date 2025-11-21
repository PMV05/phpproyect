<!-- Clase para guardar la informacion completa de una oportunidad -->
<?php

class Opportunity {
    private string $title = "";
    private string $description = "";
    private string $sponsor = "";
    private string $url = "";
    private string $attachment = "";
    private DateTime $datePosted;
    private DateTime $deadline;
    private string $type = "";
    private string $author = "";
    

    // Constructor para inicializar los atributos de la clase
    public function __construct(
        string $title = "",
        string $description = "",
        string $sponsor = "",
        string $url = "",
        string $attachment = "",
        string $datePosted = "",
        string $deadline = "",
        string $type = "",
        string $author = ""
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->sponsor = $sponsor;
        $this->url = $url;
        $this->attachment = $attachment;
        $this->datePosted = new DateTime($datePosted);
        $this->deadline = new DateTime($deadline);
        $this->type = $type;
        $this->author = $author;
    }

    # setTitle()
    #
    # Asigna valor al atributo de title
    # Recibe: el titulo de la oportunidad 
    public function setTitle(string $title){
        $this->title = $title;
    }
    # getTitle()
    #
    # Devuelve el valor del atributo title
    public function getTitle(){
        return $this->title;
    }

    # setDescription()
    #
    # Asigna valor al atributo de description
    # Recibe: la descripcion de la oportunidad 
    public function setDescription(string $description){
        $this->description = $description;
    }
    # getDescription()
    #
    # Devuelve el valor del atributo description
    public function getDescription(){
        return $this->description;
    }

    # setSponsor()
    #
    # Asigna valor al atributo de sponsor
    # Recibe: el patrocinador de la oportunidad 
    public function setSponsor(string $sponsor){
        $this->sponsor = $sponsor;
    }
    # getSponsor()
    #
    # Devuelve el valor del atributo sponsor
    public function getSponsor(){
        return $this->sponsor;
    }

    # setURL()
    #
    # Asigna valor al atributo de url
    # Recibe: el url de la oportunidad 
    public function setURL(string $url){
        $this->url = $url;
    }
    # getURL()
    #
    # Devuelve el valor del atributo url
    public function getURL(){
        return $this->url;
    }

    # setAttachment()
    #
    # Asigna valor al atributo de attachment
    # Recibe: el nombre del archivo adjunto en la oportunidad 
    public function setAttachment(string $attachment){
        $this->attachment = $attachment;
    }
    # getAttachment()
    #
    # Devuelve el valor del atributo attachment
    public function getAttachment(){
        return $this->attachment;
    }
    
    # setDatePosted()
    #
    # Asigna valor al atributo de datePosted
    # Recibe: el dia que se publico la oportunidad 
    public function setDatePosted(string $datePosted){
        $this->datePosted = new DateTime($datePosted);
    }
    # getDatePosted()
    #
    # Devuelve el valor del atributo datePosted
    public function getDatePosted(){
        return $this->datePosted;
    }
    
    # setDeadline()
    #
    # Asigna valor al atributo de deadline
    # Recibe: el dia que termina la oferta de la oportunidad 
    public function setDeadline(string $deadline){
        $this->deadline = new DateTime($deadline);
    }
    # getDeadline()
    #
    # Devuelve el valor del atributo deadline
    public function getDeadline(){
        return $this->deadline;
    }

    # setType()
    #
    # Asigna valor al atributo de type
    # Recibe: el tipo de la oportunidad 
    public function setType(string $type){
        $this->type = $type;
    }
    # getType()
    #
    # Devuelve el valor del atributo type
    public function getType(){
        return $this->type;
    }

    # setAuthor()
    #
    # Asigna valor al atributo de author
    # Recibe: el autor de la oportunidad 
    public function setAuthor(string $author){
        $this->author = $author;
    }
    # getAuthor()
    #
    # Devuelve el valor del atributo author
    public function getAuthor(){
        return $this->author;
    }
}
?>