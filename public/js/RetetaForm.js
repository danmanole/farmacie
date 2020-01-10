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
	
	$("#doctori").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../retetaController/search", searchText, function(data){
				  completeDoctorBox(data, "#doctorList", readDoctor);
			  });
		  }
	});
	
	$("#clientList").change(function(){
		readClient();
	});
	
	$("#doctorList").change(function(){
		readDoctor();
	});
	
	completeVarsta();
});

var codc = -1;

function completeVarsta() {
	let v = new Array;
	for (i = 1; i < 126; i++) {
		u = {"key" : i, "value" : i};
		v.push(u);
	}
	fillCombo("#varsta", v);
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
	$("#sex").val('');
	$("#varsta").val('');
	
	ajax("GET", "../clientController/show/" + id, null, function(data) {
		$("#nume").val(data.nume);
		$("#prenume").val(data.prenume);
		$("#sex").val(data.sex);
		$("#varsta").val(data.varsta);
		codc = id;
	});
}

function readDoctor() {
	$("#doctor").val('');
	$("#doctor").val($("#doctorList").val());
}

function newReteta() {
	$("#nume").val('');
	$("#prenume").val('');
	$("#doctor").val('');
	$("#diagnostic").val('');
}

function addVanzare() {
	let nume = $("#nume").val().trim();
	let prenume = $("#prenume").val().trim();
	let doctor = $("#doctor").val().trim();
	let sex = $("#sex").val();
	let varsta = $("#varsta").val();
	let tip = $("#tip").val();
	let data_elib = $("#data_elib").val();
	
	if (!nume) {
		alert("Lipseste nume"); return;
	}
	if (!prenume) {
		alert("Lipseste prenume"); return;
	}
	if (!doctor) {
		alert("Lipseste doctor"); return;
	}
	
	let json = {"nume" : nume, "prenume": prenume, "doctor": doctor, "varsta": varsta,
			"sex":sex, "data_elib": data_elib, "tip": tip};
	ajax("POST", "../retetaController/create", json, function(data){
		window.location.replace("../home/vanzare?idReteta=" + data);
	});
}

