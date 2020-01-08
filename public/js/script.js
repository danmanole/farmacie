var pathFarmacie = '/farmacie/public/index.php/'; 


function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if(!(/[0-9]/.test(ch))){
        evt.preventDefault();
    }
}


/**
 * 
 * @param method GET, POST, PUT, DELETE
 * @param url 
 * @param data JSON or null
 * @param func function
 * @returns nothing but calls the func function if it's not null
 * 
 * Examples:
 * ajax('PUT', 'users/1', {'userName': 'John'}, showUser);
 * 
 * function showUser(data) {
 * 	console.log(data);
 * } 
 */
function ajax(method, url, data, func) {
	if (data) {
		$.ajax({
			  "method": method,
			  "url": url,
			  "dataType": "json",
			  "data": data
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				ajaxError(jqXHR, textStatus, errorThrown);
			})
			.done(function(result) {
				  if (typeof func === 'function') {
					    func(result);
				  }
			  });		
	} else {
		$.ajax({
			  "method": method,
			  "url": url,
			  "dataType": "json"
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				ajaxError(jqXHR, textStatus, errorThrown);
			})
			.done(function(result) {
				  if (typeof func === 'function') {
					    func(result);
				  }
			  });
	}
}

/**
 * Apel AJAX la adresa url/data
 * @param method GET, POST, PUT, DELETE
 * @param url URL
 * @param data parametru RestFull
 * @param func functie ce va fi apelata la sfarsitul apelului
 */
function ajaxSearch(method, url, data, func) {
	if (data) {
		$.ajax({
			  "method": method,
			  "url": url + "/" + data,
			  "dataType": "json"
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				ajaxError(jqXHR, textStatus, errorThrown);
			})
			.done(function(result) {
				  if (typeof func === 'function') {
					    func(result);
				  }
			  });
	}
}

function ajaxError(jqXHR, textStatus, errorThrown) {
	console.log(jqXHR);
	console.log(textStatus);
	console.log(errorThrown);
}

/**
 * Umple valorile intr-un combo cu ajutorul unui array cu cheie/valoare
 * @param comboId
 * @param content [{"key":"a","value":"Alpha"}, {"key":"b","value":"Beta"}...]
 */
function fillCombo(comboId, content) {
	let dropdown = $(comboId);
	dropdown.empty();
	$.each(content, function(index, json) {
		dropdown.append('<option value="' + json.key + '">' + json.value + '</option>');
	});
}


/**
 * Obtine valoarea combobox 
 * @param checkboxId
 * @returns boolean
 */
function getCheckValue(checkboxId) {
	return $(checkboxId).is(":checked");
}

/**
 * Fixeaza valoarea combobox
 * @param checboxId
 * @param value
 */
function setCheckValue(checkboxId, value) {
	let isTrue = (value != "0");
	$(checkboxId).prop('checked', isTrue);
}

/**
 * Vizibilitate element
 * @param elementId
 * @param visible
 */
function setVisible(elementId, visible) {
	if (visible) {
		$(elementId).css("visibility", "visible");
	}else {
		$(elementId).css("visibility", "hidden");
	}
}

/**
 * Valoare implicita campuri goale
 * @param elementId
 * @returns valoare implicita "- " sau valoarea daca nu este camp gol
 */
function defaultText(elementId) {
	let value = $(elementId).val().trim();
	return value ? value : "- ";
}

/**
 *  
 */
function updateCurrentUser() {
	switch(currentUserJob) {
	case 'Farmacist':
		switch(currentPage) {
		case 'MedicamentForm':
			
			break;
		case 'AdministrareForm':
			break;
		}
		break;
	case 'Farmacist sef':
		break;
	case 'Contabil':
		break;
	case 'Administrator':
		break;
	}
}