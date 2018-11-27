<?php

class User
{

    /**
     * create propertys
     */
    protected $id,
        $names,
        $damages;




    /**
     * constructfunction
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->hydrate($array);

    }


    /**
     * hydrate function
     * @param array $donnees
     */
    public function hydrate(array $donnees)

    {
        //$key nawakayati $value awaytr bo nmuna $pseudo pey dalen $key balam coco $valeu a
        foreach ($donnees as $key => $value) {
                  // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);      
                  // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                    // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of pseudo
     */
    public function getNames()
    {
        return $this->names;
    }


    /**
     * get value of damages
     *
     */
    public function getDamages()
    {
        return $this->damages;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $id = (int)$id;
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of names
     *
     * @return  self
     */
    public function setNames(string $names)
    {
        $this->names = $names;

        return $this;
    }


    /**
     * set the value of damages 
     *
     * @param integer $damages
     * @return $this
     */
    public function setDamages($damages)
    {
        $this->damages = $damages;

        return $this;
    }

    /**
     * fight function
     */
    public function userFight()
    {
        $fight = $this->getDamages();
        $fight = $fight + 5;
        $this->setDamages($fight);
    }

}