<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../includes/Database.php";
require_once __DIR__ . "/korisnik.php";

class Aktivnost{
    public $aktivnost_id;
    public $aktivnost_dodelio;
    public $aktivnost_primio;
    public $opis_aktivnosti;
    public $naslov_aktivnosti;
    public $rok_izvrsenja;
    public $urgencija;
    public $vreme_dodeljivanja;
    public $status_aktivnosti;
    public $dani_do_isteka;
    public $vreme_do_isteka;

    public function vreme(){
        return date("d.m.Y. H:i", strtotime($this->vreme_dodeljivanja));
    }
    
    public function korisnikDodelilac(){
        return Korisnik::vratiKorisnikaZaId($this->aktivnost_dodelio);
    }
    public function korisnikPrimalac(){
        return Korisnik::vratiKorisnikaZaId($this->aktivnost_primio);
    }
    public static function izlistajAktivnosti(){
        $db = Database::getInstance();
        $aktivnosti = $db->select("Aktivnost", "SELECT * FROM `aktivnosti`");
        return $aktivnosti;
    }
    public static function zavrsiAktivnost($status_aktivnosti, $aktivnost_id){
        $db = Database::getInstance();
        $db->update("Aktivnost", "UPDATE `aktivnosti` SET `status_aktivnosti` = :status_aktivnosti WHERE `aktivnosti`.`aktivnost_id` = :aktivnost_id;", [
            ":status_aktivnosti" => $status_aktivnosti,
            ":aktivnost_id" => $aktivnost_id
        ]);
    }
    public static function unesiAktivnost($aktivnost_dodelio, $aktivnost_primio, $opis_aktivnosti, $naslov_aktivnosti, $rok_izvrsenja, $dani_do_isteka, $urgencija, $vreme_dodeljivanja, $vreme_do_isteka){
        $db = Database::getInstance();
        $db->insert("Aktivnost", "INSERT INTO `aktivnosti` (`aktivnost_dodelio`, `aktivnost_primio`, `opis_aktivnosti`, `naslov_aktivnosti`, `rok_izvrsenja`, `dani_do_isteka`, `urgencija`, `vreme_dodeljivanja`, `vreme_do_isteka`) VALUES (:aktivnost_dodelio, :aktivnost_primio, :opis_aktivnosti, :naslov_aktivnosti, :rok_izvrsenja, :dani_do_isteka, :urgencija, :vreme_dodeljivanja, :vreme_do_isteka);", [
            ":aktivnost_dodelio" => $aktivnost_dodelio,
            ":aktivnost_primio" => $aktivnost_primio,
            ":opis_aktivnosti" => $opis_aktivnosti,
            ":naslov_aktivnosti" => $naslov_aktivnosti,
            ":rok_izvrsenja" => $rok_izvrsenja,
            ":dani_do_isteka" => $dani_do_isteka,
            ":urgencija" => $urgencija,
            ":vreme_dodeljivanja" => $vreme_dodeljivanja,
            ":vreme_do_isteka" => $vreme_do_isteka
        ]);
    }
    public static function obrisiAktivnost($id){
        $db = Database::getInstance();
        $db->delete("DELETE FROM `aktivnosti` WHERE `aktivnosti`.`aktivnost_id` = :id;", [
            ":id" => $id
        ]);
    }
}