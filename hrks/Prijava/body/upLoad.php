

          <table width="98%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="25%" ><div align="right">Naziv:</div></td>
            <td><label>
                <input name="naziv" type="text" class="tekst" id="naziv" size="60" value="<?php echo $naziv?>">
              </label></td>
            </tr>
            <tr>
              <td ><div align="right">Odabrana datoteka:</div></td>
              <td><?php echo $nameFile?>
              <input type="hidden" name="file" id="hiddenField">
              <input name="edit" type="hidden" id="edit" value="<?php echo $edit?>">
              <input name="idS" type="hidden" id="idS" value="<?php echo $idSadrzaja?>">
              </td>
            </tr>
            <tr>
              <td ><div align="right"> Datoteka / dokument:</div></td>
            <td><label>
                <input name="file" type="file" id="file" class="tekst2" size="80
                " />
              </label></td>
            </tr>
            <tr>
              <td valign="top" ><div align="right">Kratki opis:</div></td>
            <td><label>
              <textarea name="tekst" cols="80" rows="10" class="tekst" id="tekst"><?php echo $obavijest?></textarea >
              </label></td>
            </tr>
            <tr>
              <td align="right" ><div align="right">Kategorija</div></td>
              <td align="left"><label>
                <select name="kat" id="kat" class="tekst">
                <?php
						$data =odrediKategorija();	
						// provjera da li dodajemo ili obnavljamo podatke
						if($izbor!=3){
							while ($row = mysql_fetch_array($data)) {
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
						}
						else{ // edit
						while ($row = mysql_fetch_array($data)) {
							if($idKriterij!=$row[0]){
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
							else{
								echo "<option value=\"$row[0]\" selected=\"selected\">$row[1]</option>";
								
							}
						}
						}
				?>
                </select>
              </label></td>
            </tr>
            <tr>
              <td align="right" >Vrsta:</td>
              <td align="left"><label>
                <select name="vrsta" id="vrsta" class="tekst">
                <?php
						$data =odrediVrstu();	
						// provjera da li dodajemo ili obnavljamo podatke
						if($izbor!=3){
							while ($row = mysql_fetch_array($data)) {
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
						}
						else{ // edit
						while ($row = mysql_fetch_array($data)) {
							if($idVrsta!=$row[0]){
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
							else{
								echo "<option value=\"$row[0]\" selected=\"selected\">$row[1]</option>";
								
							}
						}
						}
				?>
                </select>
              </label></td>
            </tr>
            <tr>
              <td align="right" >Zabrana sadržaja:</td>
              <td align="left"><label>
                <?php
				// provjera da li korisnik ima prava mijenjati zabranu
						$korisnik=tipUser($_SESSION['userId']);
						if($korisnik!=1 && $korisnik!=2)
							echo "<select name=\"zabrana\" id=\"zabrana\" class=\"tekst\" disabled=\"$disable\">";
						else
							echo "<select name=\"zabrana\" id=\"zabrana\" class=\"tekst\" >";
						// provjera da li dodajemo ili obnavljamo podatke
						if($izbor!=3){
							echo "<option value=\"Ne\">Ne</option>";
							echo "<option value=\"Da\">Da</option>";	
						}
						else{ // edit
							if($zabrana=="Da"){
								echo "<option value=\"Ne\">Ne</option>";
								echo "<option value=\"Da\" selected=\"selected\">Da</option>";
							}
							else{
								echo "<option value=\"Ne\" selected=\"selected\">Ne</option>";
								echo "<option value=\"Da\" >Da</option>";
							}
						}
				?>
                </select>
              </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="UpLoad" type="submit" class="tekst2" id="UpLoad" value="  Potvrdi unos  ">                
              <input name="Cancel" type="reset" class="tekst2" id="Cancel" value=" Obriši upisano ">
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>



