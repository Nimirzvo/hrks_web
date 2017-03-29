                    <tr align="left">
                      <td colspan="5"><strong>Pregled informacija prijave</strong></td>
                    </tr>
            		<tr>
              	   	  <td>&nbsp;</td>
              		  <td>&nbsp;</td>
             		</tr>					
					<?php
						$data2 =odredi_Detalje_Prijave_Skup($idSkup, $idOsoba);	
						$index=1;
						while ($row = mysql_fetch_array($data2)) {
							// odredimo da li je osoba uplatila 
							$idOsoba=$row[0];
							$nazivDrzave=odredi_naziv_drzave($row[10]);
							$nazivRada="-";
							$doc="-";
							//echo "Naziv rada :".$row[16]."<br>";
							//echo "Dokument :".$row[20]."<br>";
							if($row[15]>1){
								$nazivRada=$row[16];
								$doc=$row[20];
							}
							$rad="Samo kao sudionik (bez rada)";
							switch($row[15]){
								case 2:
									$rad="Podnosilac priopcenja – usmeno izlaganje – prvi autor";
									break;
								case 3:
									$rad="Podnosilac priopcenja – usmeno izlaganje – koautor";
									break;
								case 4:
									$rad="Podnosilac priopcenja – poster prezentacija – prvi autor ";
									break;
								case 5:
									$rad="Podnosilac priopcenja – poster prezentacija – koautor ";
									break;
							}
							$sekcija="-";
							switch($row[19]){
								case 1:
									$sekcija="Tjelesna i zdrastvena kultura ";
									break;
								case 2:
									$sekcija="Školski sport ";
									break;
							}
						echo "
                    		<tr >
                      		<td align=\"center\" valign=\"top\" width=\"10%\">&nbsp;</td>
                      		<td align=\"left\" valign=\"top\" colspan=\"4\">
								Prezime i ime: $row[4] $row[5], $row[6]<br>
								Adresa:<br> $row[9], $row[8] $row[7]<br>
								Država:$nazivDrzave<br>
								Ustanova: $row[14]<br>
								Tel: $row[11]  Fax: $row[12]<br>
								E-pošta: $row[13]<br>
								Sudjelovao na kongresu kao: $rad<br>
								Naslov rada: $nazivRada <br>
								Autori: $row[17] <br>
								Autor koji ce prezentirati rad:  $row[18] <br>
								Sekcija:  $sekcija <br>
								Naziv dokumenta: $doc <br>
							</td> 
                    		</tr>";
						}
					?>
