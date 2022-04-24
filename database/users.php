<?php
    session_start();
    require_once('connection.php');
    function userExists($username,$password){
        $db=getDatabaseConnection();
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

    function findUser($username){
        $db=getDatabaseConnection();
        $stmt = $db->prepare('SELECT count(*) as nrUsers
                            FROM User
                            WHERE username=:username');
        $stmt->bindParam(':username',$username);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['nrUsers'];
        return $count==1;
    }

    function registerUser($username,$password,$address,$phoneNumber){
        $db=getDatabaseConnection();
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
?>