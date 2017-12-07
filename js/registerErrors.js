//straight from my javascript lab 2 --Brandon
function setBackground(e) {
    if (e.type == "focus"){ 
        e.target.classList.add("highlight");
    }
    else if (e.type == "blur"){
        e.target.classList.remove("highlight");
        if(e.target.classList.contains("error") && (e.target.value == null || e.target.value == undefined || e.target.value == "")){
            e.target.classList.toggle("error", true);
        }else if(e.target.classList.contains("error")){
            e.target.classList.toggle("error", false);
        }
    }
}


window.addEventListener("load", function() {
    var toHighlight = document.getElementsByClassName("hilightable");
    
    for (var i=0; i < toHighlight.length; i++)
    {
        toHighlight[i].addEventListener("focus", setBackground);
        toHighlight[i].addEventListener("blur", setBackground);
    }
});

//submit event listener
window.addEventListener("submit", function(e) {
    var requiredFields = document.getElementsByClassName("required");
    
    for (var i=0; i < requiredFields.length; i++){
        if (requiredFields[i].value == null || requiredFields[i].value == undefined || requiredFields[i].value == ""){
            // since a field is empty prevent the form submission
            e.preventDefault();
            requiredFields[i].classList.toggle("error",true);
        }
        else
            requiredFields[i].classList.toggle("error",false);
    }
});
