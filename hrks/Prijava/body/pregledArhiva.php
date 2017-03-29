                    <tr align="left" valign="top">
                      <td colspan="2" class="tekst"><strong><?php echo 'Pregled izradene arhive podataka' ?></strong></td>
                    </tr>
                    <tr class="log">
                      <td width="10%" align="center" valign="top" class="tekst"><?php echo 'Rb.' ?></td>
                      <td width="90%" align="center" valign="top" class="tekst"><?php echo 'Naziv arhive' ?></td>
                    </tr>
					<?php
						$dirArray =dirList("Arhiva");	
						$index=1;
						$indexCount	= count($dirArray);
						for($x=0; $x < $indexCount; $x++) {

						echo "
                    		<tr onmouseover=\"this.bgColor='#d4dfed'\" onMouseOut=\"this.bgColor='#FFFFFF'\" >
                      		<td align=\"center\" valign=\"top\" class=\"tekst\">$index.</td>
                      		<td align=\"left\" valign=\"top\" class=\"tekst\">$dirArray[$x]</td> 
                    		</tr>";
							$index++;
						}
					?>
					<tr >
                      <td width="10%" align="center" valign="top">&nbsp;</td>
                      <td width="90%" align="left" valign="top">&nbsp;</td>
                    </tr>