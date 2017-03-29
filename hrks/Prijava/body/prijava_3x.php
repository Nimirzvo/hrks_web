<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="98%" border="0" cellspacing="2" cellpadding="2" class="tekst">
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst">&nbsp;</td>
            </tr>
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst"><strong>Podaci o instituciji</strong></td>
            </tr>
            <tr>
              <td width="25%" class="tekst"><div align="right">Naziv institucije:</div></td>
            <td><label>
                <input name="institucija" type="text" class="tekst" id="institucija" size="50" value="<?php echo $institucija?>">
              <input name="idSkup" type="hidden" id="idSkup" value="<?php echo $idSkup?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" class="tekst"><div align="right">Iz grada / mjesta:</div></td>
            <td><label>
                <input name="gradInsti" type="text" class="tekst" id="gradInsti" size="50" value="<?php echo $gradInsti?>">
            </label></td>
            </tr>
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst"><strong>Podaci o članstvu u udruzi / društvu kineziologa</strong></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst">Član udruge / društva:</td>
              <td align="left" class="tekst">
                <label><input type="radio" name="radio2" id="clan" value="Da" />Da</label>
                <label><input type="radio" name="radio2" id="clan" value="Ne" />Ne</label>
              </td>
            </tr>
            <tr>
              <td align="right"  class="tekst">Naziv udruge:</td>
              <td align="left"><label>
                <select name="udruga" id="udruga" class="tekst">
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
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>
              <input name="Prijava_4" type="submit" class="tekst2" id="Prijava_4" value="  << Povratak  ">                
              <input name="Prijava_5" type="submit" class="tekst2" id="Prijava_5" value="  Nastavi >>  "></td>
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
