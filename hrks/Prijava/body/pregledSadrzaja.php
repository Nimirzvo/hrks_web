                    <tr align="left">
                      <td colspan="5"><strong>Pregled multimedijskih sadržaja</strong></td>
                    </tr>
                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="20%" align="center" valign="top">Naziv</td>
                      <td width="30%" align="center" valign="top">Svojstva</td>
                      <td width="38%" align="center" valign="top">Opis</td>
                    </tr>
					<?php
						$data2 =select_sadrzaj();	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
						echo "
                    		<tr onmouseover=\"this.bgColor='#d4dfed'\" onMouseOut=\"this.bgColor='#FFFFFF'\" >
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"left\" valign=\"top\">$row[1]</td> 
                      		<td align=\"left\" valign=\"top\">Vrsta :$row[9]<br>Kategorija :$row[10]<br>Vlasnik :$row[11] $row[12]<br>Velicina :$row[6] kB<br>Broj preuzimanja :$row[7]</td>
                      		<td align=\"left\" valign=\"top\">$row[2]</td>
                    		</tr>";
							$index++;
//							echo "g.add_row ('$row[date_create]' , '$row[name]' , '$br', '$row[name_en]','Bruno Trstenjak A' );";
						}
					?>
