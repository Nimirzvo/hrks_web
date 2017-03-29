                    <tr align="left">
                      <td colspan="5"><strong>Popis prijava</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="20%" align="center" valign="top">Prezime i ime</td>
                      <td width="40%" align="center" valign="top">Adresa</td>                      
                      <td width="28%" align="center" valign="top">Email</td>
                    </tr>
					<?php
					// fitriranje podataka
						//$data2;
						switch($radioF){
							case 0:
								$data2 =odredi_sve_Prijavljene_Osobe_Skup_E($idSkup);
								break;
							case 1:
								$data2 =odredi_sve_Prijavljene_Osobe_Skup_E_Drzava($idSkup,$drzava);
								break;
							case 2:
								$data2 =odredi_sve_Prijavljene_Osobe_Skup_E_Rad($idSkup,$rad);
								break;
							case 3:
								$data2 =odredi_sve_Prijavljene_Osobe_Skup_E_Sekcija($idSkup, $sekcija);
								break;
							case 4:
								$data2 =odredi_sve_Prijavljene_Osobe_Skup_E_Transport($idSkup);
								break;
						}
						$index=1; 
						while ($row = mysql_fetch_array($data2)) {
							// odredimo da li je osoba uplatila 
							$id=$row[0];
							$datum=mysql2table($row[2]);
							$nazivDrzave=odredi_naziv_drzave($row[10]);
							//<tr onmouseover=\"this.bgColor='#d4dfed'\" onMouseOut=\"this.bgColor='#FFFFFF'\" >
						echo "
                    		<tr >
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"left\" valign=\"top\">$row[4] $row[5]</td> 
                      		<td align=\"left\" valign=\"top\"> $row[9], $row[8] $row[7]<br>$nazivDrzave</td>
                      		<td align=\"left\" valign=\"top\"> $row[13]</td>
                    		</tr>";
							$index++;
//							echo "g.add_row ('$row[date_create]' , '$row[name]' , '$br', '$row[name_en]','Bruno Trstenjak A' );";
						}
					?>
