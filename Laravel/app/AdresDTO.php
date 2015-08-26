<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdresDTO extends Model
{
    protected $id;
    protected $omschrijving;
    protected $officieel;
    protected $straat_entry;
    protected $straat_id;
    protected $jongere_id;
    protected $nummer;
    protected $bus;
    protected $gemeente_entry;
    protected $gemeente_id;

    public function getId()                             {return $this->id;}
    public function setId($id)                          {$this->id = $id;}
    public function getOmschrijving()                   {return $this->omschrijving;}
    public function setOmschrijving($omschrijving)      {$this->omschrijving = $omschrijving;}
    public function getOfficieel()                      {return $this->officieel;}
    public function setOfficieel($officieel)            {$this->officieel = $officieel;}
    public function getStraatEntry()                    {return $this->straat_entry;}
    public function setStraatEntry($straat_entry)       {$this->straat_entry = $straat_entry;}
    public function getStraatId()                       {return $this->straat_id;}
    public function setStraatId($straat_id)             {$this->straat_id = $straat_id;}
    public function getJongereId()                      {return $this->jongere_id;}
    public function setJongereId($jongere_id)           {$this->jongere_id = $jongere_id;}
    public function getNummer()                         {return $this->nummer;}
    public function setNummer($nummer)                  {$this->nummer = $nummer;}
    public function getBus()                            {return $this->bus;}
    public function setBus($bus)                        {$this->bus = $bus;}
    public function getGemeenteEntry()                  {return $this->gemeente_entry;}
    public function setGemeenteEntry($gemeente_entry)   {$this->gemeente_entry = $gemeente_entry; }
    public function getGemeenteId()                     {return $this->gemeente_id; }
    public function setGemeenteId($gemeente_id)         {$this->gemeente_id = $gemeente_id; }


}
