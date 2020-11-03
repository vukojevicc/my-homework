<?php 
    require_once __DIR__ . "/../config.php";
    require_once __DIR__ . "/../includes/Database.php";

    class Korisnik{
        public $id;
        public $korisnicko_ime;
        public $email;
        public $password;
        public $ime_prezime;
        public $telefon;
        public $slika;
        public $uloga_id;
        public $status_odobrenja;
        public $pokusaji_prijavljivanja;

        public function pokusajiPrijavljivanja($korisnicko_ime){
            $db = Database::getInstance();
            $db->update("Korisnik", "UPDATE `korisnici` SET `pokusaji_prijavljivanja` = :pokusaji_prijavljivanja WHERE `korisnici`.`korisnicko_ime` = :korisnicko_ime;", [
                ":korisnicko_ime" => $korisnicko_ime,
                ":pokusaji_prijavljivanja" => $this->pokusaji_prijavljivanja += 1
            ]);
        }

        public static function registruj($korisnicko_ime, $email, $password, $telefon, $ime_prezime, $slika){
            $db = Database::getInstance();
            $password = hash("sha512", $password);
            $db->insert("Korisnik", "INSERT INTO `korisnici` (`id`,`korisnicko_ime`, `email`, `password`, `telefon`, `ime_prezime`, `slika`) VALUES (NULL, :korisnicko_ime, :email, :password, :telefon, :ime_prezime, :slika);", [
                ":korisnicko_ime" => $korisnicko_ime,
                ":email" => $email,
                ":password" => $password,
                ":telefon" => $telefon,
                ":ime_prezime" => $ime_prezime,
                ":slika" => $slika
            ]);
        }
        public static function izlistaj(){
            $db = Database::getInstance();
            $korisnici = $db->select("Korisnik", "SELECT * FROM `korisnici`");
            return $korisnici;
    }

        public static function prijavi($korisnicko_ime, $password){
            $db = Database::getInstance();
            $password = hash("sha512", $password);
            $korisnici = $db->select("Korisnik", "SELECT * FROM `korisnici` WHERE `password` LIKE :password AND `korisnicko_ime` LIKE :korisnicko_ime", [
                ":korisnicko_ime" => $korisnicko_ime,
                ":password" => $password
            ]);
            foreach($korisnici as $korisnik){
                return $korisnik;
            }
            return null;
        }
        public static function vratiKorisnikaZaId($id){
            $db = Database::getInstance();
            $korisnici = $db->select("Korisnik", "SELECT * FROM `korisnici` WHERE `id` = :id", [
                ":id" => $id
            ]);
            foreach($korisnici as $korisnik){
                return $korisnik;
            }
            return null;
        }
        public static function vratiKorisnikaZaUn($korisnicko_ime){
            $db = Database::getInstance();
            $korisnici = $db->select("Korisnik", "SELECT * FROM `korisnici` WHERE `korisnicko_ime` = :korisnicko_ime", [
                ":korisnicko_ime" => $korisnicko_ime
            ]);
            foreach($korisnici as $korisnik){
                return $korisnik;
            }
            return null;
        }
        public static function izmeniLozinku($korisnik_id, $nova_lozinka){
            $db = Database::getInstance();
            $sifra = hash("sha512", $nova_lozinka);
            $db->update("Korisnik", "UPDATE `korisnici` SET `password` = :password WHERE `korisnici`.`id` = :id;", [
                ":password" => $sifra,
                ":id" => $korisnik_id
            ]);
        }
        public static function resetujBrojac($id){
            $db = Database::getInstance();
            $db->update("Korisnik", "UPDATE `korisnici` SET `pokusaji_prijavljivanja` = '0' WHERE `korisnici`.`id` = :id;", [
                "id" => $id
            ]);
        }
        public static function obrisiKorisnika($id){
            $db = Database::getInstance();
            $db->delete("DELETE FROM `korisnici` WHERE `korisnici`.`id` = :id;", [
                ":id" => $id
            ]);
        }
        public static function odobriKorisnika($id, $status_odobrenja){
            $db = Database::getInstance();
            $db->update("Korisnik", "UPDATE `korisnici` SET `status_odobrenja` = :status_odobrenja WHERE `korisnici`.`id` = :id;", [
                ":id" => $id,
                ":status_odobrenja" => $status_odobrenja
            ]);
        }
};
?>