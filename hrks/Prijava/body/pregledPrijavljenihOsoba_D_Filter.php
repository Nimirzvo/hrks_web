                    <tr align="left">
                      <td colspan="5"><strong>Popis prijava</strong></td>
                    </tr>
                    
					<?php
					if($radioF!=3){
						echo "
						<tr class=\"log\">
                      <td width=\"7%\"align=\"center\" valign=\"top\">Izbor</td>
                      <td width=\"5%\" align=\"center\" valign=\"top\">Rb.</td>
                      <td width=\"20%\" align=\"centerv valign=\"top\">Prezime i ime</td>
                      <td width=\"40%\" align=\"centerv valign=\"top\">Adresa</td>                      
                      <td width=\"28%\" align=\"center\" valign=\"top\">E-pošta</td>
                    </tr>";
					}
					else{
					 echo "
						<tr class=\"log\">
                      <td width=\"5%\" align=\"center\" valign=\"top\">Rb.</td>
                      <td width=\"50%\" align=\"centerv valign=\"top\">Naziv rada</td>
                      <td width=\"38%\" align=\"centerv valign=\"top\">Autor</td>                      
                    </tr>";

					}
					// fitriranje podataka
						//$data2;
						switch($radioF){
							case 0:
								$data2 =odredi_sve_Prijavljene_Osobe_Skup($idSkup);	
								break;
							case 1:
								$data2 =odredi_sve_Prijavljene_Osobe_Skup_D_Ustanova($idSkup,$skola);
								break;
							case 2:
								$data2 =odredi_sve_Prijavljene_Osobe_Skup($idSkup);	
								//$data2 =odredi_sve_Prijavljene_Osobe_Skup_D_Rad($idSkup,$rad);
								break;
							case 3:
								$data2 =odredi_sve_Referata($idSkup); // odredimo sve referate na seminaru
								break;
						}
						$index=1; 
						while ($row = mysql_fetch_array($data2)) { //odredi_sve_Prijavljene_Osoba_Referat
							// odredimo da li je osoba uplatila 
							$OK=true;
							$idOsoba=0;
							$nazivReferata="";
							$idRef=0;
							if($radioF!=3){
							 $idOsoba=$row[0];
							}
							else{
								$idRef=$row[0];
								$nazivReferata=$row[1];
							}
							$prazno=true;
							if($radioF==2){ // dodatna provjera
							  $dataRef=odredi_sve_Prijavljene_Osoba_Referat($idSkup, $idOsoba);  // podatci o referatu
							  $brojac=0;
							  //echo " 2. while <br>";
							  while ($rowR = mysql_fetch_array($dataRef)){
								  //echo " 2B. while <br>";
								  $prazno=false;
								 $idd=$rowR[0];
								 $brojac++;
								 if($idd!=$idOsoba){
									$OK=false;
								 }
								 else{
									 $idRef=$rowR[1];
									 if($brojac==1)
									 	$nazivReferata=$rowR[2];
									 else
									 	$nazivReferata.=", ".$rowR[2];
									 
								 }

							  }
							  //echo " SUDJELOVANJE - $rad <br>";
							   //echo " NAZIV RAda - $nazivReferata <br>";
							  switch($rad){
								case 0: //svi sudionici								
									$OK=true;
									break;
								case 1: // koji imaju radove
								    if($prazno) //znaci da nema rada
										$OK=false;
									break;
								case 2: // koji nemaju radove								
									if(!$prazno) //znaci da ima rada
										$OK=false;
									break;
								}							  
							}
							elseif($radioF==3){ // pregled radova da li su prezentirani ili ne
								$idd=0;
								
								switch($sekcija){
								case 1: //svi referati		
									$idd=odrediReferat_Osoba2($idSkup, $idRef);
									$OK=true;
									break;
								case 2: // radovi koji se prezentiraju
									$idd=odrediReferat_Osoba_Predaje2($idSkup, $idRef);
								    if($idd<=0) 
										$OK=false;
									break;
								case 3: // radovi koji se ne prezentiraju								
									$idd=odrediReferat_Osoba_Predaje2($idSkup, $idRef);
								    if($idd>0) 
										$OK=false;
									else // odredimo autor referat
										$idd=odrediReferat_Osoba2($idSkup, $idRef);
									break;
								}	
							}
							if(!$OK)
							   continue;
							if($radioF==3){ // pregled radova
							  $imeAutora=odredi_naziv__osobuID($idd);
							  echo "
									<tr >
									<td align=\"center\" valign=\"top\">$index.</td>
									<td align=\"left\" valign=\"top\">$nazivReferata</td> 
									<td align=\"left\" valign=\"top\"> $imeAutora</td>
									</tr>";
							}
							else{
								$datum=mysql2table($row[2]);
								$nazivDrzave=odredi_naziv_drzave($row[10]);
								echo "
									<tr >
									<td align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"box[]\" value=$idOsoba></td>
									<td align=\"center\" valign=\"top\">$index.</td>
									<td align=\"left\" valign=\"top\">$row[2] $row[3]</td> 
									<td align=\"left\" valign=\"top\"> $row[6]<br>$row[7]</td>
									<td align=\"left\" valign=\"top\"> $row[12]</td>
									</tr>";
									}
							$index++;
//							echo "g.add_row ('$row[date_create]' , '$row[name]' , '$br', '$row[name_en]','Bruno Trstenjak A' );";
						}
					?>
