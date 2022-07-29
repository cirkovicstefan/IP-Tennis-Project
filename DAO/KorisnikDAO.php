<?php
require_once '../config/DB.php';
require_once '../model/Korisnik.php';
require_once 'RezervacijeDAO.php';
class KorisnikDAO
{
    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }

    public function getAllKorisnici()
    {
        $statement = $this->db->prepare('SELECT * FROM korisnici');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function InsertKorisnik($korisnik)
    {
        $statement = $this->db->prepare("INSERT INTO korisnici(ime, prezime, pol, visina, godine, pobeda, porazi, naziv_kluba, email, lozinka, profilna_slika, id_opreme, id_uloge) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ");
        $statement->bindValue(1, $korisnik->getIme());
        $statement->bindValue(2, $korisnik->getPrezime());
        $statement->bindValue(3, $korisnik->getPol());
        $statement->bindValue(4, $korisnik->getVisina());
        $statement->bindValue(5, $korisnik->getGodine());
        $statement->bindValue(6, $korisnik->getPobede());
        $statement->bindValue(7, $korisnik->getPorazi());
        $statement->bindValue(8, $korisnik->getNazivKluba());
        $statement->bindValue(9, $korisnik->getEmail());
        $statement->bindValue(10, $korisnik->getLozinka());
        $statement->bindValue(11, $korisnik->getProfilnaSlika());
        $statement->bindValue(12, $korisnik->getIdOpreme());
        $statement->bindValue(13, $korisnik->getIdUloge());
        return $statement->execute() == true ? true : false;
    }

    public function UpdateKorisnik($id, $korisnik)
    {
        $statement = $this->db->prepare("UPDATE  korisnici SET ime=?,prezime=?,pol=?,visina=?,godine=?,pobeda=?,porazi=?,naziv_kluba=?,email=?,lozinka=?,profilna_slika=?,id_opreme=?,id_uloge=? WHERE id=?");

        $statement->bindValue(1, $korisnik->getIme());
        $statement->bindValue(2, $korisnik->getPrezime());
        $statement->bindValue(3, $korisnik->getPol());
        $statement->bindValue(4, $korisnik->getVisina());
        $statement->bindValue(5, $korisnik->getGodine());
        $statement->bindValue(6, $korisnik->getPobede());
        $statement->bindValue(7, $korisnik->getPorazi());
        $statement->bindValue(8, $korisnik->getNazivKluba());
        $statement->bindValue(9, $korisnik->getEmail());
        $statement->bindValue(10, $korisnik->getLozinka());
        $statement->bindValue(11, $korisnik->getProfilnaSlika());
        $statement->bindValue(12, $korisnik->getIdOpreme());
        $statement->bindValue(13, $korisnik->getIdUloge());
        $statement->bindValue(14, $id);
        return  $statement->execute();
    }
    public function UpdateKorisnikProfil($id, $korisnik)
    {
        $statement = $this->db->prepare("UPDATE  korisnici SET ime=?,prezime=?,email=?,profilna_slika=? WHERE id=?");

        $statement->bindValue(1, $korisnik->getIme());
        $statement->bindValue(2, $korisnik->getPrezime());
        $statement->bindValue(3, $korisnik->getEmail());
        $statement->bindValue(4, $korisnik->getProfilnaSlika(),PDO::PARAM_LOB);
        $statement->bindValue(5, $id);
        return  $statement->execute();
    }

    public function DeleteKorisnik($id)
    {
        $rezDAO = new RezervacijeDAO();
        $ind = false;
        foreach ($rezDAO->getAllRezervacije() as $item) {
            if ($item['id_igraca1'] == $id || $item['id_igraca2'] == $id || $item['id_igraca3'] == $id || $item['id_igraca4'] == $id) {
                $ind = true;
                break;
            }
        }
        if ($ind == false) {
            $statement = $this->db->prepare("DELETE FROM  korisnici  WHERE id=?");
            $statement->bindValue(1, $id);
            return $statement->execute() == true ? 'Uspešno ste obrisali podatak' : 'Greška';
        } else {
            return 'Podatak je povezan sa drugim tabelama';
        }
    }

    public function getAllIgraci()
    {
        $sql = "SELECT k.* FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id WHERE u.naziv_uloge='igrac'";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    
    public function getAllIgraciSort()
    {
        $sql = "SELECT k.* FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id WHERE u.naziv_uloge='igrac' ORDER BY pobeda asc";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getAllIgraciSortWL()
    {
        $sql = "SELECT k.* FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id WHERE u.naziv_uloge='igrac' ORDER BY pobeda - porazi desc";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getAllIgraciById($id)
    {
        $sql = "SELECT k.* FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id WHERE u.naziv_uloge='igrac' and k.id=?";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
        $res = $statement->fetch();
        if ($res != false) return $res;
        return null;
    }
    public function getAllKluboviKorisnici()
    {
        $sql = "SELECT k.* FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id WHERE u.naziv_uloge='klub';";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }
    public function getKluboviKorisniciById($id)
    {
        $sql = "SELECT k.* FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id WHERE u.naziv_uloge='klub' and k.id=?;";
       
        $statement = $this->db->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
        $res = $statement->fetch();
        return $res;
    }
    public function getAllAdmin()
    {
        $sql = "SELECT k.* FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id WHERE u.naziv_uloge='admin';";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }
    public function LoginKlub($email, $lozinka)
    {
        $korisnik = new Korisnik();
        foreach ($this->getAllKluboviKorisnici() as $item) {
            if ($item['email'] == $email && $item['lozinka'] == md5($lozinka)) {
                $korisnik = $item;
                break;
            }
        }
        return $korisnik;
    }

    public function LoginAdmin($email, $lozinka)
    {
        $korisnik = new Korisnik();
        foreach ($this->getAllAdmin() as $item) {
            if ($item['email'] == $email && $item['lozinka'] == md5($lozinka)) {
                $korisnik = $item;
                break;
            }
        }
        return $korisnik;
    }

    public function SetPobede($id_igraca)
    {
        $statement = $this->db->prepare('UPDATE  korisnici SET pobeda=? WHERE id=?');
        $igrac = $this->getAllIgraciById($id_igraca);
        $pob = $igrac['pobeda'] + 1;
        $statement->bindValue(1, $pob);
        $statement->bindValue(2, $id_igraca);
        $statement->execute();
    }
    public function SetPorazi($id_igraca)
    {
        $statement = $this->db->prepare('UPDATE  korisnici SET porazi=? WHERE id=?');
        $igrac = $this->getAllIgraciById($id_igraca);
        $pob = $igrac['porazi'] + 1;
        $statement->bindValue(1, $pob);
        $statement->bindValue(2, $id_igraca);
        $statement->execute();
    }
    public function getAllKluboviKorisnici1()
    {
        $sql = "SELECT k.* FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id WHERE u.naziv_uloge='igrac';";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }
    public function LoginIgrac($email, $lozinka)
    {
        $korisnik = new Korisnik();
        foreach ($this->getAllKluboviKorisnici1() as $item) {
            if ($item['email'] == $email && $item['lozinka'] ==  md5($lozinka)) {   
                $korisnik = $item;
                break;
            }
        }
        return $korisnik;
    }
}
