$(document).ready(function() {
	
	$(".ui-tabs-vertical").tabs();
	
	// Utilizatori
	$("#users").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../userController/search", searchText, completeUserBox);
		  }
	});
	
	$("#usersList").change(function(){
		readUser();
	});
	
	// Farmacii
	$("#farmacii").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../farmacieController/search", searchText, completeFarmacieBox);
		  }
	});
	
	$("#farmacieList").change(function(){
		readFarmacie();
	});
	
	refreshFarmacii();
});

var codu = -1; // cod utilizator
var codf = -1; // cod farmacie
var currentPage = 'AdministrareForm';


// Utilizatori

// Citeste utilizatorul curent
function readUser() {
	let id = $("#usersList").val();
	if (!id) {
		return;
	}
	codu = -1;
	$("#password1").val('');
	$("#password2").val('');
	ajax("GET", "../userController/show/" + id, null, function(data) {
		$("#user").val(data.userName);
		$("#job").val(data.job);
		setCheckValue("#userActive", data.activ);
		codu = id;
		ajaxSearch("GET", "../usersFarmacieController/showf", data.id, function(userFarmacie) {
			$("#userFarmacie").val(userFarmacie.codf);
		});
	});
}

// Pregateste un nou utilizator
function newUser() {
	$("#user").val('');
	$("#userFarmacie").val('');
	$("#userActive").prop('checked', false);
	$("#users").val('');
	$("#password1").val('');
	$("#password2").val('');
	$("#job").val('');
	codu = -1;
}

// Adauga utilizator
function addUser() {
	let userName = $("#user").val();
	if (!userName) {
		alert("Lipseste nume");
		return;
	}
	let password1 = $("#password1").val();
	let password2 = $("#password2").val();
	let codfarmacie = $("#userFarmacie").val();
	let job = $("#job").val();
	let activ = getCheckValue("#userActive");
	let json = {"userName" : userName, "userPassword": password1,"nivelAcces":1, 
			"job": job, "farmacie": codfarmacie, "activ": activ};
	if (codu == -1) {// nou
		if (!password1 || !password2 || password1 != password2) {
			alert("Parolele lipsesc sau nu sunt la fel");
			return;
		}
		ajax("POST", "../userController/create", json, function(data) {
			codu = data;
			alert("OK");
		});
	} else {//modificare
		if (password1 && password2 && password1 != password2) {
			alert("Parolele nu sunt la fel");
			return;
		}
		ajax("POST", "../userController/update/" + codu, json, function(data) {
			alert("OK");
		});
	}
}

// Sterge utilizator
function deleteUser() {
	if (codu != -1) {
		ajax("DELETE", "../userController/delete/" + codu, null, function(data) {
			newUser();
			alert("OK");
		});
	}
}

// Completare combo utilizator
function completeUserBox(data) {
	let v = new Array;
	$.each(data, function(index, value){
		let key = value.id;
		u = {"key": key, "value": value.userName};
		v.push(u);
	});
	fillCombo("#usersList", v);
	readUser();
}

// Farmacii

// Citeste toate farmaciile (pentru combo din interfata)
function refreshFarmacii() {
	ajax("GET", "../farmacieController", null, function(data) {
		fillCombo("#usersList", v);
		newUser();
	});
}

// Citeste o farmacie selectata din lista
function readFarmacie() {
	let id = $("#farmacieList").val();
	codf = -1;
	ajax("GET", "../farmacieController/show/" + id, null, function(data) {
		$("#filiala").val(data.filiala);
		setCheckValue("#farmacieActive", data.activa);
		codf = id;
	});
}

// Sterge informatiile de pe pagina, pregateste o noua farmacie
function newFarmacie() {
	$("#filiala").val('');
	$("#farmacieActive").prop('checked', false);
	codf = -1;
}

// Adauga sau modifica farmacie
function addFarmacie() {
	let filiala = $("#filiala").val();
	let activa = getCheckValue("#farmacieActive");
	if (!filiala) {
		alert("Lipseste nume");
		return;
	}
	
	let json = {"filiala": filiala, "activa": activa};
	
	if (codf == -1) {// farmacie noua
		ajax("POST", "../farmacieController/create", json, 
				function(data) {
					codf = data;
					newUser();
					alert("OK");
		});
	} else {// modificare farmacie
		ajax("POST", "../farmacieController/update/" + codf, json, function(data) {
			$("#farmacii").keyup();
			refreshFarmacii();
		});
	}
}

// Sterge farmacie (o face inactiva daca are informatii)
function deleteFarmacie() {
	ajax("DELETE", "../farmacieController/delete/" + codf, null, function(data){
			$("#farmacii").keyup();
			newUser();
			alert("OK");
	});
}

// Afisare farmacii
function refreshFarmacii() {
	ajax("GET", "../farmacieController", null, function(data) {
		let v = new Array;
		$.each(data, function(index, value){
			let key = value.codf;
			u = {"key": key, "value": value.filiala};
			v.push(u);
		});
		fillCombo("#userFarmacie", v);
		$("#userFarmacie").val('');
	});
}


// Afiseaza farmaciile conform cautarii
function completeFarmacieBox(data) {
	let v = new Array;
	$.each(data, function(index, value){
		let key = value.codf;
		u = {"key": key, "value": value.filiala};
		v.push(u);
	});
	fillCombo("#farmacieList", v);
	readFarmacie();
}

