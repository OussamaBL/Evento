<?php 

class oussama{
    private $id;
    private $nom;
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function getNom(){
        return $this->id;
    }
    public function setNom($nom){
        $this->nom=$nom;
    }
    public function __construct($id,$nom){
        $this->id=$id;
        $this->nom=$nom;
    }

}

class ahmed extends oussama{
    private $age;
    public function getAge(){
        return $this->age;
    }
    public function setAge($age){
        $this->age=$age;
    }
    public function __construct($id, $nom,$age){
        super::construct($nom)
    }
}