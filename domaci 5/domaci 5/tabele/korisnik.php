<?php 
    require_once __DIR__ . "/../config.php";
    require_once __DIR__ . "/../includes/Database.php";

    class Korisnik{
        public $id;
        public $password;
        public $email;
        public $ime_prezime;
        public $telefon;
        public $slika;

        public static function registruj($password, $email, $ime_prezime, $telefon, $slika){
            $db = Database::getInstance();
            $password = hash("sha512", $password);
            $db->insert("Korisnik", "INSERT INTO `korisnici` (`id`, `password`, `email`, `ime_prezime`, `telefon`, `slika`) VALUES (NULL, :password, :email, :ime_prezime, :telefon, :slika);", [
                ":password" => $password,
                ":email" => $email,
                ":ime_prezime" => $ime_prezime,
                ":telefon" => $telefon,
                ":slika" => $slika
            ]);
        }
        public static function izlistaj(){
            $db = Database::getInstance();
            $korisnici = $db->select("Korisnik", "SELECT * FROM `korisnici`");
            return $korisnici;
    }

        public static function prijavi($email, $password){
            $db = Database::getInstance();
            $password = hash("sha512", $password);
            $korisnici = $db->select("Korisnik", "SELECT * FROM `korisnici` WHERE `password` LIKE :password AND `email` LIKE :email", [
                ":email" => $email,
                ":password" => $password
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
};
?>