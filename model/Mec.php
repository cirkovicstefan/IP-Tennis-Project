<?php

class Mec
{
    private $id;
    private $tip_meca;
    public function getId()
    {
        return $this->id;
    }

    public function getTip_meca()
    {
        return $this->tip_meca;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTip_meca($tip_meca)
    {
        $this->tip_meca = $tip_meca;
    }

    
}

