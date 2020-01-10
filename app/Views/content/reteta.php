<div style="margin: 10px;">
	<div class="ui-tabs-vertical">
		<ul>
			<li><a href="#tab1">Reteta</a></li>

		</ul>
		<div id="tab1">
		<div id="userForm">
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
					<label for="varsta">Varsta </label>
  						<select id="varsta">
  						</select> 
  					<label for="sex">Sex </label>
  						<select id="sex">
  							<option value="Feminim">Feminin</option>
  							<option value="Masculin">Masculin</option>
  						</select>
  					<br>
					<input type="text" id="doctor" name="doctor" placeholder="Doctor" class="fullBox" /><br>
					<input type="text" id="diagnostic" name="diagnostic" placeholder="Diagnostic" class="fullBox" /><br>
					
					<label for="tip">Tip </label>
  					<select id="tip" class="searchCombo">
  						<option value="Necompensata">Necompensata</option>
  						<option value="Compensata(30%)">Compensata(30%)</option>
  						<option value="Compensata(50%)">Compensata(50%)</option>
  						<option value="Compensata(90%)">Compensata(90%)</option>
  						<option value="Compensata(100%)">Compensata(100%)</option>
  					</select>
    				<input type="date" id="data_elib" name="data_elib" /><br>
    				<div class="ui-widget top20">
						<input type="button" onclick="newReteta()" value="Noua" />
						<input type="button" onclick="addVanzare()" value="Vanzare" />
					</div>
			</div>
		</div>
	</div>
</div>