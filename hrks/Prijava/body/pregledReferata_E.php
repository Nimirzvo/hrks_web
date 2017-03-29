                    <tr align="left">
                      <td colspan="5"><strong>Pregled radova</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="12%" align="center" valign="top">Nadnevak</td>
                      <td width="36%" align="center" valign="top">Naziv rada</td>
                      <td width="40%" align="center" valign="top">Podaci o radu</td>
                    </tr>
					<?php
						$data2 =odredi_referatOsoba_E($idSkup);	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
							// odredimo da li postoji osoba koja je podnosilac referata
							$DAT=mysql2table($row[1]);
							$sekcija="Tjelesna i zdrastvena kultura";
							if($row[7]==2)
								$sekcija="Školski sport";
						echo "
                    		<tr>
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"center\" valign=\"top\">$DAT</td> 
							<td align=\"left\" valign=\"top\">$row[4]</td> 
							<td align=\"left\" valign=\"top\">
							Rad prijavio: $row[2] $row[3]<br>
							Autori: $row[5]<br>
							Rad prezentira: $row[6]<br>
							Sekcija: $sekcija<br>
							</td> 
                    		</tr>";
							$index++;
						}
					?>
