function isignPki(pageform){
	try{
		// 버전 출력
		//alert(document.IssacWebCMS.getSubApplet().issacwebpro_GetVersion());
		//var challenge= 'MBIEEPbCt5t28/bPqBToNhHKXOA=';

		// 인증서 선택창을 띄우고 인증서 경로(keypath)를 가져온다.
		var keypath = document.IssacWebCMS.getSubApplet().issacwebpro_SelectUserCert("", "http://192.168.1.200:80/isignplus/cfg/issac.png", 35, 15, 0);

		// keypath 를 만들지 못했을 경우에는 private key 와 Response 를 만든다.
		if(keypath != null){
			pageform.challenge.value = document.IssacWebCMS.getSubApplet().issacwebpro_MakeChallenge();//challenge;
			pageform.response.value	= document.IssacWebCMS.getSubApplet().issacwebpro_MakeResponse(pageform.challenge.value, keypath);
			//alert(pageform.response.value);
			if(document.IssacWebCMS.getSubApplet().issacwebpro_GetLastError() != 0){
				alert("Error:" + document.IssacWebCMS.getSubApplet().issacwebpro_GetLastError());
			}else{
				return true;
			}
		}else{
			return false;
		} 
	}catch (e){
		alert(e);
	}	
}

document.writeln("<applet alt=\"IssacWebCMS\" id=\"IssacWebCMS\" name=\"IssacWebCMS\" code=\"org.jdesktop.applet.util.JNLPAppletLauncher\" width=0 height=0 archive=\"http://192.168.1.200:80/isignplus/client_lib/applet-launcher.jar, http://192.168.1.200:80/isignplus/client_lib/IssacWebCMS.jar\">");
document.writeln("<param name=\"codebase_lookup\" value=\"false\">");
document.writeln("<param name=\"subapplet.classname\" value=\"pentasecurity.issacweb.pro.client.IssacWebCMS\">");
document.writeln("<param name=\"noddraw.check\" value=\"true\">");
document.writeln("<param name=\"progressbar\" value=\"true\">");
document.writeln("<param name=\"jnlpNumExtensions\" value=\"1\">");
document.writeln("<param name=\"jnlpExtension1\" value=\"http://192.168.1.200:80/isignplus/client_lib/JniIssacWebJNLP.jnlp\"> </applet>");