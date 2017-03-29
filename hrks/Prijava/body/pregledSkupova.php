<META http-equiv=Content-Type content="text/html; charset=windows-1250">

                    <tr align="left" valign="top">
                      <td colspan="4" class="tekst"><strong><?php echo $tabela_A[4] ?></strong></td>
                    </tr>
                    <tr class="log">
                      <td width="5%" align="center" valign="top" class="tekst"><?php echo $tabela_A[0] ?></td>
                      <td width="20%" align="center" valign="top" class="tekst"><?php echo $tabela_A[1] ?></td>
                      <td width="60%" align="center" valign="top" class="tekst"><?php echo $tabela_A[2] ?></td>
                      <td width="15%" align="center" valign="top" class="tekst"><?php echo $tabela_A[3] ?></td>
                    </tr>
					<?php
						$data2 =select_skupovi_HR();	
						$index=1;
						$OK=0;
						while ($row = mysql_fetch_array($data2)) {
							$OK=1;
							$DAT1=mysql2table($row[3]);
							$DAT2=mysql2table($row[4]);
						echo "
                    		<tr>
                      		<td align=\"center\" valign=\"top\" class=\"tekst\">$index.</td>
                      		<td align=\"center\" valign=\"top\" class=\"tekst\">$DAT1<br>$DAT2</td> 
                      		<td align=\"left\" valign=\"top\" class=\"tekst\"><a href=\"prijava.php?idSkup=$row[0]\" class=\"crni_link\">$row[6]<br>Prijava ...</a></td>
                      		<td align=\"left\" valign=\"top\" class=\"tekst\">&nbsp;$row[5]</td>
                    		</tr>";
							$index++;
						}
						if($OK==0){
							echo "
                    		<tr >
                      		<td align=\"center\" valign=\"top\" class=\"tekst\">&nbsp;</td>
                      		<td align=\"center\" valign=\"top\" class=\"tekst\">&nbsp;</td> 
                      		<td align=\"left\" valign=\"top\" class=\"tekst\">&nbsp;</td>
                      		<td align=\"left\" valign=\"top\" class=\"tekst\">&nbsp;$row[5]</td>
                    		</tr>";
							echo "
                    		<tr>
                      		<td align=\"center\" valign=\"top\" class=\"tekst\">&nbsp;</td>
                      		<td align=\"center\" valign=\"top\" class=\"tekst\">&nbsp;</td> 
                      		<td align=\"left\" valign=\"top\" class=\"tekst\">Prijava sudjelovanja se više ne može izvršiti – ona će se moći izvršiti u Poreču!</td>
                      		<td align=\"left\" valign=\"top\" class=\"tekst\">&nbsp;$row[5]</td>
                    		</tr>";
						}
					?>
					<tr >
                      <td width="5%" align="center" valign="top">&nbsp;</td>
                      <td width="20%" align="left" valign="top">&nbsp;</td>
                      <td width="60%" align="left" valign="top">&nbsp;</td>
                      <td width="15%" align="left" valign="top">&nbsp;</td>
                    </tr>