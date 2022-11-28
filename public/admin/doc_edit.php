<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

        <h2>Edit doc (Delete doc)</h2>
        <p>Please, configure this.</p>


      <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
          
          <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
              <h2 class="w3-center">Doc data</h2>
              
                    Doc:<br>
                    <input class="w3-input w3-border" name="first" type="text" value="First Name">
                    <input class="w3-input w3-border" name="middle" type="text" value="Middle Name">
                    <input class="w3-input w3-border" name="last" type="text" value="Last Name">              

                    <select class="w3-select w3-border" name="option">
                      <option value="" disabled selected>Choose Specialization 1</option>
                      <option value="1" selected>Specialization 1</option>
                      <option value="2">Option 2</option>
                      <option value="3">Option 3</option>
                    </select>

                    <select class="w3-select w3-border " name="option">
                      <option value="" disabled selected>Choose Specialization 2</option>
                      <option value="1">Option 1</option>
                      <option value="2">Option 2</option>
                      <option value="3">Option 3</option>
                    </select>

                    <select class="w3-select w3-border" name="option">
                      <option value="" disabled selected>Choose Specialization 3</option>
                      <option value="1">Option 1</option>
                      <option value="2">Option 2</option>
                      <option value="3">Option 3</option>
                    </select>

                    <input class="w3-input w3-border" name="phone" type="text" value="Phone">
                    <input class="w3-input w3-border" name="cost" type="text" value="Cost">
                    <br>

                  <p>
                  <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                  </p>
                  <hr style="height: 1px; background-color: darkgrey;">
                  <p>
                  <input type="submit" name="submit" class="w3-button w3-border w3-border-red" value="Delete All">
                  </p>

          </form>
      </div>

<?php include("layout/bottom.php"); ?>