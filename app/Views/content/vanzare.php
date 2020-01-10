<div style="margin: 10px;">
	<div class="ui-tabs-vertical">
		<ul>
			<li><a href="#tab1">Vanzare</a></li>

		</ul>
		<div id="tab1">
		<div id="editareMedicamentForm">
				<h3>Reteta</h3>
    				<div class="ui-widget left">
      					<label for="clienti">Client </label>
      					<input type="text" class="searchBox" id="clienti" /> 
      					<select id="clientList" class="searchCombo"></select>
    				</div>
    				<div class="ui-widget left">
      					<label for="doctori">Doctor </label>
      					<input type="text" class="searchBox" id="doctori" /> 
      					<select id="doctorList" class="searchCombo"></select>
    				</div>
    				
					<input type="text" id="nume" name="nume" placeholder="Nume" class="halfBox" />
					<input type="text" id="prenume" name="prenume" placeholder="Prenume" class="halfBox" /><br>
					<input type="text" id="doctor" name="doctor" placeholder="Doctor" class="fullBox" /><br>
					<label for="retete">Retete client</label>
					<select id="retete" class="almostFullBox"></select>
					<div class="ui-widget left">
      					<label for="medicamente">Medicament </label>
      					<input type="text" class="searchBox" id="medicamente" /> 
      					<select id="medicamentList" class="searchCombo"></select>
    				</div>
					<input type="text" id="medicament" name="medicament" placeholder="Denumire" class="fullBox" /><br>
					<input type="text" id="producator" name="producator" placeholder="Producator" class="fullBox" /><br>
					Cantitate <input type="text" id="cantitate" name="cantitate" class="priceBox" />
					Stoc <input type="text" id="stoc" name="stoc" class="priceBox readOnly" />
					Pret <input type="text" id="pret" name="pret" class="priceBox readOnly"/>
					Total <input type="text" id="total" name="total" class="priceBox readOnly"/><br>
					
    				<div class="ui-widget top20">
						<input type="button" onclick="findReteta()" value="Cauta reteta" />
						<input type="button" onclick="addVanzare()" value="Vanzare" />
					</div>
			</div>
		</div>
	</div>
</div>