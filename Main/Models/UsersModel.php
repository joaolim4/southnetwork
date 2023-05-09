<?php 

namespace Main\Models;

class UsersModel
{

    public static function emailExists($email){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT email FROM users WHERE email = ?");
        $verify->execute(array($email));

        if($verify->rowCount() == 1){
            return true;
        }else {
            return false;
        }
    }

    public static function nameExists($name){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT name FROM users WHERE name = ?");
        $verify->execute(array($name));
        if($verify->rowCount() == 1){
            return true;
        }else {
            return false;
        }
    }

    public static function getUserInformations($user_id){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $verify->execute(array($user_id));
        $result = false;
        if($verify->rowCount() >= 1){
            $result = $verify->fetch();
        }
        return $result;
    }

    public static function getAuthor($user_id){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT name FROM users WHERE user_id = ?");
        $verify->execute(array($user_id));
        $result = false;
        if($verify->rowCount() >= 1){
            $data = $verify->fetch();
            $result = $data['name'];
        }
        return $result;
    }

    public static function updateProfileImage($file, $user_id, $name){
        $profile = \Main\Models\UsersModel::getProfile($name);
        if($profile['profile_image']){
            if(unlink(BASE_DIR_PAINEL.'/uploads/'.$profile['profile_image'])){
                $formatMedia = explode('.',$file['name']);
                $mediaName = uniqid().'.'.$formatMedia[count($formatMedia)-1];
                if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$mediaName)){
                    $new = \Main\MySql::connect()->prepare("UPDATE  profiles SET profile_image = ? WHERE user_id = ?");
                    $new->execute(array($mediaName,$user_id));
                }
            }
        }else {
            $formatMedia = explode('.',$file['name']);
            $mediaName = uniqid().'.'.$formatMedia[count($formatMedia)-1];
            if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$mediaName)){
                $new = \Main\MySql::connect()->prepare("UPDATE  profiles SET profile_image = ? WHERE user_id = ?");
                $new->execute(array($mediaName,$user_id));
            }
            
        }
        
    }

    public static function updateProfileBio($bio, $user_id){
        $new = \Main\MySql::connect()->prepare("UPDATE  profiles SET profile_bio = ? WHERE user_id = ?");
        $new->execute(array($bio,$user_id));
    }

    public static function createProfile($name){
        $get_id = \Main\MySql::connect()->prepare("SELECT user_id FROM users WHERE name = ?");
        $get_id->execute(array($name));
        $result = false;
        if($get_id->rowCount() >= 1){
            $data = $get_id->fetch();
            $result = $data['user_id'];
            if($result){
                $new = \Main\MySql::connect()->prepare("INSERT INTO profiles VALUES (?,NULL,NULL)");
                $new->execute(array($result));
            }
            return true;
        }else{
            return false;
        }
    }

    public static function getProfile($name){
        $get_id = \Main\MySql::connect()->prepare("SELECT user_id FROM users WHERE name = ?");
        $get_id->execute(array($name));
        $result = false;
        if($get_id->rowCount() >= 1){
            $data = $get_id->fetch();
            $id = $data['user_id'];
            if($id){
                $new = \Main\MySql::connect()->prepare("SELECT * FROM profiles WHERE user_id = ?");
                $new->execute(array($id));
                if($new->rowCount() >= 1){
                    $data = $new->fetch();
                    $result = $data;
                }
            }
        }
        return $result;
    }

    public static function getFollowing($follower_id){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT * FROM followers WHERE follower_id = ?");
        $verify->execute(array($follower_id));
        $result = [];
        if($verify->rowCount() >= 1){
            while ($data = $verify->fetch()) {
                $result[$data['followed_id']] = true;
            }
        }    
        return $result;
        
    }

    public static function getFollowers($followed_id){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT * FROM followers WHERE followed_id = ?");
        $verify->execute(array($followed_id));
        $result = [];
        if($verify->rowCount() >= 1){
            while ($data = $verify->fetch()) {
                $result[$data['follower_id']] = true;
            }
        }    
        return $result;
    }

    public static function toggleFollow($follower_id, $followed_id){
        $followers = \Main\Models\UsersModel::getFollowers($followed_id);
        if(isset($followers[$follower_id])){
            $pdo = \Main\MySql::connect();
            $verify = $pdo->prepare("DELETE FROM followers WHERE follower_id = ? AND followed_id = ?");
            $verify->execute(array((int)$follower_id, (int)$followed_id));
        }else {
            $pdo = \Main\MySql::connect();
            $verify = $pdo->prepare("INSERT INTO followers VALUES (NULL,?,?) ");
            $verify->execute(array((int)$follower_id, (int)$followed_id));
        }
    }
}

?>