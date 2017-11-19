  <div class="mdl-layout__drawer mdl-color--blue-grey-800 mdl-color-text--blue-grey-50">
       <div class="profile">
           <img src="images/avatar.jpg" class="avatar">
           <h4> <!--User First/Last name -->
               <?php
                    //if($login = true) {do below} else redirect
                    if(isset($_SESSION["FirstName"]) && isset($_SESSION["LastName"])){
                        echo $_SESSION["FirstName"] . " " . $_SESSION["LastName"];
                    }else{
                        echo "Currently Unavailable";
                    }
               ?>
           </h4>           
           <span> <!-- User Email -->
               <?php 
                     if(isset($_SESSION["Email"])){
                        echo $_SESSION["Email"];
                    }else{
                       echo "Currently Unavailable"; 
                    }
               ?>
           </span>
       </div>

    <nav class="mdl-navigation mdl-color-text--blue-grey-300">
        <a href="index.php" class="mdl-navigation__link mdl-color-text--blue-grey-300" href=""><i class="material-icons" role="presentation">dashboard</i> Dashboard</a>
        <a href="profile.php" class="mdl-navigation__link mdl-color-text--blue-grey-300" href=""><i class="material-icons" role="presentation">face</i> User Profile</a>
        <a href="browse-universities.php" class="mdl-navigation__link mdl-color-text--blue-grey-300" href=""><i class="material-icons" role="presentation">message</i> Browse Universities</a>
        <a href="browse-books.php" class="mdl-navigation__link mdl-color-text--blue-grey-300" href=""><i class="material-icons" role="presentation">event</i> Browse Books</a>
        <a href="browse-employees.php" class="mdl-navigation__link mdl-color-text--blue-grey-300" href=""><i class="material-icons" role="presentation">call</i> Browse Employees</a>
        <a href="aboutus.php" class="mdl-navigation__link mdl-color-text--blue-grey-300" href=""><i class="material-icons" role="presentation">settings</i> About Us</a>
        <a href="analytics.php" class="mdl-navigation__link mdl-color-text--blue-grey-300" href=""><i class="material-icons" role="presentation">cloud</i> Analytics</a>


                           
    </nav>
  </div>