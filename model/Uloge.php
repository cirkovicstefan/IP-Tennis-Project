<?php
class Uloge{

    private $id;
    private $naziv_uloge;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
      $this->id = $id;
    }
    public function getNazivUloge()
    {
        return $this->naziv_uloge;
    }
    public function setNazivUloge($naziv_uloge)
    {
        $this->naziv_uloge = $naziv_uloge;
    }
}