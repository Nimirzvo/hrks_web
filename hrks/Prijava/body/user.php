

          <table width="98%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S" ><div align="right">Ime korisnika:</div></td>
            <td><label>
                <input name="ime" type="text" class="tekst" id="naziv" size="30" value="<?php echo $ime?>">
              <input name="idUser" type="hidden" id="idUser" value="<?php echo $idUser?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">Prezime korisnika:</div></td>
            <td><label>
                <input name="prezime" type="text" class="tekst" id="naziv" size="30" value="<?php echo $prezime?>">
            </label></td>
            </tr>
            <tr>
              <td align="right" valign="top" class="tekst_S"><div align="right">Adresa:</div></td>
            <td><label>
              <textarea name="adresa" cols="50" rows="5" class="tekst" id="adresa"><?php echo $adresa?></textarea >
              </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">E-mail:</div></td>
            <td><label>
                <input name="posta" type="text" class="tekst" id="posta" size="50" value="<?php echo $posta?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" ><div align="right">&nbsp;</div></td>
            <td class="tekst" ><strong>Podaci za pristup administraciji</strong></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">Korisnicko ime:</div></td>
            <td><label>
                <input name="userName2" type="text" class="tekst" id="userName2" size="30" maxlength="12" value="<?php echo $userName2?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S" ><div align="right">Lozinka:</div></td>
            <td><label>
                <input name="lozinka1" type="text" class="tekst" id="lozinka1" size="15" maxlength="10" value="<?php echo $lozinka1?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S" ><div align="right">Ponovi lozinku:</div></td>
            <td><label>
                <input name="lozinka2" type="text" class="tekst" id="lozinka2" size="15" maxlength="10" value="<?php echo $lozinka2?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S" ><div align="right">Tip korisnika:</div></td>
            <td>
              <select name="tip" id="tip" class="tekst">
                <option value="0" selected="selected">-</option>
                <option value="1">Administrator</option>
                <option value="2">Koordinator skupa</option>
                <option value="3">Voditelj udruge</option>
              </select>
            </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="Novi" type="submit" class="tekst2" id="Novi" value="  Potvrdi  ">&nbsp;&nbsp;&nbsp;
              <input name="Cancel" type="reset" class="tekst2" id="Cancel" value="  Obri&scaron;i  "></td>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>



