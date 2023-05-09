<?php 
    session_start();
    // include('connect.php');
    require('../vendor/autoload.php');
    
    function getProfile($name){
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

    function returnApi(){
        if(isset($_POST['search'])){
            $format = $_POST['search'];
            $grid = '';
            $mysqli = \Main\MySql::connect();
            $verify =$mysqli->prepare("SELECT name FROM users WHERE name LIKE ? ");
            $verify->execute(array("%$format%"));
            $result = array();
            if($verify->rowCount() >= 1){
                while ($data = $verify->fetch()) {
                    array_push($result, $data['name']);
                }
                foreach($result as $key => $element){
                    $profile = getProfile($element);
                    if($profile){
                        if($profile['profile_image']){
                            $grid = $grid."<div class='result-profile'>
                            <div class='profilephoto'><img draggable=false src='http://localhost/Saves/uploads/".$profile['profile_image']."'></div>
                            <h3>".$element."</h3>
                            <a href='http://localhost/profile/".$element."'>Abrir perfil</a>
                        </div>";
                        }else {
                            $grid = $grid."<div class='result-profile'>
                            <div class='profilephoto'><img draggable=false src='http://localhost/Saves/uploads/profile_default.jpg'></div>
                            <h3>".$element."</h3>
                            <a href='http://localhost/profile/".$element."'>Abrir perfil</a>
                        </div>";}
                        
                    }
                }
            }
            echo $grid;
       
        }
        else if(isset($_POST['comment']) && isset($_SESSION['login'])){
            if(isset($_POST['post_id'])) {
                $post_id = (int)$_POST['post_id'];
                if(\Main\Models\FeedModel::createComment($post_id, $_SESSION['name'], $_POST['comment'])){
                    echo true;
                };
            }
            
        }else if(isset($_POST['toggle_like']) && isset($_SESSION['user_id'])){
           
            if(isset($_POST['post_id'])) {
                $post_id = $_POST['post_id'];
                if($post_id > 100){
                    $likes  = \Main\Models\FeedModel::togleLike($_SESSION['user_id'], $post_id);
                    if(isset($likes[$_SESSION['user_id']])){
                        echo  '<i title='.$post_id.' onclick="togglePostLike(this.title)" class="fa-solid fa-heart mylikes"></i>
                            <h3>'.(int)sizeof($likes).'</h3>';
                    }else {
                        echo '<i title='.$post_id .' onclick="togglePostLike(this.title)" class="fa-regular fa-heart"></i>
                            <h3>'.(int)sizeof($likes).'</h3>';
                    }   
                }
                
        
            }
            
        }
    }
    returnApi()
    
?>
</html>
