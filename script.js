function global_load(id, url) {
  xmlHttp1 = new XMLHttpRequest()
  xmlHttp1.onreadystatechange = function() {document.getElementById(id).innerHTML = xmlHttp1.responseText}
  xmlHttp1.open('GET', url)
  xmlHttp1.send(0)
}

function global_load1(id, url) {
  xmlHttp1 = new XMLHttpRequest()
  xmlHttp1.onreadystatechange = function() {document.getElementById(id).innerHTML = xmlHttp1.responseText}
  xmlHttp1.open('GET', url)
  xmlHttp1.send(0)
}

function global_load2(id, url) {
  xmlHttp2 = new XMLHttpRequest()
  xmlHttp2.onreadystatechange = function() {document.getElementById(id).innerHTML = xmlHttp2.responseText}
  xmlHttp2.open('GET', url)
  xmlHttp2.send(0)
}

function global_load3(id, url) {
  xmlHttp3 = new XMLHttpRequest()
  xmlHttp3.onreadystatechange = function() {document.getElementById(id).innerHTML = xmlHttp3.responseText}
  xmlHttp3.open('GET', url)
  xmlHttp3.send(0)
}

function global_load4(id, url) {
  xmlHttp4 = new XMLHttpRequest()
  xmlHttp4.onreadystatechange = function() {document.getElementById(id).innerHTML = xmlHttp4.responseText}
  xmlHttp4.open('GET', url)
  xmlHttp4.send(0)
}

function global_load5(id, url) {
  xmlHttp5 = new XMLHttpRequest()
  xmlHttp5.onreadystatechange = function() {document.getElementById(id).innerHTML = xmlHttp5.responseText}
  xmlHttp5.open('GET', url)
  xmlHttp5.send(0)
}

function global_load6(id, url) {
  xmlHttp6 = new XMLHttpRequest()
  xmlHttp6.onreadystatechange = function() {document.getElementById(id).innerHTML = xmlHttp6.responseText}
  xmlHttp6.open('GET', url)
  xmlHttp6.send(0)
}


function global_enc(value) {return encodeURIComponent(value)}

function global_hint_show(hintID) {document.getElementById(hintID).style.visibility = 'visible'}

function global_hint_hide(hintID) {document.getElementById(hintID).style.visibility = 'hidden'}

hint_mouseover = 0

function global_hint_blur(hintID) {if (hint_mouseover == 0) {global_hint_hide(hintID)}}

function global_hint_mouseover() {hint_mouseover = 1}

function global_hint_mouseout() {hint_mouseover = 0}

function global_hint_select(parentID, parentValue, hintID) {
  PID = document.getElementById(parentID)
  PID.value = parentValue
  PID.focus()
  global_hint_hide(hintID)
  hint_mouseover = 0
}

function formatangka(objek) {
a = objek.value;
b = a.replace(/[^\d]/g,"");
c = "";
panjang = b.length;
j = 0;
for (i = panjang; i > 0; i--) {
j = j + 1;
if (((j % 3) == 1) && (j != 1)) {
c = b.substr(i-1,1) + c;
} else {
c = b.substr(i-1,1) + c;
}
}
objek.value = c;
}

function tryNumberFormat(obj)
{
	obj.value = new NumberFormat(obj.value).toFormatted();
}


