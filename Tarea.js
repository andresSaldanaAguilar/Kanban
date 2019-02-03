window.onload = function(){
    parallax();
    setTimeout('reloj()', 0);

    var userTarModal = document.getElementById('userTarModal');
    var addUserTarBtn = document.getElementById("addUserTarBtn");
    var userTarModalClose = document.getElementById('userPortTarClose');

    if(userTarModal)
        addModal(userTarModal, addUserTarBtn, userTarModalClose);
};

function llenar(user){
    var autoCompleteDropdown = document.getElementById("autoCompleteDropdown");

    var newUser = document.createElement("div");
    newUser.addEventListener("click", function(){
        addUserMod(user);
    });
    newUser.innerHTML = user['userName'] + " (" + user['Nombre'] + " " + user['ApPaterno'] + " " + user['ApMaterno'] + ")";
    
    var newValue = document.createElement("input");
    newValue.setAttribute("type", "hidden");
    newValue.setAttribute("name", "idUsuario");
    newValue.setAttribute("value", user['idUsuario']);
    
    newUser.appendChild(newValue);
    autoCompleteDropdown.appendChild(newUser);
}

function limpiar(){
    var autoCompleteDropdown = document.getElementById("autoCompleteDropdown");
    while(autoCompleteDropdown.firstChild)
        autoCompleteDropdown.removeChild(autoCompleteDropdown.firstChild);
}

function addUserMod(user){
    var dropdown = document.getElementById("drop");
    var portSaver = document.getElementById('busqueda').getAttribute('onkeyup');

    var userNameDiv = document.createElement("div");
    userNameDiv.innerHTML = user['userName'] + " (" + user['Nombre'] + " " + user['ApPaterno'] + " " + user['ApMaterno'] + ")";

    var userId = document.createElement("input");
    userId.setAttribute("type", "hidden");
    userId.setAttribute("name", "idUsuario");
    userId.setAttribute("value", user['idUsuario']);
    
    var modClose = document.createElement("span");
    modClose.classList.add("modalGenClose");
    modClose.innerHTML = "&times";
    modClose.onclick = function(){
        removeUserMod(userMod, portSaver);
    };

    var userMod = document.createElement("div");
    userMod.classList.add("userMod");
    userMod.appendChild(userNameDiv);
    userMod.appendChild(userId);
    userMod.appendChild(modClose);

    dropdown.parentNode.replaceChild(userMod, dropdown);
}

function addEventUserMod(portSaver){
    var modClose = document.getElementById('modClose');
    if(modClose)
        modClose.onclick = function(){
            removeUserMod(modClose.parentNode, "autocompletar(this.value, " + portSaver + ")");
        };
}

function removeUserMod(userMod, portSaver){
    var busqueda = document.createElement('input');
    busqueda.setAttribute('id', 'busqueda');
    busqueda.setAttribute('type', 'text');
    busqueda.setAttribute('name', 'busqueda');
    busqueda.setAttribute('placeholder', 'Buscar Usuario');
    busqueda.setAttribute('onkeyup', portSaver);

    var autoCompleteDropdown = document.createElement('div');
    autoCompleteDropdown.setAttribute('id', 'autoCompleteDropdown');
    autoCompleteDropdown.setAttribute('class', 'dropdownContent');
    
    var dropdown = document.createElement('div');
    dropdown.setAttribute('id', 'drop');
    dropdown.setAttribute('class', 'dropdown');
    dropdown.setAttribute('style', 'position:absolute; top: 470px; left: 320px; width: 500px');

    dropdown.appendChild(busqueda);
    dropdown.appendChild(autoCompleteDropdown);

    userMod.parentNode.replaceChild(dropdown, userMod);
    

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


function validar( element )
{
	var obj = document.getElementById('block');
	
	if( obj.getAttribute('value') == "" )
	{
		document.getElementById( 'borrar' ).submit();
	}
	else
	{
		window.alert("Tarea Bloqueada");
	}
	
}