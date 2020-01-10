$(document).ready(function() {
	$(".ui-tabs-vertical").tabs();
	
	// Client
	$("#clienti").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../clientController/search", searchText, function(data){
				  completeClientBox(data, "#clientList", readClient);
			  });
		  }
	});
	
	// Medicamente
	$("#medicamente").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../medicamentController/search", searchText, function(data){
				  completeMedicamentBox(data, "#medicamentList", readMedicament);
			  });
		  }
	});
	
	// Doctor
	$("#doctori").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../retetaController/search", searchText, function(data){
				  completeDoctorBox(data, "#doctorList", readDoctor);
			  });
		  }
	});
	
	// Cantitate
	$("#cantitate").keyup(function() {
		var cantitate = $(this).val();
		  if (cantitate.length > 0) {
			  let total = 0;
			  if ($.isNumeric(cantitate)) {
				  let cant = parseInt(cantitate, 10);// stiu ca e numbar dar nu vindem decat la bucata
				  if (cant == cantitate) {// numai numere intregi
					  let pret = $("#pret").val();
					  if ($.isNumeric(pret)) {
						  total = cant * pret;
					  }
				  }
			  }
			  if (total == 0) {
				  $("#total").val('');
			  } else {
				  $("#total").val(total);
			  }
		  }
	});
	
	$("#clientList").change(function(){
		readClient();
	});
	
	$("#doctorList").change(function(){
		readDoctor();
	});
	
	$("#medicamentList").change(function(){
		readMedicament();
	});
	
	updateReteta();
});


var codc = -1; // cod client
var codm = -1; // cod medicament
var medicamentFaraReteta = false;
var idReteta = -1;

// In cazul in care o reteta a fost transmisa formularului de vanzare
// o folosesc ca sa completez reteta
function updateReteta() {
	var parametruReteta = urlComponent(window.location.href, "idReteta");
	if ($.isNumeric(parametruReteta)) {
		idReteta = parametruReteta;
		ajax("GET", "../retetaController/complete/" + idReteta, null, function(data){
			$("#nume").val(data.nume);
			$("#prenume").val(data.prenume);
			$("#doctor").val(data.doctor);
			let txt = data.data_elib + " " + data.tip;
			$("#clienti").val(data.nume + " " + data.prenume);
			$("#doctori").val(data.doctor);
			$("#retete").append(new Option(txt, data.codr));
		});
	}
}

function completeMedicamentBox(data, comboId, func) {
	let v = new Array;
	$.each(data, function(index, value){
		let key = value.codm;
		u = {"key": key, "value": value.den};
		v.push(u);
	});
	fillCombo(comboId, v);
	func();
}

function readMedicament() {
	let id = $("#medicamentList").val();
	if (!id) {
		return;
	}
	codm = -1;
	ajax("GET", "../medicamentController/show/" + id, null, function(data) {
		$("#medicament").val(data.den);
		$("#producator").val(data.prod);
		$("#pret").val(data.pret);
		$("#stoc").val(data.stoc);
		medicamentFaraReteta = data.prescriptie == "Nu";
		codm = id;
	});
}

function completeClientBox(data, func) {
	let v = new Array;
	$.each(data, function(index, value){
		let key = value.codc;
		let numePrenume = value.nume + " " + value.prenume;
		u = {"key": key, "value": numePrenume};
		v.push(u);
	});
	fillCombo("#clientList", v);
	readClient();
}

function completeDoctorBox(data, func) {
	let v = new Array;
	$.each(data, function(index, numeDoctor){
		u = {"key": numeDoctor, "value": numeDoctor};
		v.push(u);
	});
	fillCombo("#doctorList", v);
	readDoctor();
}

function readClient() {
	let id = $("#clientList").val();
	codc = -1;
	$("#nume").val('');
	$("#prenume").val('');
	
	ajax("GET", "../clientController/show/" + id, null, function(data) {
		$("#nume").val(data.nume);
		$("#prenume").val(data.prenume);
		codc = id;
	});
}

function readDoctor() {
	$("#doctor").val('');
	$("#doctor").val($("#doctorList").val());
}

function findReteta() {
	if (codc != -1) {
		let json={"doctor" : $("#doctor").val(), "codc": codc};
		ajax("POST", "../retetaController/find", json, function(data){
			let v = new Array;
			$.each(data, function(index, info){
				let descriere = info.data_elib + " " + info.tip;
				u = {"key": info.codr, "value": descriere};
				v.push(u);
			});
			fillCombo("#retete", v);
		});
	}
}

// Caut reteta si adaug la ea o vanzare
function addVanzare() {
	let codr = $("#retete").val();
	// daca medicamentul este fara reteta nu am nevoie de codr
	if (!codr && !medicamentFaraReteta) {
		alert("Medicamentul nu se poate obtine fara reteta"); return;
	}
	if (codm == -1) {
		alert("Nu ati selectat nici un medicament"); return;
	}
	if (medicamentFaraReteta) {
		codr = 0;
	}
	let cantitate = $("#cantitate").val().trim();
	if (!cantitate) {
		alert("Cantitate invalida");return;
	}
	if (cantitate <= 0) {
		alert("Cantitatea trebuie sa fie > 0");return;
	}
	if (cantitate > parseInt($("#stoc").val(), 10)) {
		alert("Cantitatea este mai mare decat stocul curent"); return;
	}
	let data_vanz = getCurrentDate();
	
	// userId este introdus din VanzareController.php direct in pagina "vanzare.php"
	// cu valoarea utilizatorului logat
	let json = {"codr" : codr, "codm" : codm, "cant" : cantitate, "data_vanz": data_vanz,
			"userId": userId};
	ajax("POST", "../vanzareController/create", json, function(data){
		$("#cantitate").val('');
		readMedicament(); // refac stocul conform vanzarii
		alert("OK");
	});
}