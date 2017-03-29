<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="98%" border="0" cellspacing="0" cellpadding="2" >
            <tr>
              <td colspan="2" class="tekst">&nbsp;</td>
            </tr>
            <tr>
              <td width="10%" class="tekst"><div align="right">&nbsp;</div></td>
            <td align="left" valign="top" class="tekst2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="tekst">
               <strong>Preuzimanje rada!</strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="tekst">
               <strong>Saving document!</strong><br />
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;
              </td>
            </tr>
          </table>
          <?php		  			
			if($sudionik>1){
				// treba kopirati datoteku
				echo "Ušli za kopiranje datoteke<br>";
				if ($_FILES["file"]["error"] > 0 && $nameFile!="")
    			{
    				$error="Oznaka greške: " . $_FILES["file"]["error"] . "<br />";
    			}
  				else
    			{
					//echo $nameFile." naziv datoteke <br>";
					if($nameFile!=""){
    					if ( file_exists("Radovi/" . $_FILES["file"]["name"]))
      					{
      						$error=$_FILES["file"]["name"] . " već postoji u bazi. ";
      					}
    					else
      					{
      						move_uploaded_file($_FILES["file"]["tmp_name"],
      						"Radovi/" . $_FILES["file"]["name"]);
							$kapac=($_FILES["file"]["size"] / 1024); // u KB
							$dat=$nameFile;
							// upis u bazu sadržaja
      					}
					}
				}
			}
			header("Location: index.php?izbor=18");
			exit();
		  ?>