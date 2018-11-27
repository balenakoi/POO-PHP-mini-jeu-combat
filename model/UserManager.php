<?php

class UserManager
{
    /**
     * property db
     */
    private $_db;

    /**
     * conection to data base
     */
    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->_db;
    }

    /**
     * Set the value of _db
     *
     * @return $this
     */
    public function setDb($db)
    {
        $this->_db = $db;

        return $this;
    }

    /**
     * function insert data
     * @param UserManager 
     */
    public function addUser()
    {
        $names = htmlspecialchars($_POST['names']);
        $q = $this->_db->prepare('INSERT INTO users(names, damages) VALUES(:names, :damages)');
        $q->bindValue(':names', $_POST['names'], PDO::PARAM_STR);
        $q->bindValue(':damages', 0, PDO::PARAM_INT);
        $q->execute();

    }
    /**
     * select data
     * @param pUserManagaer
     */
    public function getUsers()
    {
        $arrayOfUsers = [];
        $req = $this->_db->query('SELECT * FROM users ORDER BY id DESC LIMIT 1, 99999999');
        $users = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            $arrayOfUsers[] = new User($user);
        }
        return $arrayOfUsers;
    }

    /**
     * getLastUser function
     *
     * @return $lastUser
     */
    public function getLastUser()
    {
        $lastUser = [];
        $last_user = $this->_db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
        $users = $last_user->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            $lastUser[] = new User($user);

        }
        return $lastUser;
    }


    /**
     * getUserId function
     *
     * @param [type] $id
     * @return userId
     */
    public function getUserId($id)
    {
        $userId;
        $userById = $this->_db->prepare("SELECT * FROM users WHERE id = :id");
        $userById->execute(array(
            'id' => $id
        ));
        $users = $userById->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            $userId = new User($user);

        }
        return $userId;
    }
    /**
     * update data
     * @param  
     */
    public function updateUser(User $perso)
    {
        $checked = $this->_db->prepare('UPDATE users SET damages = :damages WHERE id = :id ');
        $checked->execute(array(
            'damages' => $perso->getDamages(),
            'id' => $perso->getId()
        ));

    }
    /**
     * delete data
     * @param UserManager 
     */
    public function deleteUser(User $perso)
    {
        $this->_db->exec('DELETE FROM users WHERE id =' . $perso->getId());
    }

    /**
     * checking if the name is already exist
     *
     * @return $rep
     */
    public function existUser()
    {
        $q = $this->_db->prepare('SELECT COUNT(id) as count  FROM users WHERE names = :names');
        $q->bindValue(':names', $_POST['names'], PDO::PARAM_STR);
        $q->execute();
        $rep = $q->fetch();
        return $rep['count'] ?? null;

    }
}


