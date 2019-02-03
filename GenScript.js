function parallax(){
    document.onmousemove = function(e) 
    {
        var x = -(e.clientX/100);
        var y = -(e.clientY/100);

        this.body.style.backgroundPosition = x + 'px ' + y + 'px';
    };
}

function reloj(){
    var fecha = new Date();
    var hora = fecha.getHours();
    var minutos = fecha.getMinutes();
    var segundos = fecha.getSeconds();

    var dia = fecha.getDate();
    var mes = fecha.getMonth()+1;
    var año = fecha.getFullYear();
    var semana=fecha.getDay();
    var dayNames = new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");

    document.getElementById('Reloj').innerHTML=dia+" / "+mes+" / "+año+"<br/>"+ dayNames[semana]+"<br/>"+ hora+ " : " +minutos+" : "+segundos;
    setTimeout('reloj()', 1000);						 		
}

function addModal(modal, btn, close){
    btn.onclick = function(){
        modal.style.display = "block";
    }
    close.onclick = function(){
        modal.style.display = "none";
    }

    window.addEventListener("click", function(event){
        if(event.target == modal)
            modal.style.display = "none";
    });
}