window.onload = function(){
    parallax();
    setTimeout('reloj()', 0);

    var portModal = document.getElementById('portModal');
    var crearPortBtn = document.getElementById("crearPortBtn");
    var portModalClose = document.getElementById('portModalClose');

    addModal(portModal, crearPortBtn, portModalClose);
};