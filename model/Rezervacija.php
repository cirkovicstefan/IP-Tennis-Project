<?php

class Rezervacija
{
    private $id;
    private $id_igraca1;
    private $id_igraca2;
    private $id_igraca3;
    private $id_igraca4;
    private $id_terena;
    private $id_meca;
    private $datum;
    private $vreme;
    public function getId()
    {
        return $this->id;
    }

    public function getId_igraca1()
    {
        return $this->id_igraca1;
    }

    public function getId_igraca2()
    {
        return $this->id_igraca2;
    }

    public function getId_igraca3()
    {
        return $this->id_igraca3;
    }

    public function getId_igraca4()
    {
        return $this->id_igraca4;
    }

    public function getId_terena()
    {
        return $this->id_terena;
    }

    public function getId_meca()
    {
        return $this->id_meca;
    }

    public function getDatum()
    {
        return $this->datum;
    }

    public function getVreme()
    {
        return $this->vreme;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setId_igraca1($id_igraca1)
    {
        $this->id_igraca1 = $id_igraca1;
    }

    public function setId_igraca2($id_igraca2)
    {
        $this->id_igraca2 = $id_igraca2;
    }

    public function setId_igraca3($id_igraca3)
    {
        $this->id_igraca3 = $id_igraca3;
    }

    public function setId_igraca4($id_igraca4)
    {
        $this->id_igraca4 = $id_igraca4;
    }

    public function setId_terena($id_terena)
    {
        $this->id_terena = $id_terena;
    }

    public function setId_meca($id_meca)
    {
        $this->id_meca = $id_meca;
    }

    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

    public function setVreme($vreme)
    {
        $this->vreme = $vreme;
    }

    
}

