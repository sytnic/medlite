<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

    <h2>Doc's list</h2>
    <p>Please, choose doc.</p>
    
    <div class="w3-bar-block">

<?php 
        //  mysqli_result | false
        $result = get_all_docs(); 
        // if false
        if (!$result) {
            echo "No docs yet.";

            // if mysqli_result and rows > 0
        } else {
            while($doc = mysqli_fetch_assoc($result)) {
                $output = '<p><a href="doc_overall.php?docid=';
                $output.= $doc["id"];
                $output.= '" class="w3-button w3-border">';
                $output.= $doc["surname"]." ".$doc["firstname"];
                $output.= "</a>";
                if($doc["active"] == 0){
                    $output.= " Not Active";
                }
                $output.= "</p>";
                echo $output;
            }
        }
        
?>        
<!--    <p><a href="#" class="w3-button w3-border">A LinkButton</a> Not Active</p>  -->
    
        <p>
            <a href="doc_create.php" class="w3-button w3-circle w3-xlarge w3-teal"> + </a>
        </p>

    </div>
                    
<?php include("layout/bottom.php"); ?>