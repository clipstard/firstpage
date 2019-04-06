<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 7:29 PM
 */

class Command {
    protected $id;
    protected $name;
    protected $email;
    protected $firm;
    protected $tara;

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
    public function getName()
    {
        return $this->name;
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
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirm()
    {
        return $this->firm;
    }

    /**
     * @return mixed
     */
    public function getTara()
    {
        return $this->tara;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param $firm
     * @return $this
     */
    public function setFirm($firm)
    {
        $this->firm = $firm;
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
}