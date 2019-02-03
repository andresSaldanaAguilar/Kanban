window.onload = function(){
    parallax();
	setTimeout('reloj()', 0);
	
	cargar();
};

interact('#dropzone').dropzone(
	{
		accept: '.draggable',
		overlap: 1,
		
		ondropactivate: function (event)
		{
			//event.target.classList.add('drop-active');
		},
		ondragenter: function (event)
		{
			var draggableElement = event.relatedTarget;
			var dropzoneElement = event.target;
			//draggableElement.firstChild.style.visibility = 'hidden';
			dropzoneElement.childNodes[1].style.visibility = 'visible';
			//dropzoneElement.textContent = 'Dragged in';
		},
		ondragleave: function(event)
		{
			// remove the drop feedback style
			event.relatedTarget.firstChild.style.visibility = 'visible'
			//event.target.childNodes[1].style.visibility = 'hidden';
		},
		ondrop: function(event)
		{
			borrar(event.relatedTarget);
			
			var params = document.getElementsByClassName('draggable');
			for(var i = 0; i < params.length; i++)
			{
				params[i].id = "Punto"+i;     
			}
		},
		ondropdeactivate: function(event)
		{
			// remove active dropzone feedback
			//event.target.classList.remove('drop-active');
			//event.target.childNodes[1].style.visibility = 'hidden';
		}
	});
	
	
	interact('.draggable').draggable(
	{
		//onstart: dragMoveListener,
		onmove: dragMoveListener,
		inertia: false,
		restrict: 
		{
			restriction: "parent",
			endOnly: false,
			elementRect: { top: 1, left: 1, bottom: 0, right: 0 }
		},
		autoScroll:true
		
	});
	
	
	function dragMoveListener(event)
	{
		var target = event.target;
		
		var x =((parseInt(target.getAttribute('dataX')) || 0) + event.dx);
		var y =((-parseInt(target.getAttribute('dataY')) || 0) + event.dy);
		
		
		//target.style.transform = 'translate(' + x*.95 + 'px, ' + y*1.07 + 'px)';
		target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
		y = -y;
		target.setAttribute('dataX', x);
		target.setAttribute('dataY', y);
		target.firstChild.innerHTML = '(' + (x) + ',' + (y) + ')';
	}
	window.dragMoveListener = dragMoveListener;
	
	
	function crear()
	{
		var params = document.getElementsByClassName('draggable');
		var ultimo;
		if(params.length != 0)
		{
			ultimo = parseInt(params[params.length - 1].id.substring(5))+1;
		}
		else
		{
			ultimo = 0;
		}
	
		var newNode = document.createElement('div');
		newNode.setAttribute('class', 'draggable');
		newNode.setAttribute('id', 'drag-' + ultimo);
		newNode.setAttribute('onmouseover', 'positionIn(this)');
		newNode.setAttribute('onmouseout', 'positionOut(this)');
		newNode.setAttribute('onclick', 'acomodar(this)');
		var newTooltip = document.createElement('span');
		newTooltip.setAttribute('class', 'tooltip');
		var newText = document.createTextNode('(0,0)');
		newTooltip.appendChild(newText);
		newNode.appendChild(newTooltip);
		var grid = document.getElementById('grid');
		grid.appendChild(newNode);
		//plotPoints();
	}
	
	
	function positionIn(element)
	{
		//element.firstChild.innerHTML = '(' + (element.getAttribute('dataX') / 10 || 0) + ',' + (element.getAttribute('dataY') / 10 || 0) + ')';
		element.firstChild.style.visibility = 'visible';
	}
	
	function positionOut(element)
	{
		//element.firstChild.innerHTML = '';
		element.firstChild.style.visibility = 'hidden';
	}
	
	function borrar(element)
	{
		document.getElementById('grid').removeChild(element);
	}
	
	
	function ver()
	{
		var mens = '';
		var params = document.getElementsByClassName('draggable');
		for(var i = 0; i < params.length; i++)
		{
			mens += params[i].id + ': x=' + params[i].getAttribute('dataX')/10 + ', y=' + params[i].getAttribute('dataY')/10 + '\n';
		}
		window.alert(mens);
	}
	
	function cargar()
	{
		var tarea = document.getElementsByClassName('draggable');
		var columna = document.getElementsByClassName('columna');
		var contador = new Array( columna.length ); 
		var x , y;
		
		for(var i = 0 ; i < columna.length ; i++)
		{
			contador[i] = 0;     
		}
		
		for(var i = 0; i < tarea.length; i++)
		{
			for(var j = 0 ; j < columna.length ; j++)
			{
				if( tarea[i].getAttribute("idColumna") == columna[j].getAttribute("idColumna") )
				{
					x = ( j * 400 ) + 125; 
					y = ( contador[j]*100 + 100 );
		
					tarea[i].style.transform = 'translate(' + x + 'px, ' + y + 'px)';
					y = -y;
					tarea[i].setAttribute('dataX', x);
					tarea[i].setAttribute('dataY', y);
					tarea[i].firstChild.innerHTML = '(' + (x) + ',' + (y) + ')';
					contador[j]++;
				}
			}
		}
		
		for(var i = 0 ; i < columna.length ; i++)
		{
			columna[i].style.height = contador[i]*100 + 100 +"px";
		}
	}
	
	function acomodar(element)
	{
		var tarea = document.getElementsByClassName('draggable');
		var columna = document.getElementsByClassName('columna');
		var contador = new Array( columna.length ); 
		var x , y , ini , fin , comodin=0;
		
		if( element.getAttribute("Bloqueo") == 0 )
		{
			for(var i = 0 ; i < columna.length ; i++)
			{
				contador[i] = 0;     
			}
			
			for(var i = 0; i < tarea.length; i++)
			{
				if( element != tarea[i] )
				{
					for(var j = 0 ; j < columna.length ; j++)
					{
						if( tarea[i].getAttribute("idColumna") == columna[j].getAttribute("idColumna") )
						{
							x = ( j * 400 ) + 125; 
							y = ( contador[j]*100 + 100 );
				
							tarea[i].style.transform = 'translate(' + x + 'px, ' + y + 'px)';
							y = -y;
							tarea[i].setAttribute('dataX', x);
							tarea[i].setAttribute('dataY', y);
							tarea[i].firstChild.innerHTML = '(' + (x) + ',' + (y) + ')';
							contador[j]++;
						}
					}
				}
			}
			
			for(var i = 0 ; i < columna.length ; i++)
			{
				ini = ( i * 400 ) + 50; 
				fin = ( ( i + 1) * 400 ) + 49; 
				
				if( parseFloat(element.getAttribute("dataX")) >= ini && parseFloat(element.getAttribute("dataX")) <= fin )
				{
					if( contador[i] < parseInt(columna[i].getAttribute("limite")) )
					{
						x = ( i * 400 ) + 125; 
						y = ( contador[i]*100 + 100 );
			
						element.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
						y = -y;
						element.setAttribute('dataX', x);
						element.setAttribute('dataY', y);
						element.firstChild.innerHTML = '(' + (x) + ',' + (y) + ')';
						contador[i]++;
						
						element.setAttribute('idColumna', columna[i].getAttribute("idColumna") );
						
						comodin++;
					}
				}
			}
			
			if( comodin == 0 )
			{
				for(var j = 0 ; j < columna.length ; j++)
				{
					if( element.getAttribute("idColumna") == columna[j].getAttribute("idColumna") )
					{
						x = ( j * 400 ) + 125; 
						y = ( contador[j]*100 + 100 );
			
						element.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
						y = -y;
						element.setAttribute('dataX', x);
						element.setAttribute('dataY', y);
						element.firstChild.innerHTML = '(' + (x) + ',' + (y) + ')';
						contador[j]++;
					}
				}
				window.alert("No es posible agregar otra tarea a esta columna");
			}
			
			for(var i = 0 ; i < columna.length ; i++)
			{
				columna[i].style.height = contador[i]*100 + 100 +"px";
			}
		}
		else
		{
			window.alert("Tarea Bloqueada");
			cargar();
		}
	}
	
	function verificar( element )
	{
		var tarea = document.getElementsByClassName('draggable');
		var columna = document.getElementsByClassName('columna');
		var validador = 0;
		
		for(var i = 0; i < tarea.length; i++)
		{
			if( tarea[i].getAttribute("idColumna") == columna[0].getAttribute("idColumna") )
			{
				validador++;
			}
		}
		
		if( validador == parseInt( columna[0].getAttribute("limite") ) )
		{
			window.alert("No es posible agregar una nueva tarea");
		}
		else
		{
			guardar( element );
		}
	}
	
	function guardar( element )
	{
		var tarea = document.getElementsByClassName('draggable');
	
		if( element.getAttribute("name") == 'b1' )
		{
			var form = document.getElementById('Envio1');
			
			for(var i = 0; i < tarea.length; i++)
			{
				var Node = document.createElement('input');
				Node.setAttribute('type', 'hidden');
				Node.setAttribute('name', 'tarea'+i );
				Node.setAttribute('value', tarea[i].getAttribute('idTarea') );
				form.appendChild(Node);
	
				var Node = document.createElement('input');
				Node.setAttribute('type', 'hidden');
				Node.setAttribute('name', 'columna'+i );
				Node.setAttribute('value', tarea[i].getAttribute('idColumna') );
				form.appendChild(Node);
			}
	
			var Node = document.createElement('input');
			Node.setAttribute('type', 'hidden');
			Node.setAttribute('name', 'Contador');
			Node.setAttribute('value', i);
			form.appendChild(Node);
	
			var Node = document.createElement('input');
			Node.setAttribute('type', 'hidden');
			Node.setAttribute('name', 'gestion');
			Node.setAttribute('value', 'b1' );
			form.appendChild(Node);
			
			document.getElementById("Envio1").submit();
		}
		if( element.getAttribute("name") == 'b2' )
		{
			var form = document.getElementById('Envio2');
			
			for(var i = 0; i < tarea.length; i++)
			{
				var Node = document.createElement('input');
				Node.setAttribute('type', 'hidden');
				Node.setAttribute('name', 'tarea'+i );
				Node.setAttribute('value', tarea[i].getAttribute('idTarea') );
				form.appendChild(Node);
	
				var Node = document.createElement('input');
				Node.setAttribute('type', 'hidden');
				Node.setAttribute('name', 'columna'+i );
				Node.setAttribute('value', tarea[i].getAttribute('idColumna') );
				form.appendChild(Node);
			}
			
			var Node = document.createElement('input');
			Node.setAttribute('type', 'hidden');
			Node.setAttribute('name', 'Contador');
			Node.setAttribute('value', i);
			form.appendChild(Node);
	
			var Node = document.createElement('input');
			Node.setAttribute('type', 'hidden');
			Node.setAttribute('name', 'gestion');
			Node.setAttribute('value', 'b2' );
			form.appendChild(Node);
			
			document.getElementById("Envio2").submit();
		}
		if( element.getAttribute("name") == 'bsalir' )
		{
			var form = document.getElementById('Envio2');
			
			for(var i = 0; i < tarea.length; i++)
			{
				var Node = document.createElement('input');
				Node.setAttribute('type', 'hidden');
				Node.setAttribute('name', 'tarea'+i );
				Node.setAttribute('value', tarea[i].getAttribute('idTarea') );
				form.appendChild(Node);
	
				var Node = document.createElement('input');
				Node.setAttribute('type', 'hidden');
				Node.setAttribute('name', 'columna'+i );
				Node.setAttribute('value', tarea[i].getAttribute('idColumna') );
				form.appendChild(Node);
			}
			
			var Node = document.createElement('input');
			Node.setAttribute('type', 'hidden');
			Node.setAttribute('name', 'Contador');
			Node.setAttribute('value', i);
			form.appendChild(Node);
	
			var Node = document.createElement('input');
			Node.setAttribute('type', 'hidden');
			Node.setAttribute('name', 'gestion');
			Node.setAttribute('value', 'bsalir' );
			form.appendChild(Node);
			
			document.getElementById("Envio2").submit();
		}
		if( element.getAttribute("name") == 'b3' )
		{
			var form = document.getElementById( 'Envio3' + element.getAttribute("value") );
			
			for(var i = 0; i < tarea.length; i++)
			{
				var Node = document.createElement('input');
				Node.setAttribute('type', 'hidden');
				Node.setAttribute('name', 'tarea'+i );
				Node.setAttribute('value', tarea[i].getAttribute('idTarea') );
				form.appendChild(Node);
	
				var Node = document.createElement('input');
				Node.setAttribute('type', 'hidden');
				Node.setAttribute('name', 'columna'+i );
				Node.setAttribute('value', tarea[i].getAttribute('idColumna') );
				form.appendChild(Node);
			}
	
			var Node = document.createElement('input');
			Node.setAttribute('type', 'hidden');
			Node.setAttribute('name', 'Contador');
			Node.setAttribute('value', i);
			form.appendChild(Node);
	
			var Node = document.createElement('input');
			Node.setAttribute('type', 'hidden');
			Node.setAttribute('name', 'gestion');
			Node.setAttribute('value', 'b3' );
			form.appendChild(Node);
			
			document.getElementById( 'Envio3' + element.getAttribute("value") ).submit();
		} 
	}
	
	
	function filtro( element )
	{
		var tarea = document.getElementsByClassName('draggable');
		var grid = document.getElementById('grid');
		
		if( element.getAttribute("name") == 'res' )
		{
			var i , j , k , l=0;
			
			for( i = 0; i < tarea.length; i++)
			{
				if( parseInt(tarea[i].getAttribute("idTarea")) > l )
				{
					l = parseInt(tarea[i].getAttribute("idTarea"));
				}
			}
		
			for( i = 1; i <= l; i++)
			{
				j = 0;
				k = tarea.length;
				
				while( k > 0 )
				{
					if( tarea[j].getAttribute("idTarea") == i )
					{
						grid.appendChild(tarea[j]);
					}
					else
					{
						j++;
					}
					k--;
				}
			}
			
			cargar();
		}
		if( element.getAttribute("name") == 'pri' )
		{
			var i , j , k ;
			
			for( i = 5; i >= 1; i--)
			{
				j = 0;
				k = tarea.length;
				
				while( k > 0 )
				{
					if( tarea[j].getAttribute("Prioridad") == i )
					{
						grid.appendChild(tarea[j]);
					}
					else
					{
						j++;
					}
					k--;
				}
			}
			
			cargar();
		}
		if( element.getAttribute("name") == 'val' )
		{
			var i , j , k ;
			
			for( i = 10; i >= 1; i--)
			{
				j = 0;
				k = tarea.length;
				
				while( k > 0 )
				{
					if( tarea[j].getAttribute("Valor") == i )
					{
						grid.appendChild(tarea[j]);
					}
					else
					{
						j++;
					}
					k--;
				}
			}
			
			cargar();
		}
		if( element.getAttribute("name") == 'suc' )
		{
			var i , j , k ;
			
			for( i = 100; i >= 0; i--)
			{
				j = 0;
				k = tarea.length;
				
				while( k > 0 )
				{
					if( tarea[j].getAttribute("Progreso") == i )
					{
						grid.appendChild(tarea[j]);
					}
					else
					{
						j++;
					}
					k--;
				}
			}
			
			cargar();
		}
	}
	
	function makeRequest( )
	{
		var i , res;
		var tarea = document.getElementsByClassName('draggable');
		var barra = document.getElementById('Busqueda');
		
		
		for( i = 0; i < tarea.length; i++)
		{
			//window.alert( barra.value + " " + tarea[i].getAttribute('Usuario').substring(0,barra.value.length) );
			res = barra.value.localeCompare( tarea[i].getAttribute('Usuario').substring(0,barra.value.length) ) ;
			
			if( res == 0 )
			{
				tarea[i].style.visibility = 'visible';
			}
			else
			{
				tarea[i].style.visibility = 'hidden';
			}
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
	
	