<?php

class TipOpreme
{
    private  $id;
    private $tipovi_opreme;
    public function getId()
    {
        return $this->id;
    }

    public function getTipovi_opreme()
    {
        return $this->tipovi_opreme;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTipovi_opreme($tipovi_opreme)
    {
        $this->tipovi_opreme = $tipovi_opreme;
    }

    
}

