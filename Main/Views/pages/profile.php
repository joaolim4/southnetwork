<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/c58d6bbdac.js" crossorigin="anonymous"></script>
        <title>Ben vindo <?php echo $_SESSION['name'] ?></title>
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/profile.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/sidebar.css">
    </head>
    <body>
        <?php  include('includes/sidebar.php'); ?>
        <div class="profile-main">
            
                
                <?php 
                    $url = explode('/',@$_GET['url']);
                    if(isset($url[1])){
                        $name = $url[1];
                    }else{
                        $name = $_SESSION['name'];
                    }
                    $profile = \Main\Models\UsersModel::getProfile($name);
                    $followers = \Main\Models\UsersModel::getFollowers($profile['user_id']);
                    $posts = \Main\Models\FeedModel::getUserPosts($profile['user_id']);
                    $posts_grid = "";

                    if($profile['profile_image']){
                        // ok!
                    }else {
                        $profile['profile_image'] = 'profile_default.jpg';
                    }

                    foreach($posts as $key => $element){
                        $posts_grid = $posts_grid.'<div class="post"><img src="'.INCLUDE_PATH.'Saves/uploads/'.$element['post_image'].'"><a href="'.INCLUDE_PATH.'post/'.$element['post_id'].'"></a></div>';
                    }
                    if ($profile){
                        echo '<div class="profile-infos"><div class="profile-photo"><img draggable="false" src="'.INCLUDE_PATH.'Saves/uploads/'.$profile['profile_image'].'" alt="'.INCLUDE_PATH.'Saves/uploads/profile_default.jpg"></div>
                        <div class="name-bio">
                            <div class="profile-name"><h1>'.$name.'</h1></div>
                            <div class="profile-bio">'.$profile['profile_bio'].'</div>
                        </div>
                        
                        <div class="profile-actions">';
                            $followers_n = sizeof($followers);
                            if($followers_n == 1 ){
                                echo '<h3><span>1 Seguidor</span></h3>';
                            }else{
                                echo '<h3><span>'.$followers_n.' Seguidores</span></h3>';
                            }
                            echo '<div class="buttons"><form action="" method="post"><input type="hidden" name="user_tofollow" value='.$profile['user_id'].'>';
                            if($name != $_SESSION['name']){
                                if(isset($followers[$_SESSION['user_id']])){
                                    echo '<input type="submit" name="toggle_follow" class="unfollow" value="Deixar de seguir">'; 
                                }else {
                                    echo '<input type="submit" name="toggle_follow" class="follow" value="Seguir">';  
                                }
                            }
                           
                            //                     
                            echo '</form></div>
                        </div></div>'.$posts_grid ;
                    }else {
                        include('404.php');
                        die();
                    }                     
                ?>
        </div>

        <?php 
            if(isset($_SESSION['erroM'])){
                
                $error_div = $_SESSION['erroM'];
                unset($_SESSION['erroM']);
                echo '<script>
                    let div =document.createElement("div")
                    div.appendChild(document.createTextNode("'.$error_div.'")); 
                    let divAtual = document.getElementById(mainlogo);
                    div.setAttribute("class", "errorText");
                    document.body.insertBefore(div, divAtual);
                    setTimeout(()=>{
                        div.style.right = "2vw"
                    }, 1000);
                   
                </script>';
            }
        ?>
    </body>
 </html>
 <!-- <a href="#" class="emal">Enviar Email</a> -->