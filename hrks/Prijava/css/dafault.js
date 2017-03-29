<!--

function otvoriProzor(adresa) {
	var sada = new Date();
	var naziv = "prozor" + sada.getSeconds() + sada.getMilliseconds();
	window.open(adresa, naziv, "menubar=no,toolbar=no,status=no,width=940,height=600,resizable=yes,scrollbars=yes");
}

function setBrowserData() {
	var bWidth = screen.width;
	var bHeight = screen.height;
	var bCDepth = screen.colorDepth;
	var exp = new Date();
	var nowPlusWeek = exp.getTime() + (7 * 24 * 60 * 60 * 1000);
	exp.setTime(nowPlusWeek);
	document.cookie = "cmsUserDisplay=width:" + bWidth + "#height:" + bHeight + "#colorDepth:" + bCDepth + ";expires=" + exp.toGMTString();
}

setBrowserData();


function traziDokumente() {
	var traziTekst = document.getElementById("traziTekst");
	if(traziTekst != null && traziTekst.value.length > 0 && traziTekst.value != "Traži") {
		this.form.submit();
	}
}

function aktiviraj_traziDokumente(trazi_tekst) {
	if(trazi_tekst.value == "Traži") {
		trazi_tekst.value = "";
	}
}

function setBannerRight(part1, maxNum, ext) {
	var number = Math.floor(Math.random() * maxNum) + 1;
	var banner_right = document.getElementById("banner_right");

	if(banner_right == null) {
		return;
	}
	banner_right.style.backgroundImage = "url(" + part1 + number + ext + ")";
	banner_right.style.backgroundRepeat = "repeat-x";
//	alert(part1 + number + ext);
}

function convertCharCodes(inText) {
	var HTMLcodes = new Array("&#352;", "&#272;", "&#381;", "&#268;", "&#262;", "&#353;", "&#273;", "&#382;", "&#269;", "&#263;");
	var HRcodes =   new Array("Š", "Ð", "Ž", "È", "Æ", "š", "ð", "ž", "è", "æ");
	for(i=0;i<HTMLcodes.length;i++) {
		re = new RegExp(HTMLcodes[i], "g");
	  inText = inText.replace(re, HRcodes[i]);
	}

	return inText;
}


-->
