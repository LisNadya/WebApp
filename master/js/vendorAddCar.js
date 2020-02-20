
function makeRed(inputDiv){
    inputDiv.style.backgroundColor="rgb(255, 145, 128)";
}

function makeClean(inputDiv){
    inputDiv.style.backgroundColor="white";
}

function isBlank(inputDiv){
    if(inputDiv.type=="select"){
        if(inputDiv.checked){
            return false;
        }
        return true;
    }
    if(inputDiv.value == ""){
        return true;
    }
    return false;
}

function submitCheck(){
    var mainform = document.getElementById("mainForm");
    
    mainform.onsubmit = function(e){
        var requiredInputs = document.querySelectorAll(".required");

        for(var i=0; i<requiredInputs.length;i++){
            if(isBlank(requiredInputs[i])){
                e.preventDefault();
                makeRed(requiredInputs[i]);
            }
            else{
                makeClean(requiredInputs[i]);
            }
        }
    }
}