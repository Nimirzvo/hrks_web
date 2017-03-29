<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="98%" border="0" cellspacing="0" cellpadding="2" class="tekst">
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst">&nbsp;</td>
            </tr>
            <tr>
              <td class="tekst_S">&nbsp;</td>
              <td align="left" valign="top" class="tekst_L"><strong>Podaci o udruzi</strong></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Naziv:</div></td>
            <td><label>
              <input name="ime" type="text" class="tekst" id="ime" size="70" value="<?php echo $ime?>">
              <input name="idUdruga" type="hidden" id="idUdruga" value="<?php echo $idUdruga?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Grad/Mjesto:</div></td>
            <td align="left" valign="top"><label>
                <input name="grad" type="text" class="tekst" id="grad" size="50" value="<?php echo $grad?>">
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
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top">&nbsp;</td>
              <td><input name="Novi" type="submit" class="tekst2" id="Novi" value="  Potvrdi  ">&nbsp;&nbsp;&nbsp;</td>
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