<META http-equiv=Content-Type content="text/html; charset=windows-1250">

          <table width="98%" border="0" cellspacing="0" cellpadding="2" class="tekst">
            <tr>
              <td class="tekst">&nbsp;</td>
              <td align="left" valign="top" class="tekst">&nbsp;</td>
            </tr>
            <tr>
              <td class="tekst_S">&nbsp;</td>
              <td align="left" valign="top" class="tekst_L"><strong>Podaci o uplati</strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Ime:</div></td>
            <td align="left"><label>
              <input name="ime" type="text" class="tekst" id="ime" size="30" value="<?php echo $ime?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Prezime:</div></td>
            <td align="left"><label>
                <input name="prezime" type="text" class="tekst" id="prezime" size="30" value="<?php echo $prezime?>">
            </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Iznos:</div></td>
            <td align="left" valign="top" class="tekst"><label>
              <input name="iznos" type="text" class="tekst" id="iznos" align="right" size="15" value="<?php echo $iznos?>"> kn
              <input name="idOsoba" type="hidden" id="idOsoba" value="<?php echo $idOsoba?>" />
              <input name="idSkup" type="hidden" id="idSkup" value="<?php echo $idSkup?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" class="tekst_S"><div align="right">Nadnevak uplate:</div></td>
            <td align="left"><label>
                <input name="nadnevak" type="text" class="tekst" id="nadnevak" value="<?php echo $nadnevak?>" size="12" readonly="readonly">
                <a href="#" onClick="setYears(1947, 2012);showCalender(this, 'nadnevak');"><img src="css/calendar.png" onmouseover="Tip('Izaberi nadnevak')" onmouseout="UnTip()" border="0" height="16" width="16"></a>
            </label></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="top" class="tekst_S"><div align="right">Napomena:</div></td>
            <td align="left"><label>
              <textarea name="napomena" cols="60" rows="3" class="tekst" id="napomena"><?php echo $napomena?></textarea>
            </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top">&nbsp;</td>
              <td>
              <input name="NovaOsoba" type="submit" class="tekst2" id="NovaOsoba" value="  Potvrdi uplatu ">&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
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