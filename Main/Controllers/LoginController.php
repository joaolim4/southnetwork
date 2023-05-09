<?php 

    namespace Main\Controllers;
    class LoginController 
    {
        public function index(){

            if(isset($_POST['login_action'])){
                $password = $_POST['password'];
                $email = $_POST['email'];
                if ($password && $email){
                    $pdo = \Main\MySql::connect();
                    $verify = $pdo->prepare("SELECT * FROM users WHERE email = ?");
                    $verify->execute(array($email));
                    $result = $verify->fetch();
                    if($verify->rowCount() == 0){
                        $_SESSION['erroM'] = 'Usuario não existe!';
                        \Main\Views\MainView::render('login');
                    }else{
                        $_passSql = $result['password'];
                        if(\Main\Bcrypt::check($password,$_passSql) ){
                            $_SESSION['login'] = $result['email'];
                            $_SESSION['name'] = $result['name'];
                            $_SESSION['user_id'] = $result['user_id'];
                            \Main\Utils::redirect(INCLUDE_PATH);
                        }else{
                            $_SESSION['erroM'] = 'Senha incorreta!';
                            \Main\Views\MainView::render('login');
                        }
                    }
                }else{
                    $_SESSION['erroM'] = 'Campos em branco!';
                    \Main\Views\MainView::render('login');
                }
            }else {
                \Main\Views\MainView::render('login');
            }
            if(isset($_POST['password'])){
                unset($_POST['password']);
            }
            if(isset($_POST['email'])){
                unset($_POST['email']);
            }
        }
    }

?>