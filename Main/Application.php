<?php 
    namespace Main;
    class Application 
    {
        private $controller;

        private function setApp(){
            $LoadName = 'Main\Controllers\\';
            $url = explode('/',@$_GET['url']);

            if($url[0] == ''){
                $LoadName.="Home";

            }else{
                $LoadName.=ucfirst(strtolower($url[0]));
            }

            $LoadName.="Controller";
            if(file_exists($LoadName.'.php')){
                $this->controller = new $LoadName();
            }else{
                include('Views/pages/404.php');
                die();
            }    
            if(isset($_SESSION['login']) && isset($_SESSION['user_id'])){
                if(isset($_POST['newpost_public']) && isset($_POST['newpost_descripition']) && $_POST['newpost_descripition'] && isset($_FILES['newpost_image']) && $_FILES['newpost_image']){
                    \Main\Models\FeedModel::newPost($_POST['newpost_descripition'], $_FILES['newpost_image'], $_SESSION['user_id']);
                    $_SESSION['erroM'] = 'Post criado com sucesso!';
                    unset($_POST['newpost_public']);
                    unset($_POST['newpost_descripition']); 
                    unset($_FILES['newpost_image']);
                }
                if(isset($_POST['updateprofile']) ){
                    if(isset($_POST['updateprofile_bio'])){
                        if($_POST['updateprofile_bio']){
                            \Main\Models\UsersModel::updateProfileBio($_POST['updateprofile_bio'], $_SESSION['user_id']);
                        }
                        unset($_POST['updateprofile_bio']);
                    } 

                    if(isset($_FILES['profilecfg_image'])){
                        if($_FILES['profilecfg_image']['type'] && \Main\Utils::verifyImage($_FILES['profilecfg_image'])){
                            \Main\Models\UsersModel::updateProfileImage($_FILES['profilecfg_image'],$_SESSION['user_id'], $_SESSION['name']);
                            
                        }
                        unset($_FILES['profilecfg_image']);
                    } 
                    $_SESSION['erroM'] = 'Perfil atualizado com sucesso!';
                    unset($_POST['updateprofile']);
                } 
                if(isset($_POST['editpost_public']) && isset($_POST['editpost_id'])){
                    if(isset($_POST['editpost_descripition'])){
                        if($_POST['editpost_descripition']){
                            \Main\Models\FeedModel::updatePostDesc($_POST['editpost_descripition'], $_POST['editpost_id'], $_SESSION['user_id']);
                        }
                        unset($_POST['editpost_descripition']);
                       
                    } 
                    if(isset($_FILES['editpost_image'])){
                        if($_FILES['editpost_image']['type'] && \Main\Utils::verifyImage($_FILES['profilecfg_image'])){
                            \Main\Models\FeedModel::updatePostImge($_POST['editpost_id'],$_SESSION['user_id'], $_FILES['editpost_image']);
                            
                        }   
                        unset($_FILES['editpost_image']);     
                    } 
                    
                    unset($_POST['editpost_id']);
                    unset($_POST['editpost_public']);
                    $_SESSION['erroM'] = 'Post atualizado com sucesso!';
                }
                if(isset($_POST['editpost_delete']) && isset($_POST['editpost_id'])){
                    
                    \Main\Models\FeedModel::deletePost($_POST['editpost_id'], $_SESSION['user_id']);
                    $_SESSION['erroM'] = 'Post deletado com sucesso!';
                    unset($_POST['editpost_delete']);
                    unset($_POST['user_tofollow']);
                }
                if(isset($_POST['toggle_follow']) && isset($_POST['user_tofollow'])){
                    
                    if ((int)$_POST['user_tofollow'] != (int)$_SESSION['user_id']){
                        \Main\Models\UsersModel::toggleFollow($_SESSION['user_id'], $_POST['user_tofollow']);
                    }
                    unset($_POST['toggle_follow']);
                    unset($_POST['user_tofollow']);
                }
            }     
                
        }

        public function run(){
            $this->setApp();
            $this->controller->index();
        }
    }
?>