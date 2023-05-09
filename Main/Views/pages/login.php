
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/login.css">
    </head>
    <body>
        <div class="back"></div>
        <form action="" method="post">
            <h2>LOGIN</h2>
            <input type="email" name="email" placeholder="E-mail..." <?php if(isset($_POST['email'])){ echo 'value='.$_POST['email']; }?>>
            <input type="password" name="password" placeholder="Senha...">
            <a href="<?php echo INCLUDE_PATH?>register">Criar Contar</a>
            <input type="submit" name="login_action" value="Logar">
            
        </form>
        <div class="main-logo" id="mainlogo">
            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/mainlogo.png">
        </div>
        
    </body>
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
</html>