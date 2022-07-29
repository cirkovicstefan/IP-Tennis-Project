<?php

class Oprema
{
    private $id;
    private $naziv;
    private $opis;
    private $id_tip_opreme;
    public function getId()
    {
        return $this->id;
    }

    public function getNaziv()
    {
        return $this->naziv;
    }

    public function getOpis()
    {
        return $this->opis;
    }

    public function getId_tip_opreme()
    {
        return $this->id_tip_opreme;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNaziv($naziv)
    {
        $this->naziv = $naziv;
    }

    public function setOpis($opis)
    {
        $this->opis = $opis;
    }

    public function setId_tip_opreme($id_tip_opreme)
    {
        $this->id_tip_opreme = $id_tip_opreme;
    }

    
}

