window.onload = function(){
    parallax();
    setTimeout('reloj()', 0);

    var tabModal = document.getElementById('tabModal');
    var crearTabBtn = document.getElementById("crearTabBtn");
    var tabModalClose = document.getElementById('tabModalClose');
    if(crearTabBtn){
        addModal(tabModal, crearTabBtn, tabModalClose);
    
        var tabModalAdd = document.getElementById("tabModalAdd");
        tabModalAdd.onclick = function(){
            addTab();
        };
        addTab();
        addTab();
    }

    var userPortModal = document.getElementById('userPortModal');
    var addUserPortBtn = document.getElementById("addUserPortBtn");
    var userPortModalClose = document.getElementById('userPortModalClose');

    if(userPortModal)
        addModal(userPortModal, addUserPortBtn, userPortModalClose);
};

function addTab(){
    var nomCols = document.createElement("input");
    nomCols.setAttribute("type", "text");
    nomCols.setAttribute("name", "nomCols[]");
    nomCols.setAttribute("required", "required");
    nomCols.setAttribute("placeholder", "Nombre de la Columna");

    var wipCols = document.createElement("input");
    wipCols.setAttribute("type", "number");
    wipCols.setAttribute("name", "wipCols[]");
    wipCols.setAttribute("required", "required");
    wipCols.setAttribute("min", "1");
    wipCols.setAttribute("placeholder", "Limite WIP");

    var modalGenClose = document.createElement("span");
    modalGenClose.classList.add("modalGenClose");
    modalGenClose.innerHTML = "&times";
    modalGenClose.onclick = function(){
        removeGens(modalGenClose);
    };


    var modalGens = document.createElement("div");
    modalGens.classList.add("modalGens");
    modalGens.appendChild(nomCols);
    modalGens.appendChild(wipCols);
    modalGens.appendChild(modalGenClose);

    var tabModalAdd = document.getElementById("tabModalAdd");
    tabModalAdd.parentNode.insertBefore(modalGens, tabModalAdd);
}

function removeGens(modalGenClose){
    var modalGens = document.getElementById("modalBody").getElementsByClassName("modalGens");

    if(modalGens.length > 2)
        modalGenClose.parentElement.remove();
}

function llenar(user){
    var autoCompleteDropdown = document.getElementById("autoCompleteDropdown");
    var newForm = document.createElement("form");
    newForm.setAttribute("action", "AltaUserPort.php");
    newForm.setAttribute("method", "post");

    var newUser = document.createElement("div");
    newUser.addEventListener("click", function(){
        newForm.submit();
    });
    newUser.innerHTML = user['userName'] + " (" + user['Nombre'] + " " + user['ApPaterno'] + " " + user['ApMaterno'] + ")";
    
    var newValue = document.createElement("input");
    newValue.setAttribute("type", "hidden");
    newValue.setAttribute("name", "idUsuario");
    newValue.setAttribute("value", user['idUsuario']);
    
    newForm.appendChild(newUser);
    newForm.appendChild(newValue);
    autoCompleteDropdown.appendChild(newForm);
}

function limpiar(){
    var autoCompleteDropdown = document.getElementById("autoCompleteDropdown");
    while(autoCompleteDropdown.firstChild)
        autoCompleteDropdown.removeChild(autoCompleteDropdown.firstChild);
}

function autocompletar(userSearch, idPortafolio){
    limpiar();

    if(userSearch != ""){
        var xmlHttp;
        if(window.XMLHttpRequest)
            xmlHttp = new XMLHttpRequest();
        else
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        
        xmlHttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var users = JSON.parse(this.responseText);
                for(var i = 0; i < users.length; i++)
                    llenar(users[i]);
           }
        };
        if(idPortafolio === undefined)
            xmlHttp.open("GET", "autocomplete.php?q=" + userSearch, true);
        else
            xmlHttp.open("GET", "autocomplete.php?q=" + userSearch + "&idPortafolio=" + idPortafolio, true);
        xmlHttp.send();
    }
}
