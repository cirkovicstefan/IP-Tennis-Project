<?php

class PregledRezultata
{
    private $id;
    private $rezultat;
    private $potvrda_rezultata;
    private $id_rezervacije;
    private $status_meca;
    
    public function getId()
    {
        return $this->id;
    }

    public function getRezultat()
    {
        return $this->rezultat;
    }

    public function getPotvrda_rezultata()
    {
        return $this->potvrda_rezultata;
    }

    public function getId_rezervacije()
    {
        return $this->id_rezervacije;
    }

    public function getStatus_meca()
    {
        return $this->status_meca;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRezultat($rezultat)
    {
        $this->rezultat = $rezultat;
    }

    public function setPotvrda_rezultata($potvrda_rezultata)
    {
        $this->potvrda_rezultata = $potvrda_rezultata;
    }

    public function setId_rezervacije($id_rezervacije)
    {
        $this->id_rezervacije = $id_rezervacije;
    }

    public function setStatus_meca($status_meca)
    {
        $this->status_meca = $status_meca;
    }

    
    
}

