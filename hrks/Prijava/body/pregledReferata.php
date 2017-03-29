                    <tr align="left">
                      <td colspan="3"><strong>Pregled radova</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="50%" align="center" valign="top">Naziv rada</td>
                      <td width="30%" align="center" valign="top">Podnosilac</td>
                    </tr>
					<?php
						$data2 =odredi_sve_Referata($idSkup);	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
							// odredimo da li postoji osoba koja je podnosilac referata
							$idRef=$row[0];
							$idOsoba=odredi_referatOsoba_Provodi($idSkup,$idRef,1);
							$prezentira="Ne";
							$prezime_ime="";
							if($idOsoba!=0){
								// odredimo ime i prezime osobe
								$prezime_ime=odredi_naziv__osobuID($idOsoba);
								$idOsoba2=odrediReferat_Osoba_Predaje($idSkup,$idOsoba);
								if($idOsoba2!=0)
									$prezentira="Da";
							}
							
						echo "
                    		<tr>
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"left\" valign=\"top\">$row[1]</td> 
							<td align=\"left\" valign=\"top\">$prezime_ime<br>Prezentira:$prezentira</td> 
                    		</tr>";
							$index++;
						}
					?>
