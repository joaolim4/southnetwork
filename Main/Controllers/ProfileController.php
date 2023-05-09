<?php 
    namespace Main\Controllers;
    class ProfileController 
    {
        public function index(){
            if(isset($_POST['disconect'])){
                unset($_POST['disconect']);
                unset($_SESSION['login']);
                session_unset();
                session_destroy();
                \Main\Utils::redirect(INCLUDE_PATH.'login');
            }else{
                if(isset($_SESSION['login'])){
                    \Main\Views\MainView::render('profile');
                }else {
                    \Main\Utils::redirect(INCLUDE_PATH.'login');
                }
            }
        }
    }
?>
