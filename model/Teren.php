<?php
class Teren
{
    private $id;
    private $naziv;
    private $lokacija;
    private $vrsta_podloge;
    private $kapacitet;
    private $zauzet;
    private $id_kluba;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNaziv()
    {
        return $this->naziv;
    }
    public function setNaziv($naziv)
    {
        $this->naziv = $naziv;
    }
    public function getLokacija()
    {
        return $this->lokacija;
    }
    public function setLokacija($lokacija)
    {
        $this->lokacija = $lokacija;
    }
    public function getVrstaPodloge()
    {
        return $this->vrsta_podloge;
    }
    public function setVrstaPodloge($vrsta_podloge)
    {
        $this->vrsta_podloge = $vrsta_podloge;
    }
    public function getKapacitet()
    {
        return $this->kapacitet;
    }
    public function setKapacitet($kapacitet)
    {
        $this->kapacitet = $kapacitet;
    }
    public function getZauzet()
    {
        return $this->zauzet;
    }
    public function setZauzet($zauzet)
    {
        $this->zauzet = $zauzet;
    }
    public function getIdKluba()
    {
        return $this->id_kluba;
    }
    public function setIdKluba($id_kluba)
    {
        $this->id_kluba = $id_kluba;
    }
}
