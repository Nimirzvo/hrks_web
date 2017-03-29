<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="bg">
            <tr>
              <td width="100">&nbsp;</td>
              <td class="tekst"><input name="Arhiva_1" onmouseover="Tip('Automatska izrada sigurnosne arhive baze podataka.')" onmouseout="UnTip()" type="submit" class="tekst2" id="Submit_" width="150px" value="     Izrada arhive     " />
                Izrada  arhive baze podataka na internetu</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="error"><?php echo $porukaBox ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="tekst"><span class="tekst">
                <input name="Arhiva_5" onmouseover="Tip('Snimanje arhive na lokalno računalo.')" onmouseout="UnTip()" type="submit" class="tekst2" id="Arhiva_5"  value=" Prebacivanje arhive" />
              </span> Prebacivanje arhive na lokalno računalo</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="error">&nbsp;</td>
            </tr>
      		<tr>
        		<td height="1" colspan="2" class="linija"><img src="../image/linija_horiz.gif" width="3" height="1"></td>
      		</tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="100">&nbsp;</td>
              <td class="tekst"><input name="Arhiva_2" onmouseover="Tip('Preuzimaneje i prijenos arhive na server.')" onmouseout="UnTip()" type="submit" class="tekst2" id="Submit_3" width="150px" value=" Preuzimanje arhive" />                
              Uvoz  arhive s lokalnog računala</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="tekst">Odabir arhive:
                <input name="file" onmouseover="Tip('Pritisnite kako biste odabrali arhivu.')" onmouseout="UnTip()" type="file" id="file" class="tekst" size="80" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="100">&nbsp;</td>
              <td class="tekst"><input name="Arhiva_7" onmouseover="Tip('Pritisnite za učitavanje arhiviranih podataka u bazu.')" onmouseout="UnTip()" type="submit" class="tekst2" id="Arhiva_7" width="150px" value="  Učitavanje arhive  " /> 
                Promjena baze na internetu s podatcima iz odabrane arhive</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="tekst">&nbsp;</td>
            </tr>
      		<tr>
        		<td height="1" colspan="2" class="linija"><img src="../../image/linija_horiz.gif" width="3" height="1"></td>
      		</tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="tekst"><input name="Arhiva_4" onmouseover="Tip('Brisanje arhive iz popisa.')" onmouseout="UnTip()" type="submit" class="tekst2" id="Arhiva_4" width="150px" value=" Brisanje arhive" /></td>
            </tr>
			<tr align="left" valign="top">
                      <td colspan="2" class="tekst"><strong><?php echo 'Pregled arhive podataka' ?></strong></td>
                    </tr>
                    <tr class="log">
                      <td width="100" align="center" valign="top"><?php echo 'Izbor' ?></td>
                      <td width="93%" align="center" valign="top" class="tekst"><?php echo 'Naziv arhive' ?></td>
                    </tr>
            </table>
            <div style="overflow:auto; height:170px;width:100%;">
                  <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="tekst">
					<?php
						$dirArray =dirList("Arhiva");	
						$index=1;
						$indexCount	= count($dirArray);
						for($x=0; $x < $indexCount; $x++) {

						echo "
                    		<tr>
							<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$dirArray[$x]></td>
                      		<td align=\"left\" valign=\"top\" class=\"tekst\">$dirArray[$x]</td> 
                    		</tr>";
							$index++;
						}
					?>
					<tr >
                      <td width="10%" align="center" valign="top">&nbsp;</td>
                      <td width="90%" align="left" valign="top">&nbsp;</td>
                    </tr>            <tr>
              <td>&nbsp;</td>
              <td class="tekst">&nbsp;</td>
            </tr>
              </table>
          </div>
          
