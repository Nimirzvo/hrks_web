                    <tr align="left">
                      <td colspan="5"><strong>Pregled ostalih uplata</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="10%" align="center" valign="top">Nadnevak</td>
                      <td width="48%" align="center" valign="top">Opis uplate</td>
                      <td width="15%" align="center" valign="top">Rashod kn</td>
                      <td width="15%" align="center" valign="top">Prihod kn</td>
                    </tr>
                    
					<?php
						$data2 =select_opce_uplate_All($idSkup);	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
							$DAT1=mysql2table($row[3]);
							$rashod="";
							$prihod="";
							if($row[5]=="2")
								$rashod=$row[2];
							else
								$prihod=$row[2];
							round($rashod,2);
							round($prihod,2);
							$R=number_format($rashod, 2, ',', ' ');
							$P=number_format($prihod, 2, ',', ' ');
						echo "
                    		<tr onmouseover=\"this.bgColor='#d4dfed'\" onMouseOut=\"this.bgColor='#FFFFFF'\" >
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"center\" valign=\"top\">$DAT1</td> 
							<td align=\"left\" valign=\"top\">$row[4]</td> 
							<td align=\"right\" valign=\"top\">$R</td> 
							<td align=\"right\" valign=\"top\">$P</td> 
                    		</tr>";
							$index++;
						}
					?>
