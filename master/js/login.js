function makeRed(inputDiv){
    inputDiv.style.backgroundColor="rgb(255, 145, 128)";
}

function makeClean(inputDiv){
    inputDiv.style.backgroundColor="white";
    inputDiv.parentNode.style.backgroundColor="white";
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

function loginCheck(){
    var mainform = document.getElementById("login");
    
    mainform.onsubmit = function(e){
        var requiredInputs = document.querySelectorAll(".loginRequired");

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

function registerCheck(){
    var mainform = document.getElementById("registration");
    
    mainform.onsubmit = function(e){
        var requiredInputs = document.querySelectorAll(".registerRequired");

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