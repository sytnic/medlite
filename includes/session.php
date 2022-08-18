<?php
    session_start();

    function message() {
        if (isset($_SESSION["message"])) {
            $output = "<div class=\"message\">";
            $output .=  print_r( $_SESSION["message"] );
            $output .= "<br>";
            $output .=  $_SESSION["message"][0]; 
            $output .= "</div>";
            
            // очистка сообщения после первого использования
            $_SESSION["message"] = null;
            
            return $output;
        }
    }

?>