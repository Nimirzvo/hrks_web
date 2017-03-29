<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="98%" border="0" cellspacing="0" cellpadding="2" class="tekst">
            <tr>
              <td width="30%" class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst_C"><?php echo $error ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="left" valign="top" ><strong>Registration and paper submission<br />
                Prijava sudjelovanja i predaja radova<br />
              </strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="left">Fields marked with * are obligatory. / Polja označena *obvezno ispuniti. </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold">Ms / Mr:<br />Spol:</td>
              <td align="left" valign="top" class="tekst">
                <label><input type="radio" name="radio" id="radio" value="2" <?php echo $check_Z?>/>Ms / ženski</label>
                <label><input type="radio" name="radio" id="radio" value="1" <?php echo $check_M?>/>Mr / muški</label>
              <span class="tekst_C">*</span></td>
            </tr>
            <tr>
              <td  align="right" class="tekst_Bold">Family Name:<br />Prezime:</td>
            <td align="left" valign="top"><label class="tekst_C">
              <input name="prezime" type="text" class="tekst" id="prezime" size="60" value="<?php echo $prezime?>">
              *
              <input name="idSkup" type="hidden" id="idSkup" value="<?php echo $idSkup?>" />
              <input name="idPrijave" type="hidden" id="idPrijave" value="<?php echo $idPrijave?>" />
            </label></td>
            </tr>
            <tr>
              <td  align="right" class="tekst_Bold">Name:<br />Ime:</td>
          <td align="left" valign="top"><label  class="tekst_C">
                <input name="ime" type="text" class="tekst" id="ime" size="50" value="<?php echo $ime?>">
            *</label></td>
            </tr>
            <tr>
              <td align="right"  class="tekst_Bold">Full Academic Title:<br />Akademska titula:</td>
              <td align="left" valign="top">
              <label>
                <input name="titula" type="text" class="tekst" id="titula" size="50" value="<?php echo $titula?>">
            </label>
              </td>
            </tr>
            <tr>
              <td align="right" class="tekst_Bold">City:<br />Grad / mjesto:</td>
          	  <td align="left" valign="top"><label class="tekst_C">
                <input name="grad" type="text" class="tekst" id="grad" size="40" value="<?php echo $grad?>">
             *</label></td>
            </tr>
            <tr>
              	<td align="right" class="tekst_Bold">Postal Code:<br />Poštanski broj:</td>
          		<td align="left" valign="top"><label class="tekst_C">
                <input name="posta" type="text" class="tekst" id="posta" size="30" value="<?php echo $posta?>">
             *</label></td>
            </tr>
            <tr>
              	<td align="right" class="tekst_Bold">Street:<br />Ulica:</td>
          		<td align="left" valign="top"><label class="tekst_C">
                <input name="ulica" type="text" class="tekst" id="ulica" size="60" value="<?php echo $ulica?>">
             *</label></td>
            </tr>
            <tr>
              <td align="right"  class="tekst_Bold">State:<br />Država:</td>
              <td align="left" valign="top"><label class="tekst_C">
                <select name="idDrzava" id="idDrzava" class="tekst">
                <?php
						echo "<option value=\"0\">\" - \"</option>";
						$data =odredi_drzave();	
						// provjera da li dodajemo ili obnavljamo podatke
						if($idDrzava==0){
							while ($row = mysql_fetch_array($data)) {
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
						}
						else{ // edit
						while ($row = mysql_fetch_array($data)) {
							if($idDrzava!=$row[0]){
								echo "<option value=\"$row[0]\">$row[1]</option>";
							}
							else{
								echo "<option value=\"$row[0]\" selected=\"selected\">$row[1]</option>";
								
							}
						}
						}
				?>
                </select>
              *</label></td>
            </tr>
            <tr>
              	<td align="right" class="tekst_Bold">Phone/Mobile Phone:<br />Telefon ili mobitel:</td>
          		<td align="left" valign="top"><label class="tekst_C">
                <input name="tel" type="text" class="tekst" id="tel" size="20" value="<?php echo $tel?>">
             *</label></td>
            </tr>
            <tr>
              	<td align="right" class="tekst_Bold">Fax:<br />&nbsp;</td>
          		<td align="left" valign="top"><label class="tekst_C">
                <input name="fax" type="text" class="tekst" id="fax" size="20" value="<?php echo $fax?>">
             </label></td>
            </tr>
            <tr>
              	<td align="right" class="tekst_Bold">E-mail:<br />E-pošta:</td>
          		<td align="left" valign="top"><label class="tekst_C">
                <input name="email" type="text" class="tekst" id="email" size="40" value="<?php echo $email?>">
             *</label></td>
            </tr>
            <tr>
              <td align="right"  class="tekst_Bold">Affiliation (University/Institution):<br />Ustanova / organizacija:</td>
              <td align="left" valign="top">
              <label>
                <input name="institucija" type="text" class="tekst" id="institucija" size="60" value="<?php echo $institucija?>">
            </label>
              </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold" ><label>Transport / Prijevoz:&nbsp;&nbsp;</label><input name="checkbox1" type="checkbox" id="checkbox1"  <?php echo $check_T?>/></td>
              <td align="left" class="tekst">
                <label>
                Provide the transport with a bus from the Zagreb airport to Poreč.<br />Osigurati prijevoz s autobusom iz zagrebačke zračne luke do Poreča.</label>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"  align="left" class="tekst"><strong>I would  like to attend the Congress:</strong> (please choose one)
              <br /><strong>Sudjelovat ću na kongresu</strong> <strong>kao:</strong>(odaberite  jednu od predloženih mogućnosti)</td>
          </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold">
              <input type="radio" name="radio3" id="radio3" onClick="provjera(1);" value="1" <?php echo $check_ref_1?>/>
              </td>
              <td align="left" class="tekst">
                <label>
                As a  participant (no paper)<br />Samo kao sudionik (bez rada)</label>
              </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold">
              <input name="radio3" type="radio" id="radio3" onClick="provjera(2);" value="2" <?php echo $check_ref_2?>/>
              </td>
              <td align="left" class="tekst">
                <label>              
                Paper submission - podium presentation - 1st Author<br />Podnosilac priopćenja – usmeno izlaganje – prvi autor</label>
              </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold">
              <input name="radio3" type="radio" id="radio3" onClick="provjera(3);" value="3" <?php echo $check_ref_3?>/>
              </td>
              <td align="left" class="tekst">
                <label>              
                Paper submission - podium presentation - Other Authors<br />Podnosilac priopćenja – usmeno izlaganje – koautor</label>
              </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold">
              <input name="radio3" type="radio" id="radio3" onClick="provjera(4);" value="4" <?php echo $check_ref_4?>/>
              </td>
              <td align="left" class="tekst">
                <label>              
                Paper submission - poster presentation - 1st Author<br />Podnosilac priopćenja – poster prezentacija – prvi autor</label>
              </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold">
              <input name="radio3" type="radio" id="radio3" onClick="provjera(5);" value="3" <?php echo $check_ref_5?>/>
              </td>
              <td align="left" class="tekst">
                <label>              
                Paper submission - poster presentation - Other Authors<br />Podnosilac priopćenja – poster prezentacija – koautor</label>
              </td>
            </tr>
      		<tr>
        		<td height="1" colspan="2" class="linija"><img src="image/linija_horiz.gif" width="3" height="1"></td>
      		</tr>
            <tr>
              <td colspan="2"  align="left" class="tekst_Sivi">If you have chosen Paper submission - podium presentation or Paper submission - poster presentation, You have to fill in the following fields.
              <br />Ukoliko ste odabrali: "Podnosilac priopćenja – usmeno izlaganje" ili "Podnosilac priopćenja – poster prezentacija", trebate ispuniti i preostala polja.</td>
          </tr>
            <tr>
              <td align="right" valign="top"  class="tekst_Bold">Paper Title:<br />Naslov rada:</td>
              <td align="left">
              <label>
                <textarea name="papir" cols="60" rows="3" disabled="disabled" class="tekst" id="papir"><?php echo $papir?></textarea>
              </label>
              </td>
            </tr>
            <tr>
              <td align="right" valign="top"  class="tekst_Bold">Author(s):<br />Autori:</td>
              <td align="left"><label>
                <textarea name="autor" cols="60" rows="3" disabled="disabled" class="tekst" id="autor"><?php echo $autor?></textarea>
              </label></td>
            </tr>
            <tr>
           	  <td align="right" class="tekst_Bold">Presenting author:<br />Autor koji će prezentirati rad:</td>
          		<td align="left" valign="middle"><label class="tekst_C">
                <input name="autor2" type="text" disabled="disabled" class="tekst" id="autor2" value="<?php echo $autor2?>" size="60">
             </label></td>
            </tr>
      		<tr>
        		<td height="1" colspan="2" class="linija"><img src="image/linija_horiz.gif" width="3" height="1"></td>
      		</tr>
            <tr>
              <td colspan="2"  align="left" class="tekst_Sivi">Choose one section that your paper is related to:
              <br />Odaberite sekciju na koju se vaš rad odnosi:
              </td>
          </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold"><input type="radio" name="radio2" id="radio2" value="1" disabled="disabled" <?php echo $check_sec_1?>/></td>
              <td align="left" class="tekst">
                <label>
                Physical education <br />Tjelesna i zdrastvena kultura</label>
              </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_Bold">
              <input name="radio2" type="radio" id="radio2"  value="2" disabled="disabled" <?php echo $check_sec_2?>/>
              </td>
              <td align="left" class="tekst">
                <label>              
                School sport<br />Školski sport</label>
              </td>
            </tr>


            <tr>
              <td align="right" class="tekst_Bold">Selection paper:<br />Odabir priopćenja:</td>
            <td align="left"><label>
              <input name="file" onmouseover="Tip('Selecting Document')" onmouseout="UnTip()" type="file" id="file" disabled="disabled" class="tekst" size="60" />
            </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top">&nbsp;</td>
              <td><input name="Prijava" type="submit" class="tekst2" id="Prijava" value="Submit registration / Potvrda prijave"></td>
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