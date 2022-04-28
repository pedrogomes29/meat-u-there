<?php
    session_start();
    require_once('connection.php');
    function userExists($db,$username,$password){
        $stmt = $db->prepare('SELECT count(*) as nrUsers
                            FROM User
                            WHERE username=:username AND password=:password');
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',sha1($password));
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['nrUsers'];
        return $count==1;
    }

    function findUser($db,$username){
        $stmt = $db->prepare('SELECT count(*) as nrUsers
                            FROM User
                            WHERE username=:username');
        $stmt->bindParam(':username',$username);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['nrUsers'];
        return $count==1;
    }

    function registerUser($db,$username,$password,$address,$phoneNumber){
        $db->beginTransaction();
        $stmt = $db->prepare('INSERT INTO User(username,password,address,phoneNumber)
                            values(:username,:password,:address,:phoneNumber)'); // store the username
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password',sha1($password));
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->execute();
        $db->commit();
    }

    function getUserInfo($db){
        $db->beginTransaction();
        $stmt = $db->prepare('SELECT *
                              FROM User
                              WHERE username=:username');
        $stmt->bindParam(':username',$_SESSION['username']);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt;
    }
    
    function editUser($db,$userId,$username,$address,$phoneNumber){
        $db->beginTransaction();
        $stmt = $db->prepare('UPDATE User
                            SET username=:username,
                                address=:address,
                                phoneNumber=:phoneNumber
                            WHERE
                                idUser=:id');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $db->commit();
    }
?>