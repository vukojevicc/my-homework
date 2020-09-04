<?php 
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../includes/Database.php";
require_once __DIR__ . "/korisnik.php";

class Poruka{
    public $posiljalac_id;
    public $primalac_id;
    public $poruka_id;
    public $poruka;
    public $naslov_poruke;
    public $urgencija;
    public $vreme;
    public $status_pregleda;

    public function korisnikPosiljalac(){
        return Korisnik::vratiKorisnikaZaId($this->posiljalac_id);
    }
    public function vreme(){
        return date("d.m.Y. H:i", strtotime($this->vreme));
    }

    public static function unesiPoruku($posiljalac_id, $primalac_id, $poruka, $naslov_poruke, $urgencija){
        $db = Database::getInstance();
        $db->insert("Poruka", "INSERT INTO `poruke` (`posiljalac_id`, `primalac_id`, `poruka`, `naslov_poruke`, `urgencija`, `vreme`) VALUES (:posiljalac_id, :primalac_id, :poruka, :naslov_poruke, :urgencija, CURRENT_TIMESTAMP);", [
            ":posiljalac_id" => $posiljalac_id,
            ":primalac_id" => $primalac_id,
            ":poruka" => $poruka,
            ":naslov_poruke" => $naslov_poruke,
            ":urgencija" => $urgencija,
        ]);
    }
    public static function procitajPoruku($pregled, $id_poruke){
        $db = Database::getInstance();
        $db->update("Poruka", "UPDATE `poruke` SET `status_pregleda` = :status_pregleda WHERE `poruke`.`poruka_id` = :poruka_id;", [
            ":status_pregleda" => $pregled,
            ":poruka_id" => $id_poruke
        ]);
    }
    public static function izlistajPoruke(){
        $db = Database::getInstance();
        $poruke = $db->select("Poruka", "SELECT * FROM `poruke`");
        return $poruke;
    }
    public static function obrisiPoruku($id){
        $db = Database::getInstance();
        $db->delete("DELETE FROM `poruke` WHERE `poruke`.`poruka_id` = :poruka_id", [
            ":poruka_id" => $id
        ]);
    }
}