<?php

Class UserEntity
{
    protected $id;
    protected $pseudo;
    protected $password;
    protected $role;

    public function getId()
        {
            return $this->id;
        }
         
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }    

    public function getPseudo()
    {
        return $this->pseudo;
    }
     
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
     
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }
     
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
}