//Excel libraries from here
//https://github.com/SheetJS/sheetjs
//https://github.com/eligrey/FileSaver.js/
//https://github.com/skmaurya33/export-xlsx-jquery
//https://www.jqueryscript.net/download/JavaScript-JSON-Data-Excel-XLSX.zip


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
	
	$("#medicamentList").change(function(){
		readMedicament();
	});
	
	refreshFarmacii();
});

var codm = -1;

function raportStoc() {
    
	let medicamentId = $("#medicamentList").val();
	if (!medicamentId) {
		medicamentId = -1;//toate medicamentele
	}
	ajax("GET", "../raportController/stoc/" + medicamentId, null, function(tabularData){
		salvareExcel(tabularData, "Stoc");
	})
}

// Functie pentru generarea unui fisier Excel dintr-un workbook
function s2ab(s) { 
    var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
    var view = new Uint8Array(buf);  //create uint8array as viewer
    for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
    return buf;    
}

function raportVanzari() {
	let farmacieId = $("#farmacie").val();
	if (!farmacieId) {
		farmacieId = -1;//toate farmaciile
	}
	let deLa = getDefaultDate("#dela");
	let la = getDefaultDate("#la");
	ajax("GET", "../raportController/vanzare/" + farmacieId + "/" + deLa + "/" + la, 
			null, function(tabularData){
		salvareExcelVanzare(tabularData, "Vanzare");
	})
}

function raportTotalVanzari() {
	let deLa = getDefaultDate("#dela");
	let la = getDefaultDate("#la");
	ajax("GET", "../raportController/totalVanzari/" + deLa + "/" + la,
			null, function(tabularData){
		salvareExcelVanzare(tabularData, "TotalVanzari");
	})
}

function getDefaultDate(elementId) {
	let deLa = $(elementId).val();
	if (!deLa) {
		deLa = '0000-00-00';
	}
	return deLa;
}

// Salveaza fisier Excel
function salvareExcel(tabularData, titlu) {
	var wb = XLSX.utils.book_new();
    wb.Props = {
            "Title": titlu,
            "Subject": titlu,
            "Author": "Farmacie",
            "CreatedDate": new Date()
    };
    wb.SheetNames.push(titlu);
    var ws = XLSX.utils.aoa_to_sheet(tabularData);
    wb.Sheets[titlu] = ws;
    // avem doua coloane
    var wscols = [
        {wch: 30}, // "wch characters"/*
        {wch: 8} // "wpx pixels"
        //,
        //{hidden: true} // hide column*/
    ];
    ws['!cols'] = wscols;
    var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
    var fileName = titlu + '.xlsx';
    saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), fileName);
}

function salvareExcelVanzare(tabularData, titlu) {
	var wb = XLSX.utils.book_new();
    wb.Props = {
            "Title": titlu,
            "Subject": titlu,
            "Author": "Farmacie",
            "CreatedDate": new Date()
    };
    wb.SheetNames.push(titlu);
    var ws = XLSX.utils.aoa_to_sheet(tabularData);
    wb.Sheets[titlu] = ws;
    // avem doua coloane
    var wscols = [
        {wch: 30}, // "wch characters"/*
        {wch: 8}, // "wpx pixels"
        {wch: 8}
        //,
        //{hidden: true} // hide column*/
    ];
    ws['!cols'] = wscols;
    var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
    saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), titlu + '.xlsx');
}


function refreshFarmacii() {
	ajax("GET", "../farmacieController", null, function(data) {
		let v = new Array;
		$.each(data, function(index, value) {
			let key = value.codf;
			u = {"key": key, "value": value.filiala};
			v.push(u);
		});
		fillCombo("#farmacie", v);
	});
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
	codm = -1;
	let id = $("#medicamentList").val();
	if (!id) {
		return;
	}
	codm = $("#medicamentList").val();
}

function toateMedicamentele() {
	$("#medicamente").val('');
	$("#medicamentList").empty();
	codm = -1;
}
