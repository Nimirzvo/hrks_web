                    <tr align="left">
                      <td colspan="5"><strong>Popis prijava</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="30%" align="center" valign="top">Prezime i ime</td>
                      <td width="30%" align="center" valign="top">Adresa</td>                      
                      <td width="28%" align="center" valign="top">E-pošta</td>
                    </tr>
					<?php
						$data2 =odredi_sve_Prijavljene_Osobe_Skup($idSkup);	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
							// odredimo da li je osoba uplatila 
							$idOsoba=$row[0];
							// $dataUplata=select_uplata_id($idSkup, $idOsoba);
							// $uplataOpis="Uplata:  -  ";							
							/* while ($row2 = mysql_fetch_array($dataUplata)) {
								if($row2[0]>0){
									$upl=zamjena_tocka_zarez($row2[2]); // mijenjamo tocku za zarez
									round($upl,2);
									$U=number_format($upl, 2, ',', ' ');
									// uplata postoji
									$uplataOpis="Iznos uplate: $U kn<br>";
									$dat=table2mysql($row2[4]);
									$uplataOpis.="Nadnevak: $dat <br>";
								}
							}
							*/
							//<tr onmouseover=\"this.bgColor='#d4dfed'\" onMouseOut=\"this.bgColor='#FFFFFF'\" >
						echo "
                    		<tr >
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$idOsoba></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"left\" valign=\"top\">$row[2] $row[3]</td> 
                      		<td align=\"left\" valign=\"top\"> $row[6]<br>$row[7]</td>
                      		<td align=\"left\" valign=\"top\"> $row[12]</td>
                    		</tr>";
							$index++;
//							echo "g.add_row ('$row[date_create]' , '$row[name]' , '$br', '$row[name_en]','Bruno Trstenjak A' );";
						}
					?>
