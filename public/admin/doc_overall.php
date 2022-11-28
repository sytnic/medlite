<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

            <h2>Overall for doc</h2>
            <p>Please, configure this.</p>

        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:80%; float:left;">      
            
            <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">        
                    <input class="w3-radio" type="radio" name="activity" value="active" checked>
                    <label>Active doc</label>
                    <br>
                    <input class="w3-radio" type="radio" name="activity" value="not_active">
                    <label>Not Active doc</label>
                    <br>

                    <p>
                    <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                    </p>            
            </form>

            <p><a href="doc_edit.php">Edit doc</a></p>

            <p><a href="doc_time.php">Edit doc's time</a></p>
        
        </div>

<?php include("layout/bottom.php"); ?>