<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OuderDTO extends Model
{
    protected $id;
    protected $naam;
    protected $voornaam;
    protected $origine_id;
    protected $origine_entry;
    protected $jongere_id;
    protected $jongere_entry;
    protected $relatie_id;
    protected $relatie_entry;

    public function getId()                             {return $this->id;}
    public function setId($id)                          {$this->id = $id;}

    public function getNaam()                           {return $this->naam;}
    public function setNaam($naam)                      {$this->naam = $naam;}

    public function getVoornaam()                       {return $this->voornaam;}
    public function setVoornaam($voornaam)              {$this->voornaam = $voornaam;}

    public function getOrigineId()                      {return $this->origine_id;}
    public function setOrigineId($origine_id)           {$this->origine_id = $origine_id;}

    public function getOrigineEntry()                   {return $this->origine_entry;}
    public function setOrigineEntry($origine_entry)     {$this->origine_entry = $origine_entry;}

    public function getJongereId()                      {return $this->jongere_id;}
    public function setJongereId($jongere_id)           {$this->jongere_id = $jongere_id;}

    public function getJongereEntry()                   {return $this->jongere_entry;}
    public function setJongereEntry($jongere_entry)     {$this->jongere_entry = $jongere_entry;}

    public function getRelatieId()                      {return $this->jongere_id;}
    public function setRelatieId($relatie_id)           {$this->relatie_id = $relatie_id;}

    public function getRelatieEntry()                   {return $this->relatie_entry;}
    public function setRelatieEntry($relatie_entry)     {$this->relatie_entry = $relatie_entry;}

    public function getOrigine(){

    }

}
