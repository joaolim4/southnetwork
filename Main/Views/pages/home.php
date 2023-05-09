
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
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/home.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/sidebar.css">
    </head>
    <body>
        <?php  include('includes/sidebar.php'); ?>
        <div class="toggle-feed">
            <button id="foryou" class="select" onclick="togleSelectFeed('foryou')">Para você</button>
            <button id="following" onclick="togleSelectFeed('following')">Seguindo</button>
        </div>
        <?php 
            $myProfile = \Main\Models\UsersModel::getProfile($_SESSION['name']);
            if ($myProfile['profile_image']){
                     
            }else{
                $myProfile['profile_image'] = 'profile_default.jpg';
            }
            $myProfileLink = '<div class="recommended-main">
                <div class="result-profile">
                    <div class="profilephoto">
                        <img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$myProfile['profile_image'].'">
                    </div>
                    <a href="'.INCLUDE_PATH.'profile/'.$_SESSION['name'].'"> Abrir perfil</a>

                </div>
            </div>';
            echo $myProfileLink;
        ?>
        
        <div class="feed foryou">
                
            <?php 
                    
                    $posts = \Main\Models\FeedModel::createUserFeed();
                    foreach($posts as $key => $element){
                        $post_id = $element['post_id'];
                        
                        $author = \Main\Models\UsersModel::getAuthor($element['author_id']);
                        
                        $profile = \Main\Models\UsersModel::getProfile($author);
                        $linkAuthor = '<h3><a href="'.INCLUDE_PATH.'profile/'.$author.'">'.$author.'</a></h3>';
                        if($author == $_SESSION['name']){
                            $linkAuthor=$linkAuthor.'<i data-post_id='.$post_id.' onclick="togleview(5, this)" class="fa-solid fa-pen-to-square"></i>';
                        }   
                        echo '<div class="post">
                            <div class="author-infos">
                            <div class="profilephoto">';

                            if($profile['profile_image']){
                                echo '<img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$profile['profile_image'].'"></div>';
                            }else {
                                echo '<img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/profile_default.jpg"></div>';
                            }
                                
                        
                            echo  ' '.$linkAuthor.'
                            </div>
                            <div class="post-images">
                                <img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$element['post_image'].'">
                            </div>
                            <div class="post-text"><p><span><a href="'.INCLUDE_PATH.'profile/'.$author.'">'.$author.'</a></span> <a href="'.INCLUDE_PATH.'post/'.$element['post_id'].'">'.$element['post_description'].'</a></p></div>
                            <div class="post-infos">';
                            $likes = $element['post_likes'];
                            if (isset($likes[$_SESSION['user_id']])){
                                echo '<div class="likes '.$element['post_id'].'">
                                    <i title='.$element['post_id'].' onclick="togglePostLike(this.title)" class="fa-solid fa-heart mylikes"></i>
                                    <h3>'.(int)sizeof($element['post_likes']).'</h3>
                                </div>';
                            }else { 
                                echo '<div class="likes '.$element['post_id'].'">
                                    <i title='.$element['post_id'].' onclick="togglePostLike(this.title)" class="fa-regular fa-heart"></i>
                                    <h3>'.(int)sizeof($element['post_likes']).'</h3>
                                </div>';
                            }
                                
                            echo '
                                    <div class="comment_numbers">
                                        <a href="'.INCLUDE_PATH.'post/'.$element['post_id'].'">
                                            <i class="fa-regular fa-comment"></i>
                                        </a>
                                        <h3>'.(int)sizeof($element['post_comments']).'</h3>
                                    </div>
                                
                            </div>
                        </div>';
                    }
                        
                    
            ?>
            <div class="fix-height"></div>
        </div>

        <div class="feed following">
            <?php 
                
                $following =  \Main\Models\UsersModel::getFollowing($_SESSION['user_id']);
                 $posts = \Main\Models\FeedModel::createUserFeed();
                 foreach($posts as $key => $element){
                    if(isset($following[$element['author_id']])){
                        $post_id = $element['post_id'];
                        
                        $author = \Main\Models\UsersModel::getAuthor($element['author_id']);
                        
                        $profile = \Main\Models\UsersModel::getProfile($author);
                        $linkAuthor = '<h3><a href="'.INCLUDE_PATH.'profile/'.$author.'">'.$author.'</a></h3>';
                        if($author == $_SESSION['name']){
                            $linkAuthor=$linkAuthor.'<i data-post_id='.$post_id.' onclick="togleview(5, this)" class="fa-solid fa-pen-to-square"></i>';
                        }   
                        echo '<div class="post">
                            <div class="author-infos">
                            <div class="profilephoto">';

                            if($profile['profile_image']){
                                echo '<img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$profile['profile_image'].'"></div>';
                            }else {
                                echo '<img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/profile_default.jpg"></div>';
                            }
                                
                            echo  ' '.$linkAuthor.'
                            </div>
                            <div class="post-images">
                                <img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$element['post_image'].'">
                            </div>
                            <div class="post-text"><p><span><a href="'.INCLUDE_PATH.'profile/'.$author.'">'.$author.'</a></span> <a href="'.INCLUDE_PATH.'post/'.$element['post_id'].'">'.$element['post_description'].'</a></p></div>
                            <div class="post-infos">';
                            $likes = $element['post_likes'];
                            if (isset($likes[$_SESSION['user_id']])){
                                echo '<div class="likes '.$element['post_id'].'">
                                    <i title='.$element['post_id'].' onclick="togglePostLike(this.title)" class="fa-solid fa-heart mylikes"></i>
                                    <h3>'.(int)sizeof($element['post_likes']).'</h3>
                                </div>';
                            }else { 
                                echo '<div class="likes '.$element['post_id'].'">
                                    <i title='.$element['post_id'].' onclick="togglePostLike(this.title)" class="fa-regular fa-heart"></i>
                                    <h3>'.(int)sizeof($element['post_likes']).'</h3>
                                </div>';
                            }
                                
                            echo '
                                    <div class="comment_numbers">
                                        <a href="'.INCLUDE_PATH.'post/'.$element['post_id'].'">
                                            <i class="fa-regular fa-comment"></i>
                                        </a>
                                        <h3>'.(int)sizeof($element['post_comments']).'</h3>
                                    </div>
                                
                            </div>
                        </div>';
                    }
                 }
            ?>
            <div class="fix-height"></div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            function togleSelectFeed(feed){
                if(feed =='foryou'){
                    document.getElementById('foryou').classList.add('select');
                    document.getElementById('following').classList.remove('select');
                    document.getElementsByClassName('following')[0].style.display = 'none';
                    document.getElementsByClassName('foryou')[0].style.display = 'block';
                }else{
                    document.getElementById('following').classList.add('select');
                    document.getElementById('foryou').classList.remove('select');
                    document.getElementsByClassName('foryou')[0].style.display = 'none';
                    document.getElementsByClassName('following')[0].style.display = 'block';
                }
            }
 
           
            

            function togglePostLike(post_id){
                var request, error = $.ajax({
                    url : "<?php echo API_URL ?>",
                    type : 'POST',
                    data : {
                        'toggle_like' : true,
                        'post_id': post_id,
                    },
                    success : function(results) { 
                        $('.'+post_id).html(results)
                    },
                    error : function(request,error){
                        
                    }
                });

            }
        </script>

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

