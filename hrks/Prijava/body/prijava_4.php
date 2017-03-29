<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="98%" border="0" cellspacing="2" cellpadding="2" class="tekst">
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst">&nbsp;</td>
            </tr>
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst"><strong>Podaci o podnosiocu priopčenja / referata</strong></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst">Podnosilac priopčenja/referata:</td>
              <td align="left" class="tekst">
                <label><input type="radio" name="radio3" id="clan" value="Da" />Da</label>
                <label><input type="radio" name="radio3" id="clan" value="Ne" />Ne</label>
              </td>
            </tr>
            <tr>
              <td width="25%" class="tekst"><div align="right">Prvi autor:</div></td>
            <td><label>
              <input type="checkbox" name="checkbox1" id="checkbox1" />
              <input name="idSkup" type="hidden" id="idSkup" value="<?php echo $idSkup?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" class="tekst"><div align="right">Naziv rada:</div></td>
            <td><label>
                <input name="rad" type="text" class="tekst" id="rad" size="65" value="<?php echo $rad?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" class="tekst"><div align="right">Koautor:</div></td>
            <td><label>
              <input type="checkbox" name="checkbox2" id="checkbox2" />
              <input name="idSkup" type="hidden" id="idSkup" value="<?php echo $idSkup?>" />
            </label></td>
            </tr>
            <tr>
              <td align="right"  class="tekst">Naziv priopčenja/referata:</td>
              <td align="left"><label>
                <select name="refer" id="refer" class="tekst">
                <?php
						echo "<option value=\"0\">\" - \"</option>";
						$data =odredi_referate();	
						// provjera da li dodajemo ili obnavljamo podatke
						if($idReferat==0){
							while ($row = mysql_fetch_array($data)) {
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
						}
						else{ // edit
						while ($row = mysql_fetch_array($data)) {
							if($idReferat!=$row[0]){
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
              <td width="25%" class="tekst"><div align="right">Naziv priopčenja/referata:</div></td>
            <td><label>
                <input name="radKo" type="text" class="tekst" id="radKo" size="65" value="<?php echo $radKo?>">
            </label></td>
            </tr>
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst">Na skupu ću javno prezentirati priopčenje/referat</td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst">&nbsp;</td>
              <td align="left" class="tekst">
                <label><input type="radio" name="radio4" id="clan" value="Da" />Da</label>
                <label><input type="radio" name="radio4" id="clan" value="Ne" />Ne</label>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>
              <input name="Prijava_7" type="submit" class="tekst2" id="Prijava_7" value="  << Povratak  ">                
              <input name="Prijava_6" type="submit" class="tekst2" id="Prijava_6" value=" Potvrdi prijavu ">                
              </td>
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
