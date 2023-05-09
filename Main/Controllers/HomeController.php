<?php 

    namespace Main\Controllers;
    class HomeController 
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
                    \Main\Views\MainView::render('home');
                }else {
                    if(isset($_POST['login_action'])){
                        $password = $_POST['password'];
                        $email = $_POST['email'];
                        if ($password && $email){
                            $pdo = \Main\MySql::connect();
                            $verify = $pdo->prepare("SELECT * FROM users WHERE email = ?");
                            $verify->execute(array($email));
                            $result = $verify->fetch();
                            
                            if($verify->rowCount() == 0){
                                \Main\Utils::alert('Usuario não existe!');
                                \Main\Utils::redirect(INCLUDE_PATH.'login');
                            }else{
                                $_passSql = $result['password'];
                                if(\Main\Bcrypt::check($password,$_passSql) ){
                                    $_SESSION['login'] = $result['email'];
                                    $_SESSION['name'] = $result['name'];
                                    $_POST['disconect'] = false;
                                    \Main\Utils::redirect(INCLUDE_PATH);
                                }else{
                                    \Main\Utils::alert('Senha incorreta!');
                                    \Main\Utils::redirect(INCLUDE_PATH.'login');
                                }
                            }
                             
                        }else{
                            \Main\Utils::alert('Campos em branco!');
                            \Main\Utils::redirect(INCLUDE_PATH.'login');
                        }
                    }else {
                        \Main\Utils::redirect(INCLUDE_PATH.'login');
                    }
                    // \Main\Views\MainView::render('login');
    
                }
            }
            if(isset($_POST['password'])){
                unset($_POST['password']);
            }
            if(isset($_POST['email'])){
                unset($_POST['email']);
            }
        }
        public function search($search){

        }
    }

?>