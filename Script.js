window.onload = function() 
{
    setTimeout('reloj()', 0);
    document.onmousemove = function(e) 
    {
    var x = -(e.clientX/4);
    var y = -(e.clientY/4);

    this.body.style.backgroundPosition = x + 'px ' + y + 'px';
    		
    };
};
      
      
function Alumnos()
{
    user.value = 'Alumno';
    Alu.style.backgroundColor = "rgba(254, 209, 77,.9)";
    Prof.style.backgroundColor = "rgba(224, 43, 6,.3)";
    Admin.style.backgroundColor = "rgba(12, 150, 10,.3)";
}

        

function Profesores()
{
    user.value = 'Profesor';
    Prof.style.backgroundColor = "rgba(224, 43, 6,.9)";
    Alu.style.backgroundColor = "rgba(254, 209, 77,.3)";
    Admin.style.backgroundColor = "rgba(12, 150, 10,.3)";
    
}

function Administrador()
{
    user.value = 'Administrador';
    Admin.style.backgroundColor = "rgba(12, 150, 10,.9)";
    Prof.style.backgroundColor = "rgba(224, 43, 6,.3)";
    Alu.style.backgroundColor = "rgba(254, 209, 77,.3)";
}

function color()
{
    
    user.value = 'Administrador';
    Admin.style.backgroundColor = "rgba(12, 150, 10,.9)";
    Prof.style.backgroundColor = "rgba(224, 43, 6,.3)";
    Alu.style.backgroundColor = "rgba(254, 209, 77,.3)";
}

function Teclado(e)
{
    return false;
}

function Borrar(e)
{
    Alu.style.backgroundColor = "rgba(254, 209, 77,.5)";
    Prof.style.backgroundColor = "rgba(224, 43, 6,.5)";
    user.value = '';
}

function mostrar1(e)
{
    gestion1.style.visibility = 'visible';
    gestion2.style.visibility = 'hidden';
}

function mostrar2(e)
{
    gestion1.style.visibility = 'hidden';
    gestion2.style.visibility = 'visible';
}

function borra()
{
    if (confirm('¿Seguro que deseas eliminar este registro?')) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function borrardia()
{
    if (confirm('¿Seguro que deseas eliminar este diagrama?')) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function reloj()
{
    var fecha = new Date();
    var hora = fecha.getHours();
    var minutos = fecha.getMinutes();
    var segundos = fecha.getSeconds();

    var dia = fecha.getDate();
    var mes = fecha.getMonth()+1;
    var año = fecha.getFullYear();
    var semana=fecha.getDay();
    var dayNames = new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");

    document.getElementById('Reloj').innerHTML=hora+ " : " +minutos+" : "+segundos+"<br>"+dia+" / "+mes+" / "+año+"<br/>"+ dayNames[semana] ;
    setTimeout('reloj()', 1000);						 		
}


 