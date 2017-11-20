  <header class="mdl-layout__header">
          <div class="mdl-layout__header-row">

     <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
 

     
      <div class="mdl-layout-spacer"></div>
      
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
                  
<label id="tt2" class="material-icons mdl-badge mdl-badge--overlap" data-badge="5">account_box</label>  
<div class="mdl-tooltip" for="tt2">Messages</div>
                 
<label id="tt3" class="material-icons mdl-badge mdl-badge--overlap" data-badge="4">notifications</label> 
 <div class="mdl-tooltip" for="tt3">Notifications</div>
 
 <label id="tt4" class="material-icons mdl-badge mdl-badge--overlap">power_settings_new</label>
 <div class="mdl-tooltip" for="tt4">Logout</div>
 
 <script>
 // clicking the logout button will redirect to a page that removes all session state variables
 $("#tt4").click(function() {
    window.location.replace("session_destroyer.php");
 });
 </script>
        <label id="tt5" class="mdl-button mdl-js-button mdl-button--icon"
               for="fixed-header-drawer-exp">
          <i class="material-icons" id="expandSearch">search</i>
        </label>
         <div class="mdl-tooltip" for="tt5">Search Employees</div> 
        
      </div>
    </div> 
    <!-- employee search form-->
        <div id="searchBox" class="searchBtn">
            <form action="/browse-employees.php?city=&" method="get">
            <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="text" name="lastName" id="search" style="color: black"/>
                <label class="mdl-textfield__label" for="search">Search Employees...</label>
            </div>
                  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="submit">
                  Search</button>
            </form>
            
        </div>
        
  </header>
   <script>
        var click = false;
            $("#expandSearch").click(function () { //shows and hides the search bar on click.
                if (click) {
                    $("#searchBox").css("display", "none");
                    click = false;
                } else {
                    $("#searchBox").css("display", "inline");
                    click = true
                }
            });
    </script>