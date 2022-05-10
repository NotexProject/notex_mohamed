<?php

namespace App\Entity;

class PropertySearch
{

    private $nickname;

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     * @return PropertySearch
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }



}