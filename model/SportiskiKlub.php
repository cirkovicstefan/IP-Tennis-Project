<?php
class SportiskiKlub{
  private $id;
  private $naziv;
  private $adresa;

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
  public function getAdresa()
  {
        return $this->adresa;
  }
  public function setAdresa($adresa)
  {
    $this->adresa=$adresa;
  }
  
}
