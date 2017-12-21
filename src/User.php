<?php

namespace App;

/**
 * Representa o usuário contratante da assinatura
 * Class User
 * @package App\Models
 */
class User
{
    /**
     * ID único
     * @var
     */
    private $id;

    /**
     * E-mail do contratante
     * @var
     */
    private $email;

    /**
     * Nome completo do usuário
     * @var
     */
    private $name;

    /**
     * User constructor.
     * @param $email
     * @param $name
     */
    public function __construct($email, $name)
    {
        $this->setId();
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    private function setId()
    {
        $this->id = sha1(uniqid());
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}