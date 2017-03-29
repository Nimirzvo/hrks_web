                    <tr align="left">
                      <td colspan="5"><strong>Pregled autoriziranih korisnika</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="5%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="40%" align="center" valign="top">Prezime i ime</td>
                      <td width="30%" align="center" valign="top">Adresa</td>
                      <td width="20%" align="center" valign="top">Mail</td>
                    </tr>
					<?php
						$data2 =select_SveKorisnike();	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
						echo "
                    		<tr>
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"left\" valign=\"top\">$row[2] $row[1]</td> 
                      		<td align=\"left\" valign=\"top\">$row[7]</td>
							<td align=\"left\" valign=\"top\">$row[8]</td>
                    		</tr>";
							$index++;
//							echo "g.add_row ('$row[date_create]' , '$row[name]' , '$br', '$row[name_en]','Bruno Trstenjak A' );";
						}
					?>
