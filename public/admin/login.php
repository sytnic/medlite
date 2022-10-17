<?php include("layout/top.php"); ?>

      <h2>Log in</h2>

      <div class="w3-container">          
      </div>

      <div class="w3-container w3-teal">
          <h2>Input Form</h2>
      </div>
        
      <form action="login_success.html" method="post" class="w3-container">
        <p>
        <label>Admin Name</label>
        <input class="w3-input w3-border" type="text"></p>

        <p>
        <label>Password</label>
        <input class="w3-input w3-border" type="password"></p>

        <button class="w3-button w3-block w3-section w3-green w3-ripple w3-padding" type="submit" name="submit">Login </button>
        <button class="w3-button w3-block w3-section w3-pale-red w3-ripple w3-padding" type="submit" formaction="login_danger.html" name="submit">Login </button>
      </form> 
      
<?php include("layout/bottom.php"); ?>