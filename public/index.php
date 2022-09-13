<?php
include("layouts/header.php");
include("layouts/sidebar.php");
?>
<?php
// Если прийти сюда пошагово назад,
// то данные сессии будут стёрты шаг за шагом.
// Если прийти сюда напрямую через Home,
// данные сессии сохранятся в зависимости от того, 
// с какого шага пришли, т.к. на каждом шаге собственное стирание. 
// Можно придумать стирание всех значений здесь. 

?>
        <h2>Header</h2>

        <div class="w3-container">
            
        </div>

        <p>Please, fill the next steps.</p> 
        
        <p>Next step</p>
        <a href="client_data.php" class="w3-button w3-border">Next</a>
<?php       
include("layouts/footer.php");                        
?>    