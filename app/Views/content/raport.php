<div style="margin: 10px;">
	<div class="ui-tabs-vertical">
		<ul>
			<li><a href="#tab1">Vanzari</a></li>
			<li><a href="#tab2">Stocuri</a></li>
		</ul>
		<div id="tab1">
			<div id="vanzariForm">
				<h3>Vanzari</h3>
				Farmacie <select id="farmacie"></select><br><br>
				De la <input type="date" id="dela" /> La <input type="date" id="la" /><br>
				<div class="ui-widget top50">
						<input type="button" onclick="raportVanzari()" value="Vanzari farmacie" />
						<input type="button" onclick="raportTotalVanzari()" value="Total vanzari" />
				</div>
			</div>
			<div id="raportVanzari"></div>
		</div>
		<div id="tab2">
			<div id="vanzariForm">
				<h3>Stocuri</h3>
				<div class="ui-widget left">
      					<label for="medicamente">Medicament </label>
      					<input type="text" class="searchBox" id="medicamente" /> 
      					<select id="medicamentList" class="searchCombo"></select>
    			</div><br>
				<div class="ui-widget top50">
					<input type="button" onclick="toateMedicamentele()" value="Toate medicamentele" />
					<input type="button" onclick="raportStoc()" value="Raport stoc" />
				</div>
				<div id="raportStoc"></div>
			</div>
		</div>
	</div>
</div>		