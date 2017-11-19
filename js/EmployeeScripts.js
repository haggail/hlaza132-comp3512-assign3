/*
function showTextField(name) {
    var element=document.getElementById('name');
    if(name=='lastNameFilter' || name=='bothFilter') {
        element.style.display='block';
    }
    else {  
        element.style.display='none';
    }
}
    
function revealCityList(name) {
    var element=document.getElementById('name');
    if(name=='cityFilter' || name=='bothFilter') {
        //show the list of cities
    }
    else {
        //keep the list hidden   
    }
}

function toggleFilter() {
    var toggle = document.getElementById("filter");
    toggle.addEventListener("click", function() {
        var container = document.getElementById("filterList");
        container.style.backgroundColor="red";

    });
    
}
*/




/*
var toHide = document.getElementById("filter");
toHide.addEventListener("onmousedown", function(){
    if(toHide.classList.toggle("hideDisplay", false)){
        toHide.classList.toggle("hideDisplay", true);
    }else{
        toHide.classList.toggle("hideDisplay", false);
    } 
});*/

/*
window.addEventListener("load",function(){
    document.getElementById("filter").addEventListener("onclick", function(){
        if(document.getElementById("filterList").classList.toggle("hideDisplay", false)){
            document.getElementById("filterList").classList.toggle("hideDisplay", true);
        }else{
            document.getElementById("filterList").classList.toggle("hideDisplay", false);
         } 
    });
});*/

function fieldIsEmpty(e) {
    var field = document.getElementById("lastNameTextBox");
    if (field.value == null || field.value == "") {
        return true;
    }
    else {
        return false;
    }
}
