<?php
require '../model/Data.php';
require '../model/UserManager.php';
require '../entities/User.php';

$db = Database::DB();

$manager = new UserManager($db);


/**
 * checking if the name is already exist 
 */
if (isset($_GET['add'])) {
    if (isset($_POST['create'])) {
        if (!empty($_POST['names'])) {
            if ($manager->existUser() == 0) {
                $perso = new User([
                    'names' => $_POST['names'],
                    'damages' => 0
                ]);
                $manager->addUser();
                header('location: index.php?view=true');
            } else {
                echo 'ce nom est déja exist';
            }

        }
    }
}

/**
 * recover the user id 
 */
if (isset($_GET['id'])) {
    $lastIdUser = $manager->getUserId($_GET['id']);
    //starting fight
    $lastIdUser->userFight();
    if ($lastIdUser->getDamages() < 100) {
        $updateUser = $manager->updateUser($lastIdUser);
        header('location: index.php?view=true');
    }
    if ($lastIdUser->getDamages() >= 100) {
        $updateUser = $manager->deleteUser($lastIdUser);
        header('location: index.php?view=true');
    }

}
$users = $manager->getUsers();
$lastUser = $manager->getLastUser();

include "../views/indexVue.php";





?>
