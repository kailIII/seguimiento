$(document).ready(function() 
    { 
        $("#completeTable").tablesorter( {sortList: [[0,0], [1,0]]} );
        
        $("#showHideVacunas").click(function(){
    	$("#listaVacunas").toggle(500);
  		});
  		$("#showHideActividades").click(function(){
    	$("#listaActividades").toggle(500);
  		});
  		$("#showHideComentarios").click(function(){
    	$("#listaComentarios").toggle(500);
  		});
  		$('.dropdown-toggle').dropdown();

  		var form = document.getElementById("formContainer");
        var add = document.getElementById("addButton");
		if(form.style.display == "block"){
		add.innerHTML = "Volver";
		}
    }

); 


function showForm(){
	var form = document.getElementById("formContainer");
	var add = document.getElementById("addButton");
	if(form.style.display === "block"){
		form.style.display = "none";
		add.innerHTML = "Agregar";
	}else{
	form.style.display = "block";
	add.innerHTML = "Volver";
	add.onclick = function(){
		form.style.display = "none";
		add.innerHTML = "Agregar";
		add.onclick = function(){
			showForm();
		}
	}
}
}

function editForm(){
	var form = document.getElementById("edit");
	form.style.display = "block";
	var editButton = document.getElementById("editButton");
	editButton.innerHTML = "Ocultar";
	var estadoVacas = document.getElementById("estadoVacas");
	estadoVacas.style.display = "none";
	editButton.onclick = function(){
		form.style.display = "none";
		editButton.innerHTML = "Editar Vaca";
		estadoVacas.style.display = "inline";
		editButton.onclick = function(){
			editForm();
		}
	}
}



function addEvent(){
	var form = document.getElementById("events");
	form.style.display = "block";
	var editButton = document.getElementById("addEventButton");
	editButton.innerHTML = "Ocultar";
	editButton.onclick = function(){
		form.style.display = "none";
		editButton.innerHTML = "Nuevo evento";
		editButton.onclick = function(){
			addEvent();
		}
	}
}








