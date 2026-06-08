// pubkey1 : PG용 샘플 공개키
var pubkey1     = "ADCBiAKBgHgWQm5CVQBNaGlIgTgv06HhOXQqSuuBPY2EvPvPsEL120jnT5HCU7lMbP8qVvb2qpGmxN+3PUVUXG1yHKqEGkNc77/eOq4KReHFeezH2wPoLnRkivm0pE4MfWwL2N6la5G1lktZdbtsWMAT7GJeEpbbDkTqatbf4XQkG2Cixq/jAgMBAAEA";
// pubkey2 : 은행 공개키
var pubkey2     = "ADCBiAKBgHgWQm5CVQBNaGlIgTgv06HhOXQqSuuBPY2EvPvPsEL120jnT5HCU7lMbP8qVvb2qpGmxN+3PUVUXG1yHKqEGkNc77/eOq4KReHFeezH2wPoLnRkivm0pE4MfWwL2N6la5G1lktZdbtsWMAT7GJeEpbbDkTqatbf4XQkG2Cixq/jAgMBAAEA";

var encrypt_header      = "encrypt_";
var double_header       = "double_";

var keyname1 = 'Sample1';
var keyname2 = 'Sample2';
var keyname3 = 'Sample3';
var keyname4 = 'Sample4';

function issacweb_escape(msg){
    var i;
    var ch;
    var encMsg = '';
    var tmp_msg = String(msg);

    for (i = 0; i < tmp_msg.length; i++) {
        ch = tmp_msg.charAt(i);

        if (ch == ' ')
            encMsg += '%20';
        else if (ch == '%')
            encMsg += '%25';
        else if (ch == '&')
            encMsg += '%26';
        else if (ch == '+')
            encMsg += '%2B';
        else if (ch == '=')
            encMsg += '%3D';
        else if (ch == '?')
            encMsg += '%3F';
        else
            encMsg += ch;
    }
    return encMsg;
}

function encryptForm(form){
	var first = true;
	var catMsg = "";
	var curMsg;

	for(var i=0; i< form.length; i++){
		
		if(form.elements[i].type != "button" && form.elements[i].type != "reset" && form.elements[i].type != "submit"){
			if(form.elements[i].type == "checkbox" || form.elements[i].type == "radio"){
				if(form.elements[i].checked){
						curMsg =  form.elements[i].value;
						form.elements[i].checked = false;
				}else{
						continue;
				}
			}else if(form.elements[i].type == "select-one"){
				var index = form.elements[i].selectedIndex;
				
				if(form.elements[i].options[index].value != ""){
						curMsg = form.elements[i].options[index].value;
				}else{
						curMsg = form.elements[i].options[index].text;
				}
				form.elements[i].selectedIndex = 0;
			}else{
					if(form.elements[i].name	== "issacweb_data")
						continue;
					
					curMsg =  form.elements[i].value;
					form.elements[i].value	= "";
			}
			if(first){
				first = false;
			}else{
				catMsg	= catMsg + "&";
			}
			catMsg	+= issacweb_escape(form.elements[i].name) + "=" + issacweb_escape(curMsg);	
		}
	}

    form.elements["issacweb_data"].value = document.IssacWebEnc.getSubApplet().issacweb_hybrid_encrypt_ex_s(catMsg, pubkey1, keyname1, 1);    

	if(form.elements["issacweb_data"].value	== "") {
		alert("issacweb_data is null");
 		return false;
	}
	
	form.submit( );
}



