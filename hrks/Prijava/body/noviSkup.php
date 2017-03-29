<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="98%" border="0" cellspacing="0" cellpadding="2" class="bg">
            <tr>
              <td class="tekst">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="25%" class="tekst_S"><div align="right">Naziv skupa</div></td>
            <td><label>
              <input name="ime" type="text" class="tekst" id="naziv" size="70" value="<?php echo $ime?>">
              <input name="idSkup" type="hidden" id="idSkup" value="<?php echo $idSkup?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" class="tekst_S"><div align="right">Mjesto održavanja:</div></td>
            <td><label>
                <input name="mjesto" type="text" class="tekst" id="mjesto" size="50" value="<?php echo $mjesto?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" class="tekst_S"><div align="right">Nadnevak početka skupa:</div></td>
            <td><label>
                <input name="nadnevak" type="text" class="tekst" id="nadnevak" value="<?php echo $nadnevak?>" size="12" readonly="readonly">
                <a href="#" onClick="setYears(2000, 2015);showCalender(this, 'nadnevak');"><img src="css/calendar.png" border="0" height="16" width="16"></a>
            </label></td>
            </tr>
            <tr>
              <td width="25%" class="tekst_S"><div align="right">Nadnevak zavr&scaron;etka skupa:</div></td>
            <td><label>
              <input name="nadnevak2" type="text" class="tekst" id="nadnevak2" value="<?php echo $nadnevak2?>" size="12" readonly="readonly">
              <a href="#" onClick="setYears(2000, 2015);showCalender(this, 'nadnevak2');"><img src="css/calendar.png" border="0" height="16" width="16"></a>
            </label></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_S">Aktivan:</td>
              <td align="left" class="tekst">
                <label><input type="radio" name="radio" id="radio" value="D" <?php echo $aktivan_D?>/>Da</label>
                <label><input type="radio" name="radio" id="radio" value="N" <?php echo $aktivan_N?>/>Ne</label>
              </td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">Opis:</div></td>
            <td><label>
              <textarea name="opis" cols="50" rows="3" class="tekst" id="opis"><?php echo $opis?></textarea>
            </label></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="tekst_S">Vrsta skupa:</td>
              <td align="left" class="tekst">
                <label><input name="radio6" type="radio" id="radio6" value="D" <?php echo $skup_D?>/>Domaći</label>
                <label><input type="radio" name="radio6" id="radio6" value="E" <?php echo $skup_E?>/>Međunarodni</label>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="Novi" type="submit" class="tekst2" id="Novi" value="  Potvrdi  ">&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
    <!-- Calender Script  --> 

<table id="calenderTable">
        <tbody id="calenderTableHead">
          <tr>
            <td colspan="4" align="center">
	          <select onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value,
	           this.selectedIndex, false));" id="selectMonth">
	              <option value="0">Jan</option>
	              <option value="1">Feb</option>
	              <option value="2">Mar</option>
	              <option value="3">Apr</option>
	              <option value="4">Maj</option>
	              <option value="5">Jun</option>
	              <option value="6">Jul</option>
	              <option value="7">Aug</option>
	              <option value="8">Sep</option>
	              <option value="9">Okt</option>
	              <option value="10">Nov</option>
	              <option value="11">Dec</option>
	          </select>
            </td>
            <td colspan="2" align="center">
			    <select onChange="showCalenderBody(createCalender(this.value, 
				document.getElementById('selectMonth').selectedIndex, false));" id="selectYear">
				</select>
			</td>
            <td align="center">
			    <a href="#" onClick="closeCalender();"><font color="#003333" size="+1">x</font></a>
			</td>
		  </tr>
       </tbody>
       <tbody id="calenderTableDays">
         <tr style="">
           <td>Ned</td><td>Pon</td><td>Uto</td><td>Sri</td><td>Cet</td><td>Pet</td><td>Sub</td>
         </tr>
       </tbody>
       <tbody id="calender"></tbody>
</table>

<!-- End Calender Script  --> 



