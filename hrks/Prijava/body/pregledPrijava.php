                    <tr align="left">
                      <td colspan="5"><strong>Pregled skupova</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="15%" align="center" valign="top">Nadnevak</td>
                      <td width="30%" align="center" valign="top">Prezime i ime</td>                      
                      <td width="43%" align="center" valign="top">Podaci</td>
                    </tr>
					<?php
						$data2 =select_prijave_skup();	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
							$DAT1=mysql2table($row[3]);
							$DAT2=mysql2table($row[4]);
						echo "
                    		<tr onmouseover=\"this.bgColor='#d4dfed'\" onMouseOut=\"this.bgColor='#FFFFFF'\" >
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"center\" valign=\"top\">$DAT1<br>$DAT2</td> 
                      		<td align=\"left\" valign=\"top\">$row[6]</td>
                      		<td align=\"left\" valign=\"top\">&nbsp;$row[5]</td>
                    		</tr>";
							$index++;
//							echo "g.add_row ('$row[date_create]' , '$row[name]' , '$br', '$row[name_en]','Bruno Trstenjak A' );";
						}
					?>