function encryptForm_utf8(form){
	var first = true;	
	var catMsg = "";
	var curMsg;

	for(var i=0; i< form.length; i++){
		if(form.elements[i].type != "button" && form.elements[i].type != "reset" && form.elements[i].type != "submit"){
			if(form.elements[i].type == "checkbox" || form.elements[i].type == "radio"){
				if(form.elements[i].checked){
					curMsg =  form.elements[i].value;
					form.elements[i].checked = false;
				}else{
					continue;
				}
			}else if(form.elements[i].type == "select-one"){
				var index = form.elements[i].selectedIndex;

				if(form.elements[i].options[index].value != ""){
					curMsg = form.elements[i].options[index].value;
				}else{
					curMsg = form.elements[i].options[index].text;
				}
				form.elements[i].selectedIndex = 0;
			}else{
				if(form.elements[i].name	== "issacweb_data")
					continue;
				curMsg =  form.elements[i].value;
				form.elements[i].value	= "";
			}
			if(first){
				first = false;
			}else{
				catMsg	= catMsg + "&";
			}
			catMsg	+= issacweb_escape(form.elements[i].name) + "=" + issacweb_escape(curMsg);	
		}
	}
	
	try{
		form.elements["issacweb_data"].value = document.IssacWebEnc.getSubApplet().issacweb_hybrid_encrypt_ex_s_utf8(catMsg, pubkey1, keyname1, 1);  
	}catch(e){
		alert(e);
		return false;
	}

	if(form.elements["issacweb_data"].value	== "") {
		alert("issacweb_data is null");
 		return false;
	}

	form.submit( );
}

function encryptSeleted(form){
	for(var i=0; i<form.length; i++){
		if(form.elements[i].type != "button"
			&& form.elements[i].type != "reset" 
			&& form.elements[i].type != "submit")
		{
			if(form.elements[i].type == "checkbox" 
				|| form.elements[i].type == "radio"){
				if(form.elements[i].checked){
					// 처리 부분
					if(form.elements[i].name.indexOf(encrypt_header) != -1)	
            form.elements[i].value  = document.IssacWebEnc.getSubApplet().issacweb_encrypt_ex_s(form.elements[i].value, keyname1, 1);
				}else{
						continue;
				}
			}else if(form.elements[i].type == "select-one"){
				var index = form.elements[i].selectedIndex;
				if(form.elements[i].options[index].value != "text1"){
					if(form.elements[i].name.indexOf(encrypt_header) != -1)	
            form.elements[i].value  = document.IssacWebEnc.getSubApplet().issacweb_encrypt_ex_s(form.elements[i].value, keyname1, 1);
				}else{
					if(form.elements[i].name.indexOf(encrypt_header) != -1)	
            form.elements[i].value  = document.IssacWebEnc.getSubApplet().issacweb_encrypt_ex_s(form.elements[i].value, keyname1, 1);
        }
			}else{
					// Text & password field
					if(form.elements[i].name	== "issacweb_data"){
            form.elements[i].value  =  document.IssacWebEnc.getSubApplet().issacweb_hybrid_encrypt_ex_s_utf8("", pubkey1, keyname1, 1);
						continue;
					}
					if(form.elements[i].name.indexOf(encrypt_header) != -1)	
				{
						//alert(keyname1);
						form.elements[i].value	= document.IssacWebEnc.getSubApplet().issacweb_encrypt_ex_s(form.elements[i].value, keyname1, 1);
				}
			}
		}
	}
	form.submit();
}

/**
 * applet 내부 IP변경
 */
document.writeln("<applet id=\"IssacWebEnc\" name=\"IssacWebEnc\" code=\"org.jdesktop.applet.util.JNLPAppletLauncher\" width=0 height=0 archive=\"http://192.168.1.200:80/isignplus/client_lib/applet-launcher.jar, http://192.168.1.200:80/isignplus/client_lib/IssacWebSE.jar\"> ");
document.writeln("<param name=\"codebase_lookup\" value=\"false\"> ");
document.writeln("<param name=\"subapplet.classname\" value=\"pentasecurity.issacweb.pro.client.IssacWebSE\"> ");
document.writeln("<param name=\"noddraw.check\" value=\"true\"> ");
document.writeln("<param name=\"progressbar\" value=\"true\"> ");
document.writeln("<param name=\"jnlpNumExtensions\" value=\"1\"> ");
document.writeln("<param name=\"jnlpExtension1\" value=\"http://192.168.1.200:80/isignplus/client_lib/JniIssacWebJNLP.jnlp\"> </applet> ");