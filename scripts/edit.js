function javatillphp() {
    var javavar = document.getElementById("code").value;  
    //document.getElementById("rslt").innerHTML = "<?php $htmlcode='" + javavar + "';?>";
}
function toggleEditable() {
    var code = document.getElementById("code");
    var submit = document.getElementById("submitbutton");
    if (code.readOnly === true) {
        code.readOnly = false;
        submit.innerHTML = "Spara";
    } else {
        code.readOnly = true;
        javatillphp();
        submit.innerHTML = "Redigera";
    }
}