function popup(url,name,wd,he) {
  window.open(url,name,'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width='+wd+',height='+he+',screenX=150,screenY=150,top=150,left=150')
}
function do_click(id){
	window.open("banner_redirect.php?id="+id);
}
function do_search(){
	var k=document.search.keyword.value
	if (k.length<2)
		alert('对不起，关键字太短');
	else
		document.search.submit();
}