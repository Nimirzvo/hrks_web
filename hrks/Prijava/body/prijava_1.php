<META http-equiv=Content-Type content="text/html; charset=windows-1250">
<LINK href="bootstrap/bootstrap.min.css" type=text/css rel=stylesheet>
<LINK href="bootstrap/bootstrap.css" type=text/css rel=stylesheet>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


          <table width="98%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td class="tekst">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="tekst">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="25%" class="tekst"><div class="form-group" align="right">Ime sudionika:</div></td>
            <td><label>
              <input name="ime" type="text" class="tekst" id="naziv" size="30" value="<?php echo $ime?>">
              <input name="idSkup" type="hidden" id="idSkup" value="<?php echo $idSkup?>" />
              <input name="idOsoba" type="hidden" id="idOsoba" value="<?php echo $idOsoba?>" />
            </label></td>
            </tr>
            <tr>
              <td width="25%" class="tekst"><div align="right">Prezime sudionika:</div></td>
            <td><label>
                <input name="prezime" type="text" class="tekst" id="naziv" size="30" value="<?php echo $prezime?>">
            </label></td>
            </tr>
            <tr>
              <td width="25%" class="tekst"><div align="right">Nadnevak rođenja:</div></td>
            <td><label>
                <input name="nadnevak" type="text" class="tekst" id="nadnevak" value="<?php echo $nadnevak?>" size="12" readonly="readonly">
                <a href="#" onClick="setYears(1930, 2010);showCalender(this, 'nadnevak');"><img src="css/calendar.png" onmouseover="Tip('Izaberi nadnevak')" onmouseout="UnTip()" border="0" height="16" width="16"></a>
            </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="Prijava_1" type="submit" class="tekst2" id="Prijava_1" value="Nastavi s prijavom >>">                
              <input name="Cancel" type="reset" class="tekst2" id="Cancel" value="Obriši upisano">
              </td>
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



