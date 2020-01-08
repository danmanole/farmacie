<?php
?>
<div style="margin: 10px;">
	<div class="ui-tabs-vertical">
		<ul>
			<li><a href="#tab1">Lista</a></li>
			<li><a href="#tab2">Editare</a></li>
			<li><a href="#tab3">Achizitie</a></li>
		</ul>
		<div id="tab1">
			<div id="medicamentForm">
				<h3>Medicamente</h3>
    				<div class="ui-widget left">
      					<label for="medicamente">Cautare </label>
      					<input type="text" class="searchBox" id="medicamente" /> 
      					<select id="medicamentList" class="searchCombo"></select>
    				</div>
					<input type="text" id="medicament" name="medicament" placeholder="Denumire" class="fullBox" /><br>
					<input type="text" id="producator" name="producator" placeholder="Producator" class="fullBox" /><br>
					<div class="ui-widget top10">
						<label for="peStoc">In stoc</label>
						<input type="checkbox" id="peStoc" name="peStoc" /><br> 
					</div>
			</div>
		</div>
		<div id="tab2">
			<div id="editareMedicamentForm">
				<h3>Medicamente</h3>
    				<div class="ui-widget left">
      					<label for="medicamente2">Cautare </label>
      					<input type="text" class="searchBox" id="medicamente2" /> 
      					<select id="medicamentList2" class="searchCombo"></select>
    				</div>
					<input type="text" id="medicament2" name="medicament2" placeholder="Denumire" class="fullBox" /><br>
					<input type="text" id="producator2" name="producator2" placeholder="Producator" class="fullBox" /><br>
					<input type="text" id="pretC" name="pretC" placeholder="Pret" class="fullBox" /><br>
					<input type="date" id="dataExp" name="dataExp" placeholder="Data expirarii" class="fullBox" /><br>
					<input type="text" id="nat_exp" name="nat_exp" placeholder="Natura excipient" class="halfBox" />
					Prescriptie  
					<select id="prescriptie" name="prescriptie">
						<option value="Nu">Nu</option>
						<option value="Da">Da</option>
					</select> <br>
					<input type="text" id="nat_suba" name="nat_suba" placeholder="Natura substanta activa" class="halfBox" /> 
					<input type="text" id="suba" name="suba" placeholder="Substanta activa" class="halfBox" /><br>
					<input type="text" id="mod_a" name="mod_a" placeholder="Mod de administrare" class="halfBox" /> 
					<input type="text" id="mod_p" name="mod_p" placeholder="Mod de pastrare" class="halfBox" /><br>
					<textarea id="contraindicatii" name="contraindicatii" placeholder="Contraindicatii" class="fullBox" rows="4" cols="50"></textarea><br>
					<input type="text" id="continut" name="continut" placeholder="Continut" class="fullBox" /><br>
					
					<div class="ui-widget top30">
						<input type="button" onclick="newMedicament()" value="Nou" />
						<input type="button" onclick="salvareMedicament()" value="Salvare" />
					</div>
			</div>
		</div>
		<div id="tab3">
			<div id="achizitieForm">
				<h3>Medicamente</h3>
    				<div class="ui-widget left">
      					<label for="medicamente1">Cautare </label>
      					<input type="text" class="searchBox" id="medicamente1" /> 
      					<select id="medicamentList1" class="searchCombo"></select>
    				</div>
					<input type="text" id="medicament1" name="medicament1" placeholder="Denumire" class="fullBox" /><br>
					<input type="text" id="producator1" name="producator1" placeholder="Producator" class="fullBox" /><br>
					<div class="ui-widget top10">
						<label for="cantA">Cantitate achizitionata</label>
						<input type="text" id="cantA" name="cantA" class="priceBox"/><br>
						<label for="pretA">Pret achizitie</label>
						<input type="text" id="pretA" name="pretA" class="priceBox" /><br> 
					</div>
					<div class="ui-widget top50">
						<input type="button" onclick="achizitie()" value="Achizitie" />
					</div>
			</div>
					
		</div>
	</div>
</div>		