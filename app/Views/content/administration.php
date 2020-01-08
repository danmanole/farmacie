<?php
?>
<div style="margin: 10px;">
	<div class="ui-tabs-vertical">
		<ul>
			<li><a href="#tab1">Utilizator</a></li>
			<li><a href="#tab2">Farmacie</a></li>
			<li><a href="#tab3">Three</a></li>
			<li><a href="#tab4">Four</a></li>

		</ul>
		<div id="tab1">
			<div id="userForm">
				<h3>Utilizator</h3>
    				<div class="ui-widget left">
      					<label for="users">Cautare </label>
      					<input type="text" class="searchBox" id="users" /> 
      					<select id="usersList" class="searchCombo"></select>
    				</div>
					<input type="text" id="user" name="user" placeholder="Nume" class="fullBox" /><br>
					<input type="password" id="password1" name="password1" placeholder="Parola" class="fullBox hidden" /><br>
					<input type="password" id="password2" name="password2" placeholder="Confirmare parola" class="fullBox hidden" /><br>
					
					<div class="ui-widget">
      					<label for="job">Functie </label>
      					<select id="job" class="searchCombo">
      						<option value="Farmacist">Farmacist</option>
      						<option value="Farmacist sef">Farmacist sef</option>
      						<option value="Contabil">Contabil</option>
      						<option value="Administrator">Administrator</option>
      					</select>
    				</div>
					<div class="ui-widget top10">
						<label for="userFarmacie">Farmacie</label>
						<select id="userFarmacie" class="searchCombo"></select> 
					</div>
					<div class="ui-widget top10">
						<label for="userActive">Activ</label>
						<input type="checkbox" id="userActive" name="userActive" /><br> 
					</div>
					<div class="ui-widget top50">
						<input type="button" onclick="newUser()" value="Nou" />
						<input type="button" onclick="addUser()" value="Salveaza" />
						<input type="button" onclick="deleteUser()" value="Sterge" />
					</div>
			</div>
		</div>
		<div id="tab2">
			<div id="farmacieForm">
				<h3>Farmacie</h3>
    				<div class="ui-widget left">
      					<label for="farmacii">Cautare </label>
      					<input type="text" class="searchBox" id="farmacii" /> 
      					<select id="farmacieList" class="searchCombo"></select>
    				</div>
					<input type="text" id="filiala" name="filiala" placeholder="Filiala" class="fullBox" /><br>
					<div class="ui-widget top10">
						<label for="active">Activa</label>
						<input type="checkbox" id="farmacieActive" name="farmacieActive" /><br> 
					</div>
					<div class="ui-widget top50">
						<input type="button" onclick="newFarmacie()" value="Noua" />
						<input type="button" onclick="addFarmacie()" value="Salveaza" />
						<input type="button" onclick="deleteFarmacie()" value="Sterge/Inactiv" />
					</div>
			</div>
		</div>
		<div id="tab3">
		</div>
		<div id="tab4">
		</div>
	</div>
</div>