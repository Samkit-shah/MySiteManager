var counter = 1;

function addInput(divName) {

    var newdiv = document.createElement('li');
    newdiv.innerHTML =
        "<input type='text' class='form-control' name='notedata[]'>";
    document.getElementById(divName).appendChild(newdiv);
    counter++;

}

function delInput(divName) {

    var list = document.getElementById("inputlist");

    if (list.childElementCount == 1) {
        alert("Your Must Atleast enter 1 data");
        // var alertbox = document.getElementById("alertbox");
        // alertbox.style.display = "block";
        // alertbox.innerHTML = "Your Must Atleast enter 1 data";

    } else if (list.childElementCount > 1) {

        list.removeChild(list.lastChild);
    }




}

function showlistinput() {
    var checkBox = document.getElementById("listcheck");
    var listinputdata = document.getElementById("dynamicInput");
    if (checkBox.checked == true) {
        listinputdata.style.display = "block";
        document.getElementById("paracheck").disabled = true;

    } else {
        listinputdata.style.display = "none";
        document.getElementById("paracheck").disabled = false;
    }
}

function showparainput() {
    var checkBox = document.getElementById("paracheck");
    var parainputdata = document.getElementById("parainput");
    if (checkBox.checked == true) {
        parainputdata.style.display = "block";
        parainputdata.checked = true;
        document.getElementById("listcheck").disabled = true;
    } else {
        document.getElementById("listcheck").disabled = false;
        parainputdata.style.display = "none";
    }

}


$(function() {
    setTimeout(function() {
        $('.fade-message').slideUp();
    }, 1000);
});
$(function() {
    setTimeout(function() {
        $('.fade-messageinputerror').fadeOut();
    }, 5000);
});


$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})