                    <tr class="log">
                      <td width="5%" align="center" valign="top">Izbor</td>
                      <td width="5%" align="center" valign="top">Rb.</td>
                      <td width="40%" align="center" valign="top">Naziv udruge</td>
                      <td width="20%" align="center" valign="top">Mjesto/Grad</td>                      
                      <td width="30%" align="center" valign="top">Županija</td>
                    </tr>
					<?php
						$data2 =odredi_udruge2();	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {					
						echo "
                    		<tr >
                      		<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$row[0]></td>
                      		<td align=\"center\" valign=\"top\">$index.</td>
                      		<td align=\"left\" valign=\"top\">$row[1]</td> 
                      		<td align=\"left\" valign=\"top\">$row[2]</td>
                      		<td align=\"left\" valign=\"top\">&nbsp;$row[4]</td>
                    		</tr>";
							$index++;
						}
					?>
