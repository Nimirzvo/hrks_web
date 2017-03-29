                    <tr class="log">
                      <td width="7%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="30%" align="center" valign="top">Prezime i ime</td>
                      <td width="40%" align="center" valign="top">Adresa</td>                      
                      <td width="18%" align="center" valign="top">Tel/E-mail</td>
                    </tr>                
					<?php
						$data2 =odredi_sve_Osobe();	
						$index=1;
						//<tr onmouseover=\"this.bgColor='#d4dfed'\" onMouseOut=\"this.bgColor='#FFFFFF'\" >
						while ($row = mysql_fetch_array($data2)) {
						echo "
                    		<tr class=\"tekst\" >
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td  align=\"left\" valign=\"top\">$row[2] $row[3]</td> 
                      		<td align=\"left\" valign=\"top\"> $row[6]<br>$row[7]</td>
                      		<td  align=\"left\" valign=\"top\"> Tel:$row[10]<br>E-mail:$row[12]</td>
                    		</tr>";
							$index++;
//							echo "g.add_row ('$row[date_create]' , '$row[name]' , '$br', '$row[name_en]','Bruno Trstenjak A' );";
						}
					?>