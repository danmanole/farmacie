$(document).ready(function() {
	$(".ui-tabs-vertical").tabs();
	
	// Medicamente
	$("#medicamente").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../medicamentController/search", searchText, function(data){
				  completeMedicamentBox(data, "#medicamentList", readMedicament);
			  });
		  }
	});
	
	$("#medicamente1").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../medicamentController/search", searchText, function(data){
				  completeMedicamentBox(data, "#medicamentList1", readMedicamentAchizitie);
			  });
		  }
	});
	
	$("#medicamente2").keyup(function() {
		var searchText = $(this).val();
		  if (searchText.length > 1) {
			  ajaxSearch("GET", "../medicamentController/search", searchText, function(data){
				  completeMedicamentBox(data, "#medicamentList2", readMedicamentEditare);
			  });
		  }
	});
	
	$("#medicamentList").change(function(){
		readMedicament();
	});
	
	$("#medicamentList1").change(function(){
		readMedicamentAchizitie();
	});
	
	$("#medicamentList2").change(function(){
		readMedicamentEditare();
	});
	updateCurrentUser();
});

var codm = -1;
var currentPage = 'MedicamentForm';

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

// Citeste medicament din lista
function readMedicament() {
	let id = $("#medicamentList").val();
	if (!id) {
		return;
	}
	codm = -1;
	ajax("GET", "../medicamentController/show/" + id, null, function(data) {
		$("#medicament").val(data.den);
		$("#producator").val(data.prod);
		let peStoc = data.stoc;
		setCheckValue("#peStoc", peStoc);
		codm = id;
	});
}

// Forteaza un nou medicament
function newMedicament() {
	$("#medicament2").val('');
	$("#producator2").val('');
	$("#pretC").val('');
	$("#dataExp").val('');
	$("#prescriptie").val('');
	$("#nat_exp").val('');
	$("#nat_suba").val('');
	$("#suba").val('');
	$("#mod_a").val('');
	$("#mod_p").val('');
	$("#contraindicatii").val('');
	$("#continut").val('');
	codm = -1;
}

// Citeste medicament pentru formularul achizitii
function readMedicamentAchizitie() {
	let id = $("#medicamentList1").val();
	if (!id) {
		return;
	}
	$("#cantA").val('');
	$("#pretA").val('');

	ajax("GET", "../medicamentController/show/" + id, null, function(data) {
		$("#medicament1").val(data.den);
		$("#producator1").val(data.prod);
	});
}

// Citeste informatiile pentru editare medicament
function readMedicamentEditare() {
	let id = $("#medicamentList2").val();
	if (!id) {
		return;
	}
	$("#medicament2").val('');
	$("#producator2").val('');
	$("#pretC").val('');
	$("#prescriptie").val('');
	$("#nat_exp").val('');
	$("#nat_suba").val('');
	$("#suba").val('');
	$("#mod_a").val('');
	$("#mod_p").val('');
	$("#contraindicatii").val('');
	$("#continut").val('');

	ajax("GET", "../medicamentController/show/" + id, null, function(data) {
		$("#medicament2").val(data.den);
		$("#producator2").val(data.prod);
		$("#pretC").val(data.pret);
		$("#prescriptie").val(data.prescriptie);
		$("#dataExp").val(data.data_exp);
		$("#nat_exp").val(data.nat_exp);
		$("#nat_suba").val(data.nat_suba);
		$("#suba").val(data.suba);
		$("#mod_a").val(data.mod_a);
		$("#mod_p").val(data.mod_p);
		$("#contraindicatii").val(data.contraindicatii);
		$("#continut").val(data.continut);
		codm = data.codm;
	});
}

// Salvare sau modificare medicament
function salvareMedicament() {
	let den = $("#medicament2").val();
	if (!den){
		alert("Lipseste denumire medicament"); return;
	}
	let prod = $("#producator2").val();
	if (!prod) {
		alert("Lipseste nume producator"); return;
	}
	let pret = $("#pretC").val();
	if (!$.isNumeric(pret)) {
		alert("Pret incorect"); return;
	} else if (pret <= 0) {
		alert("Pretul trebuie sa fie > 0"); return;
	}
	let dataExp = $("#dataExp").val();
	if (!dataExp) {
		dataExp = '0000-00-00';
	}
	let prescriptie = defaultText("#prescriptie");
	let nat_exp = defaultText("#nat_exp");
	let nat_suba = defaultText("#nat_suba");
	let suba = defaultText("#suba");
	let mod_a = defaultText("#mod_a");
	let mod_p = defaultText("#mod_p");
	let contraindicatii = defaultText("#contraindicatii");
	let continut = defaultText("#continut");
	
	let json = {"den": den, "prod": prod, "pret": pret, "data_exp": dataExp,
			"prescriptie": prescriptie, "nat_exp": nat_exp, "nat_suba": nat_suba,
			"suba": suba, "mod_a": mod_a, "mod_p": mod_p, "contraindicatii": contraindicatii,
			"continut": continut};
	if (codm == -1) {// nou
		ajax("POST", "../medicamentController/create", json, function(data) {
			codm = data;
			alert("OK");
		});
	} else {
		ajax("POST", "../medicamentController/update/" + codm, json, function(data) {
			alert("OK");
		});
	}
}

// Achizitie
function achizitie() {
	let id = $("#medicamentList1").val();
	if (!id) {
		return;
	}
	let cantA = $("#cantA").val();
	let pretA = $("#pretA").val();
	
	if (!$.isNumeric(cantA)) {
		alert("Cantitate invalida"); return;
	} else if (cantA <= 0) {
		alert("Cantitatea trebuie sa fie > 0"); return;
	}
	if (!$.isNumeric(pretA)) {
		alert("Pret invalid"); return;
	} else if (pretA <= 0) {
		alert("Pretul trebuie sa fie > 0"); return;
	}
	
	let json = {"cant": cantA, "pret": pretA};
	ajax("POST", "../medicamentController/achizitie/" + id, json, function(data){
		$("#cantA").val('');
		$("#pretA").val('');
		alert("OK");
	})
}