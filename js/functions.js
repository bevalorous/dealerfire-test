function findById(id)
{
	var obj = window.document.getElementById(id);
	return obj;
}

function findByName(name)
{
	return document.getElementsByName(name)[0];
}

function show(obj)
{	
	obj.style.display = 'block';
}

function hide(obj)
{	
	obj.style.display = 'none';
}

function setHtml(obj, html)
{
	obj.innerHTML = html;
}

// Source code from http://javascript.ru/ajax/intro
function getXmlHttp(){
	var xmlhttp;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


var ajaxRequest = getXmlHttp();