                    <tr align="left">
                      <td colspan="5"><strong>Pregled uplata sudionika skupa</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="10%" align="center" valign="top">Nadnevak</td>
                      <td width="35%" align="center" valign="top">Prezime i ime</td>
                      <td width="25%" align="center" valign="top">Opis uplate</td>
                      <td width="15%" align="center" valign="top">Prihod kn</td>
                    </tr>
					<?php
						$data2 =select_osobe_uplate_All($idSkup);	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
							//uplata.id_osoba, uplata.iznos, uplata.opis, uplata.datum, osoba.PREZIME, osoba.IME
							$DAT1=mysql2table($row[3]);
							$rashod=round($row[1],2);
							$R=number_format($rashod, 2, ',', ' ');
						echo "
                    		<tr onmouseover=\"this.bgColor='#d4dfed'\" onMouseOut=\"this.bgColor='#FFFFFF'\" >
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"center\" valign=\"top\">$DAT1</td> 
							<td align=\"left\" valign=\"top\">$row[4] $row[5]</td> 
							<td align=\"left\" valign=\"top\">$row[2]</td> 
							<td align=\"right\" valign=\"top\">$R</td> 
                    		</tr>";
							$index++;
						}
					?>
