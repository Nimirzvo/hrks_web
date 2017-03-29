                    <tr align="left">
                      <td colspan="5"><strong>Pregled informacija prijave</strong></td>
                    </tr>
            		<tr>
              	   	  <td>&nbsp;</td>
              		  <td>&nbsp;</td>
             		</tr>					
					<?php
						$data2 =odredi_prijava_osoba_skup($idSkup, $idOsoba);	// odredimo podake o prijavi
						//echo "OK-1 <br>";
						$osoba =odredi_osobuID($idOsoba); // odredimo podatke o osobi
						// prvo formiramo podatke o osobi, a nakon toga podatke o prijavi
						$index=1;
						// podaci o osobi
						while ($row = mysql_fetch_array($osoba)) {
							$ime=$row[2]." ".$row[3];
							$zupanija=odredi_naziv_zupanije($row[9]);
							$posta=odredi_naziv_poste($row[8]);
							$adresa=$row[6].", ".$row[7];
							$tel=$row[10].", ".$row[11];
							$mail=$row[12];
							$ustanova=$row[13].", ".$row[14];
						}
						// odredimo da li je osoba prezentirala rad
						$idd=odrediReferat_Osoba_Predaje($idSkup, $idOsoba);
						$prezentirao="Ne";
						if($idd==$idOsoba){
							$prezentirao="Da";
						}
						// provjerimo da li osoba ima referat
						$ref=odredi_referat_ID_2($idOsoba , $idSkup); // provjerimo da li je osoba imao referat
						$imaRef="Ne";
						if($ref!=0){
							$imaRef="Da";
							$vrsta=odredi_referat_ID_3($idOsoba , $idSkup);
							$vrstaAutora="Autor";
							if($vrsta==2)
								$vrstaAutora="Koautor";
							// odredimo naziv referata i datoteku
							$refData=select_referat_id($ref);
							$vrstaRef=""; $sekcija=""; $nazivRef=""; $datoteka="";
							while ($row = mysql_fetch_array($refData)) {
								$nazivRef=$row[1]; // naziv referata
								$datoteka=$row[3]; // naziv dokumenta
								switch($row[5]){  // odredujemo vrstu rada
									case 1: $vrstaRef="Referat"; break;
									case 2: $vrstaRef="Koreferat"; break;
									case 3: $vrstaRef="Priopcenje"; break;
								}
								switch($row[6]){  // odredujemo sekciju rada
									case 1: $sekcija="Edukacija"; break;
									case 2: $sekcija="Sport"; break;
									case 3: $sekcija="Ostale teme"; break;
								}
							}
						}
						echo "
                    		<tr >
                      		<td align=\"center\" valign=\"top\" width=\"10%\">&nbsp;</td>
                      		<td align=\"left\" valign=\"top\" colspan=\"4\">
								Prezime i ime: $ime<br>
								Adresa: $adresa<br>
								Pošta: $posta<br>
								Županija: $zupanija<br>
								Ustanova: $ustanova<br>
								Tel\Mob: $tel<br>
								E-pošta: $mail<br>
								Podnosioc priopcenja/referata: $imaRef<br>
								Naslov rada: $nazivRef <br>
								Vrsta podnosioca: $vrstaAutora <br>
								Vrsta rada: $vrstaRef <br>
								Sekcija: $sekcija <br>
								Naziv dokumenta: $datoteka <br>
							</td> 
                    		</tr>";
					?>
