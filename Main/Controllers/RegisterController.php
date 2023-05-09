<?php 

    namespace Main\Controllers;
    class RegisterController 
    {
        public function index(){
            if(isset($_POST['register_action'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                if ($name && $email && $password){
                    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $_SESSION['erroM'] = 'E-mail invalido.';
                        \Main\Utils::redirect(INCLUDE_PATH.'register');
                        // echo '<script>document.getElementById("register_name").value='.$name.' document.getElementById("register_email").value='.$email.' document.getElementById("register_password").value='.$password.' </script>';
                    }
                    else if (strpos($name, ' ') !== false){
                        $_SESSION['erroM'] = 'Seu usuário não pode conter espaço.';
                        \Main\Utils::redirect(INCLUDE_PATH.'register');
                    }
                    else if(strlen($password) < 6){
                        $_SESSION['erroM'] = 'Mínimo de 6 caracteres na senha.';
                        \Main\Utils::redirect(INCLUDE_PATH.'register');
                        // echo '<script>document.getElementById("register_name").value='.$name.' document.getElementById("register_email").value='.$email.' document.getElementById("register_password").value='.$password.' </script>';
                    }
                    else if(\Main\Models\UsersModel::emailExists($email)){
                        $_SESSION['erroM'] = 'Esse email já foi registrado.';
                        \Main\Utils::redirect(INCLUDE_PATH.'register');
                        // echo '<script>document.getElementById("register_name").value='.$name.' document.getElementById("register_email").value='.$email.' document.getElementById("register_password").value='.$password.' </script>';
                    }
                    else if(\Main\Models\UsersModel::nameExists($name)){
                        $_SESSION['erroM'] = 'Esse nome já foi registrado.';
                        \Main\Utils::redirect(INCLUDE_PATH.'register');
                        // echo '<script>document.getElementById("register_name").value='.$name.' document.getElementById("register_email").value='.$email.' document.getElementById("register_password").value='.$password.' </script>';
                    }
                    else{
                        $password = \Main\Bcrypt::hash($password);
                        $register = \Main\MySql::connect()->prepare("INSERT INTO users VALUES (null, ?,?,?) ");
                        $register->execute(array($name,$email,$password));
                        \Main\Models\UsersModel::createProfile($name);
                        $_SESSION['erroM'] = 'Registrado com sucesso.';
                        \Main\Utils::redirect(INCLUDE_PATH);
                        // \Main\Views\MainView::render('home');
                    }    
                }else{
                    $_SESSION['erroM'] = 'Campos em branco.';
                    \Main\Utils::redirect(INCLUDE_PATH.'register');
                }
            }else {
                \Main\Views\MainView::render('register');
            }
            if(isset($_POST['password'])){
                unset($_POST['password']);
            }
            if(isset($_POST['email'])){
                unset($_POST['email']);
            }
            if(isset($_POST['name'])){
                unset($_POST['name']);
            }
        }
    }

?>