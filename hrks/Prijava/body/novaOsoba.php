<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="98%" border="0" cellspacing="0" cellpadding="2" class="tekst">
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst">&nbsp;</td>
            </tr>
            <tr>
              <td class="tekst_S">&nbsp;</td>
              <td align="left" valign="top" class="tekst_L"><strong>Podaci o kineziologu</strong></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Ime:</div></td>
            <td align="left"><label>
              <input name="ime" type="text" class="tekst" id="ime" size="30" value="<?php echo $ime?>">
              <input name="idOsoba" type="hidden" id="idOsoba" value="<?php echo $idOsoba?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Prezime:</div></td>
            <td align="left"><label>
                <input name="prezime" type="text" class="tekst" id="prezime" size="30" value="<?php echo $prezime?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Nadnevak rođenja:</div></td>
            <td align="left"><label>
                <input name="nadnevak" type="text" class="tekst" id="nadnevak" value="<?php echo $nadnevak?>" size="12" readonly="readonly">
                <a href="#" onClick="setYears(1930, 2010);showCalender(this, 'nadnevak');"><img src="css/calendar.png" onmouseover="Tip('Izaberi nadnevak')" onmouseout="UnTip()" border="0" height="16" width="16"></a>
            </label></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_S">Spol:</td>
              <td align="left" class="tekst">
                <label><input type="radio" name="radio" id="radio" value="1" <?php echo $check_M?>/>Muški</label>
                <label><input type="radio" name="radio" id="radio" value="2" <?php echo $check_Z?>/>Ženski</label>
              </td>
            </tr>
            <tr>
              <td align="right"  class="tekst_S">Titula:</td>
              <td align="left"><label>
                <select name="titula" id="titula" class="tekst">
                <?php
						echo "<option value=\"0\">\" - \"</option>";
						$data =odredi_titule();	
						// provjera da li dodajemo ili obnavljamo podatke
						if($idTitula==0){
							while ($row = mysql_fetch_array($data)) {
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
						}
						else{ // edit
						while ($row = mysql_fetch_array($data)) {
							if($idTitula!=$row[0]){
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
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst_L"><strong>Adresa</strong></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Ulica:</div></td>
            <td align="left" valign="top"><label>
                <input name="ulica" type="text" class="tekst" id="ulica" size="45" value="<?php echo $ulica?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Grad/Mjesto:</div></td>
            <td align="left" valign="top"><label>
                <input name="grad" type="text" class="tekst" id="grad" size="40" value="<?php echo $grad?>">
            </label></td>
            </tr>
            <tr>
              <td align="right"  class="tekst_S">Pošta i broj:</td>
              <td align="left"><label>
                <select name="idPosta" id="idPosta" class="tekst">
                <?php
						echo "<option value=\"0\">\" - \"</option>";
						$data =odredi_poste();	
						// provjera da li dodajemo ili obnavljamo podatke
						if($idPosta==0){
							while ($row = mysql_fetch_array($data)) {
								echo "<option value=\"$row[0]\">$row[2] $row[1]</option>";
							}
						}
						else{ // edit
						while ($row = mysql_fetch_array($data)) {
							if($idPosta!=$row[0]){
								echo "<option value=\"$row[0]\">$row[2] $row[1]</option>";
							}
							else{
								echo "<option value=\"$row[0]\" selected=\"selected\">$row[2] $row[1]</option>";
								
							}
						}
						}
				?>
                </select>
              </label></td>
            </tr>
            <tr>
              <td align="right"  class="tekst_S">Županija:</td>
              <td align="left"><label>
                <select name="zupanija" id="zupanija" class="tekst">
                <?php
						echo "<option value=\"0\">\" - \"</option>";
						$data =odredi_zupanije();	
						// provjera da li dodajemo ili obnavljamo podatke
						if($idZupanija==0){
							while ($row = mysql_fetch_array($data)) {
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
						}
						else{ // edit
						while ($row = mysql_fetch_array($data)) {
							if($idZupanija!=$row[0]){
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
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">Kontakt telefon:</div></td>
            <td align="left" valign="top"><label>
                <input name="telefon" type="text" class="tekst" id="telefon" size="25" value="<?php echo $telefon?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">E-mail adresa:</div></td>
            <td align="left" valign="top"><label>
                <input name="email" type="text" class="tekst" id="email" size="40" value="<?php echo $email?>">
            </label></td>
            </tr>
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst_L"><strong>Podaci o instituciji</strong></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">Naziv institucije:</div></td>
            <td align="left" valign="top"><label>
                <input name="institucija" type="text" class="tekst" id="institucija" size="50" value="<?php echo $institucija?>">
              <input name="idSkup" type="hidden" id="idSkup" value="<?php echo $idSkup?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">Iz grada / mjesta:</div></td>
            <td align="left" valign="top"><label>
                <input name="gradInsti" type="text" class="tekst" id="gradInsti" size="50" value="<?php echo $gradInsti?>">
            </label></td>
            </tr>
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst_L"><strong>Podaci o članstvu u udruzi / društvu kineziologa</strong></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_S">Član udruge / društva:</td>
              <td align="left" class="tekst">
                <label><input type="radio" name="radio2" id="radio2" value="1" <?php echo $check_1?>  onClick="provjera(1);" />Da</label>
                <label><input type="radio" name="radio2" id="radio2" value="0" <?php echo $check_2?>  onClick="provjera(2);" />Ne</label>
              </td>
            </tr>
            <tr>
              <td align="right"  class="tekst_S">Naziv udruge:</td>
              <td align="left"><label>
                <select name="udruga" id="udruga" class="tekst" disabled="<?php echo $disable?>">
                <?php
						echo "<option value=\"0\">\" - \"</option>";
						$data =odredi_udruge();	
						// provjera da li dodajemo ili obnavljamo podatke
						if($idUdruga==0){
							while ($row = mysql_fetch_array($data)) {
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
						}
						else{ // edit
						while ($row = mysql_fetch_array($data)) {
							if($idUdruga!=$row[0]){
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
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">Napomena:</div></td>
            <td align="left"><label>
              <textarea name="napomena" cols="60" rows="3" class="tekst" id="napomena"><?php echo $napomena?></textarea>
            </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top">&nbsp;</td>
              <td align="left"><input name="Novi" type="submit" class="tekst2" id="Novi" value="  Potvrdi  ">&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
    <!-- Calender Script  --> 

<table id="calenderTable">
        <tbody id="calenderTableHead">
          <tr>
            <td colspan="4" align="center">
	          <select onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value,
	           this.selectedIndex, false));" id="selectMonth">
	              <option value="0">Jan</option>
	              <option value="1">Feb</option>
	              <option value="2">Mar</option>
	              <option value="3">Apr</option>
	              <option value="4">Maj</option>
	              <option value="5">Jun</option>
	              <option value="6">Jul</option>
	              <option value="7">Aug</option>
	              <option value="8">Sep</option>
	              <option value="9">Okt</option>
	              <option value="10">Nov</option>
	              <option value="11">Dec</option>
	          </select>
            </td>
            <td colspan="2" align="center">
			    <select onChange="showCalenderBody(createCalender(this.value, 
				document.getElementById('selectMonth').selectedIndex, false));" id="selectYear">
				</select>
			</td>
            <td align="center">
			    <a href="#" onClick="closeCalender();"><font color="#003333" size="+1">x</font></a>
			</td>
		  </tr>
       </tbody>
       <tbody id="calenderTableDays">
         <tr style="">
           <td>Ned</td><td>Pon</td><td>Uto</td><td>Sri</td><td>Cet</td><td>Pet</td><td>Sub</td>
         </tr>
       </tbody>
       <tbody id="calender"></tbody>
    </table>

<!-- End Calender Script  --> 



