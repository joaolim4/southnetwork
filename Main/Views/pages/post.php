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
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/post.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/sidebar.css">
    </head>
    <body>
        <?php  include('includes/sidebar.php'); ?>
        <div class="post-main"></div>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
           

            function sendComment(){
                $.ajax({
                    url : "<?php echo API_URL ?>",
                    type : 'POST',
                    data : {
                        'comment' : document.getElementById('new_comment_text').value,
                        'post_id': <?php $url = explode('/',@$_GET['url']); echo $url[1]; ?>,
                        
                    },
                    success : function(results) { 
                        window.location.href="<?php echo INCLUDE_PATH.@$_GET['url'];?>"
                            // grid+= results     
                            // $('.result-side').html(grid)
                        },
                    error : function(request,error){
                        $.ajax({
                            url : "<?php echo API_URL2 ?>",
                            type : 'POST',
                            data : {
                                'comment' : document.getElementById('new_comment_text').value,
                                'post_id': <?php $url = explode('/',@$_GET['url']); echo $url[1]; ?>,
                                
                            },
                            success : function(results) { 
                                window.location.href="<?php echo INCLUDE_PATH.@$_GET['url'];?>"
                                    // grid+= results     
                                    // $('.result-side').html(grid)
                                },
                            error : function(request,error){
                            }
                        });
                    }
                });
            }

            function togglePostLike(post_id){
                $.ajax({
                    url : "<?php echo API_URL ?>",
                    type : 'POST',
                    data : {
                        'toggle_like' : true,
                        'post_id': post_id,
                    },
                    success : function(results) { 
                        $('#'+post_id).html(results)
                        },
                    error : function(request,error){
                        $.ajax({
                            url : "<?php echo API_URL2 ?>",
                            type : 'POST',
                            data : {
                                'toggle_like' : true,
                                'post_id': post_id,
                            },
                            success : function(results) { 
                                $('#'+post_id).html(results)
                                },
                            error : function(request,error){

                            }
                        });
                    }
                });
            }
            <?php 
                    $url = explode('/',@$_GET['url']);
                    if(isset($url[1])){
                        $post_id = $url[1];
                        $element = \Main\Models\FeedModel::getPost($post_id);
                        $comments = \Main\Models\FeedModel::getComments($post_id);
                        $author = \Main\Models\UsersModel::getAuthor($element['author_id']);
                        $profile = \Main\Models\UsersModel::getProfile($author);
                        $linkAuthor = '<h3><a href="'.INCLUDE_PATH.'profile/'.$author.'">'.$author.'</a></h3>';
                        $commentsGrid = "";
                        if($profile['profile_image']){
                            // ok!
                        }else {
                            $profile['profile_image'] = 'profile_default.jpg';
                        }
                        if($author == $_SESSION['name']){
                            $linkAuthor=$linkAuthor.'<i data-post_id='.$post_id.' onclick="togleview(5, this)" class="fa-solid fa-pen-to-square"></i>';
                        } 
                        if ($comments){
                            foreach($comments as $i => $value){
                                $commentsGrid = $commentsGrid.'<p><span><a href="'.INCLUDE_PATH.'profile/'.$value['author_name'].'">'.$value['author_name'].'</a>
                                </span> '.$value['comment_text'].' 
                            </p>';
                            }
                        }
                        if($element){

                        }else {
                            include('404.php');
                            die();
                        } 
                        
                        
                    } 
                    else{
                        $name = $_SESSION['name'];
                        include('404.php');
                        die();
                    }
                ?>

            var desktopPost = `<?php 
                 echo '<div class="post">
                 <div class="image-side">
                     <div class="post-images">
                         <img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$element['post_image'].'">
                     </div>
                 </div>
                 
                 <div class="info-side">
                     <div class="author-infos">
                         <div class="profilephoto">
                             <img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$profile['profile_image'].'" alt="'.INCLUDE_PATH.'Saves/uploads/profile_default.jpg">
                         </div>'.$linkAuthor.'
                     </div>
                     <div class="post-text">
                         <p>
                             <span>
                                 <a href="'.INCLUDE_PATH.'profile/'.$author.'">'.$author.'</a>
                             </span> '.$element['post_description'].'
                         </p>
                         '.$commentsGrid.'
                     </div>
                     <div class="post-infos">';
                         $likes = $element['post_likes'];
                         if (isset($likes[$_SESSION['user_id']])){
                             echo '<div class="likes infos" id='.$element['post_id'].'>
                                 <i title='.$element['post_id'].' onclick="togglePostLike(this.title)" class="fa-solid fa-heart mylikes"></i>
                                 <h3>'.(int)sizeof($element['post_likes']).'</h3>
                             </div>';
                         }else { 
                             echo '<div class="likes infos" id='.$element['post_id'].'>
                                 <i  title='.$element['post_id'].' onclick="togglePostLike(this.title)" class="fa-regular fa-heart"></i>
                                 <h3>'.(int)sizeof($element['post_likes']).'</h3>
                             </div>';
                         }
                         echo '<div class="comment_numbers infos">                                              
                                 <i class="fa-regular fa-comment"></i>
                                 <h3>'.(int)sizeof($element['post_comments']).'</h3>
                             </div>
                             <div class="new_comment">
                                 <input id="new_comment_text" type="text" maxlength="150" name="comment" placeholder="comentar..."> 
                                 <button onclick="sendComment()" id="post_comment">comentar</button>
                             </div>                     
                         </div>               
                     </div>
                 </div>';
             
                ?> `          
                            
            var mobilePost =`<?php 
                 echo '<div class="post-mobile">
                    <div class="author-infos">
                        <div class="profilephoto">
                            <img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$profile['profile_image'].'" alt="'.INCLUDE_PATH.'Saves/uploads/profile_default.jpg">
                        </div>'.$linkAuthor.'
                    </div>
                    <div class="post-images">
                        <img draggable=false src="'.INCLUDE_PATH.'Saves/uploads/'.$element['post_image'].'">
                    </div>
                     <div class="post-text">
                         <p>
                             <span>
                                 <a href="'.INCLUDE_PATH.'profile/'.$author.'">'.$author.'</a>
                             </span> '.$element['post_description'].'
                         </p>
                         '.$commentsGrid.'
                     </div>
                     <div class="post-infos">';
                         $likes = $element['post_likes'];
                         if (isset($likes[$_SESSION['user_id']])){
                             echo '<div class="likes infos" id='.$element['post_id'].'>
                                 <i title='.$element['post_id'].' onclick="togglePostLike(this.title)" class="fa-solid fa-heart mylikes"></i>
                                 <h3>'.(int)sizeof($element['post_likes']).'</h3>
                             </div>';
                         }else { 
                             echo '<div class="likes infos" id='.$element['post_id'].'>
                                 <i  title='.$element['post_id'].' onclick="togglePostLike(this.title)" class="fa-regular fa-heart"></i>
                                 <h3>'.(int)sizeof($element['post_likes']).'</h3>
                             </div>';
                         }
                         echo '<div class="comment_numbers infos">                                              
                                 <i class="fa-regular fa-comment"></i>
                                 <h3>'.(int)sizeof($element['post_comments']).'</h3>
                             </div>
                             <div class="new_comment">
                                 <input id="new_comment_text" type="text" maxlength="150" name="comment" placeholder="comentar..."> 
                                 <button onclick="sendComment()" id="post_comment">comentar</button>
                             </div>                     
                         </div>               
                    </div>';
             
            ?>`    

            function resize2(){
                if(window.innerWidth <= 768){
                    document.getElementsByClassName('post-main')[0].innerHTML = mobilePost
                    // $('.post-main').html('')
                    // $('.post-main').html(mobile)
                }else {
                    document.getElementsByClassName('post-main')[0].innerHTML = desktopPost
                    // $('.post-main').html('')
                    // $('.post-main').html(desktop)
                }
                    
            }

            window.addEventListener('resize', () => {
                if(window.innerWidth <= 768){
                    document.getElementsByClassName('post-main')[0].innerHTML = mobilePost
                }else {
                    document.getElementsByClassName('post-main')[0].innerHTML = desktopPost
                }
            });
            resize2()
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