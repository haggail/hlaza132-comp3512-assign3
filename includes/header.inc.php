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
     document.querySelector("#tt4").addEventListener("click", function () {
        window.location.replace("login.php"); 
     });
 </script>

 <!-- for badges for the icon 
 https://icons8.com/icon/set/logout/all 
 https://material.io/icons/#ic_power_settings_new
 -->
    
    <!-- failed attempts at the icon
    <label class="mdl-button mdl-js-button mdl-button--icon" for="">
    <i class="material-icons" id="#ic_power_settings_new" >Lougout</i></label>
    
    <a href="https://material.io/icons/#ic_power_settings_new" class="mdl-button mdl-js-button mdl-button--badge">
    <i class="mdl-button mdl-js-button mdl-button--badge">Logout</i></a></label> -->
                  
        <label id="tt5" class="mdl-button mdl-js-button mdl-button--icon"
               for="fixed-header-drawer-exp">
          <i class="material-icons" id="expandSearch">search</i>
        </label>
         <div class="mdl-tooltip" for="tt5">Search Employees</div> 
        
      </div>
    </div>
        <div id="searchBox" class="searchBtn">
            <form action="/browse-employees.php?city=&" method="get">
                <input type="text" name="lastName" id="dropDown" placeholder="Search Employees...">
                <button type="submit">Search</button>
            </form>
            
        </div>
  </header>
   <script>
        var click = false;
            $("#expandSearch").click(function () {
                if (click) {
                    $("#searchBox").css("display", "none");
                    click = false;
                } else {
                    $("#searchBox").css("display", "inline");
                    click = true
                }
            });
    </script>