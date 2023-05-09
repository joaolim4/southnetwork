<?php 
    namespace Main;

    class Utils
    {
        public static function redirect($url){
            echo '<script>window.location.href="'.$url.'"</script>';
            die();
        }

        public static function alert($mensagem){
            echo '<script>alert("'.$mensagem.'")</script>';
        }

        public static function verifyImage($imagem){
			if($imagem['type'] == 'image/jpeg' ||
				$imagem['type'] == 'image/jpg' ||
				$imagem['type'] == 'image/png'){

				$tamanho = intval($imagem['size']/1024);
				if($tamanho < 6000)
					return true;
				else
					return false;
			}else{
				return false;
			}
		}
    }
?>