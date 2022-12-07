<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_GET["specname"])) {
    $specname = $_GET["specname"];
}

if (isset($_GET["doc_id"])) {
    $doc_id = $_GET["doc_id"];
}  

// Используется два последовательных запроса на удаление,
// чтобы не менять поведение базы данных, данное по умолчанию:
// restrict (ограничение) при удалении связанных данных.
// Другое нужное поведение в БД - это каскадное (cascade) удаление:
// оно автоматически удалит все связанные строки
// при одном запросе.

// Удаление всех записей из связанной таблицы
$query = "
DELETE FROM docspec WHERE doc_id = {$doc_id};
";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) > 0) {
    // Success
    $output = "Doc deleted from linking table. \r\n";
    
} else {
    // Failure
    $output = "Doc deleted from linking table failed. \r\n";
    
}

// Удаление дока из основной таблицы
$query2 = " 
DELETE FROM docs WHERE id = {$doc_id} LIMIT 1;
";
$result2 = mysqli_query($connection, $query2);

if ($result2 && mysqli_affected_rows($connection) == 1) {
    // Success
    $output.= "Doc deleted from his table.";
    $_SESSION["message"] = $output;
    redirect_to("spec_value.php?specname={$specname}");
} else {
    // Failure
    $output.= "Doc deletion from his table failed.";
    $_SESSION["message"] = $output;
    redirect_to("spec_value.php?specname={$specname}");
}


?>