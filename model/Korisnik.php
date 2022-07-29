<?php
class Korisnik{
    private $id;
    private $ime;
    private $prezime;
    private $pol;
    private $visina;
    private $godine;
    private $pobede;
    private $porazi;
    private $naziv_kluba;
    private $email;
    private $lozinka;
    private $profilna_slika;
    private $id_opreme;
    private $id_uloge;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getIme()
    {
        return $this->ime;
    }
    public function setIme($ime)
    {
        $this->ime = $ime;
    }
    public function getPrezime()
    {
        return $this->prezime;
    }
    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;
    }
    public function getPol()
    {
        return $this->pol;
    }
    public function setPol($pol)
    {
        $this->pol = $pol;
    }
    public function getVisina()
    {
        return $this->visina;
    }
    public function setVisina($visina)
    {
        $this->visina = $visina;
    }
    public function getGodine()
    {
        return $this->godine;
    }
    public function setGodine($godine)
    {
        $this->godine = $godine;
    }
    public function getPobede()
    {
        return $this->pobede;
    }
    public function setPobede($pobede)
    {
        $this->pobede = $pobede;
    }
    public function getPorazi()
    {
        return $this->porazi;
    }
    public function setPorazi($porazi)
    {
        $this->porazi = $porazi;
    }
    public function getNazivKluba()
    {
        return $this->naziv_kluba;
    }
    public function setNazivKluba($naziv_kluba)
    {
        $this->naziv_kluba = $naziv_kluba;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getLozinka()
    {
        return $this->lozinka;
    }
    public function setLozinka($lozinka)
    {
        $this->lozinka = $lozinka;
    }
    public function getProfilnaSlika()
    {
        return $this->profilna_slika;
    }
    public function setProfilnaSlika($profilna_slika)
    {
        $this->profilna_slika = $profilna_slika;
    }
    public function getIdOpreme()
    {
        return $this->id_opreme;
    }
    public function setIdOpreme($id_opreme)
    {
        $this->id_opreme = $id_opreme;
    }
    public function getIdUloge()
    {
        return $this->id_uloge;
    }
    public function setIdUloge($id_uloge)
    {
        $this->id_uloge = $id_uloge;
    }


}