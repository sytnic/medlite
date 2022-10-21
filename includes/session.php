<?php
    session_start();

    function message() {
        if (isset($_SESSION["message"])) {
            $output = '<div class="w3-panel w3-pale-yellow w3-border" style="width:300px;">';
            $output .= '<p>';
            $output .=  $_SESSION["message"];
            $output .= '</p>';
            $output .= '</div>';
            
            // очистка сообщения после первого использования
            $_SESSION["message"] = null;
            
            return $output;
        }
    }

?>