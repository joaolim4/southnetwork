<?php 
namespace Main\Models;

class FeedModel
{
    public static function formatDate(){
        $date = getdate();
        if($date['year'] < 1000){
            $date['year'] = '0'.$date['year'];
        }if($date['yday'] < 100){
            $date['yday'] = '0'.$date['yday'];
        }
        if($date['hours'] < 10){
            $date['hours'] = '0'.$date['hours'];
        }
        if($date['minutes'] < 10){
            $date['minutes'] = '0'.$date['minutes'];
        }
        if($date['seconds'] < 10){
            $date['seconds'] = '0'.$date['seconds'];
        }
        $format = $date['year'].$date['yday'].$date['hours'].$date['minutes'].$date['seconds'];
        return  (int)$format;
    }

    public static function createUserFeed(){
        $date_format = \Main\Models\FeedModel::formatDate();
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT * FROM posts WHERE date > ? ORDER BY date DESC");
        $date = getdate();
        
        $verify->execute(array($date_format-5000000));
        
        $result = array();
        if($verify->rowCount() >= 1){
            while ($data = $verify->fetch()) {
                $data['post_likes'] = \Main\Models\FeedModel::getLikes($data['post_id']);
                $data['post_comments'] = \Main\Models\FeedModel::getComments($data['post_id']);
                array_push($result, $data);
            }
        }    
        return $result;
    }

    public static function newPost($description, $file, $user_id){
        $date_format =  \Main\Models\FeedModel::formatDate();
        $formatMedia = explode('.',$file['name']);
        $mediaName = uniqid().'.'.$formatMedia[count($formatMedia)-1];
        if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$mediaName)){
            if($user_id && $description && $mediaName){
                $new = \Main\MySql::connect()->prepare("INSERT INTO posts VALUES (null, ?,?,?,?) ");
                
                $new->execute(array($user_id,$description,$mediaName, $date_format));
            }
            
        }
    }

    public static function getPost($post_id){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT * FROM posts WHERE post_id = ?");
        $verify->execute(array($post_id));
        $result = false;
        if($verify->rowCount() == 1){
            $data = $verify->fetch();
            $data['post_likes'] = \Main\Models\FeedModel::getLikes($data['post_id']);
            $data['post_comments'] = \Main\Models\FeedModel::getComments($data['post_id']);
            $result = $data;
        }    
        return $result;
    }

    public static function getUserPosts($user_id){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT * FROM posts WHERE author_id = ? ORDER BY date DESC");
        $date = getdate();
        $verify->execute(array($user_id));
        $result = array();
        if($verify->rowCount() >= 1){
            while ($data = $verify->fetch()) {
                array_push($result, $data);
            }
        }    
        return $result;
    }



    public static function getComments($post_id){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT * FROM post_comments WHERE post_id = ?");
        $verify->execute(array($post_id));
        $result = [];
        if($verify->rowCount() >= 1){
            while ($data = $verify->fetch()) {
                array_push($result, $data);
            }
        }    
        return $result;
    }

    public static function createComment($post_id, $name, $comment){
        if($post_id && $name && $comment){
            $pdo = \Main\MySql::connect();
            $verify = $pdo->prepare("INSERT INTO post_comments VALUES (null, ?,?,?,NULL) ");
            $verify->execute(array($post_id, $name, $comment));
            return true;
        }
    }

    public static function getLikes($post_id){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("SELECT * FROM post_likes WHERE post_id = ?");
        $verify->execute(array($post_id));
        $result = [];
        if($verify->rowCount() >= 1){
            while ($data = $verify->fetch()) {
                $result[$data['user_id']] = true;
            }
        }    
        return $result;
    }

    public static function togleLike($user_id, $post_id){
        $getLikes = \Main\Models\FeedModel::getLikes($post_id);
        if(isset($getLikes[$user_id])){
            $pdo = \Main\MySql::connect();
            $verify = $pdo->prepare("DELETE FROM post_likes WHERE user_id = ?");
            $verify->execute(array((int)$user_id));
            return \Main\Models\FeedModel::getLikes($post_id);
        }else {
            $pdo = \Main\MySql::connect();
            $verify = $pdo->prepare("INSERT INTO post_likes VALUES (NULL,?,?) ");
            $verify->execute(array((int)$user_id, (int)$post_id));
            return \Main\Models\FeedModel::getLikes($post_id);
        }
    }

    public static function deletePost($post_id, $author_id){
        $post_infos = \Main\Models\FeedModel::getPost($post_id);
        if((int)$post_infos['author_id'] == (int)$author_id){
            if(unlink(BASE_DIR_PAINEL.'/uploads/'.$post_infos['post_image'])){
                $pdo = \Main\MySql::connect();
                $verify = $pdo->prepare("DELETE FROM posts WHERE  post_id = ? AND author_id = ?; DELETE FROM post_comments WHERE  post_id = ?; DELETE FROM post_likes WHERE  post_id = ?");
                $verify->execute(array($post_id, $author_id, $post_id,$post_id));
            }
            
        }
    }

    public static function updatePostImge($post_id, $author_id, $file){
        $post_infos = \Main\Models\FeedModel::getPost($post_id);
        if((int)$post_infos['author_id'] == (int)$author_id){
            if(unlink(BASE_DIR_PAINEL.'/uploads/'.$post_infos['post_image'])){
                $formatMedia = explode('.',$file['name']);
                $mediaName = uniqid().'.'.$formatMedia[count($formatMedia)-1];
                if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$mediaName)){
                    $pdo = \Main\MySql::connect();
                    $verify = $pdo->prepare("UPDATE  posts SET post_image = ? WHERE post_id = ? AND author_id = ?");
                    $verify->execute(array($mediaName,$post_id, $author_id)); 
                }
            }
        }
    }

    public static function updatePostDesc($post_description, $post_id, $author_id ){
        $pdo = \Main\MySql::connect();
        $verify = $pdo->prepare("UPDATE  posts SET post_description = ? WHERE post_id = ? AND author_id = ?");
        $verify->execute(array($post_description, $post_id, $author_id)); 
    }
}
?>