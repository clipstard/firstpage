<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 7:29 PM
 */

class Car {
    public $id;
    public $mark;
    public $anProducere;
    public $volume;
    public $parcurs;
    public $tara;
    public $pret;

    /**
     * @return mixed
     */
    public function getAnProducere()
    {
        return $this->anProducere;
    }

    /**
     * @return mixed
     */
    public function getPret()
    {
        return $this->pret;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * @return mixed
     */
    public function getParcurs()
    {
        return $this->parcurs;
    }

    /**
     * @return mixed
     */
    public function getTara()
    {
        return $this->tara;
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param $anProducere
     * @return $this
     */
    public function setAnProducere($anProducere)
    {
        $this->anProducere = $anProducere;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $mark
     * @return $this
     */
    public function setMark($mark)
    {
        $this->mark = $mark;
        return $this;
    }

    /**
     * @param $pret
     * @return $this
     */
    public function setPret($pret)
    {
        $this->pret = $pret;
        return $this;
    }

    /**
     * @param $parcurs
     * @return $this
     */
    public function setParcurs($parcurs)
    {
        $this->parcurs = $parcurs;
        return $this;
    }

    /**
     * @param $tara
     * @return $this
     */
    public function setTara($tara)
    {
        $this->tara = $tara;
        return $this;
    }

    /**
     * @param $volume
     * @return $this
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
        return $this;
    }
}