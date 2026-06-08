///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///  최종 수정일 2009.02.05
///  이 파일의 내용을 수정하지 마십시오. 수정 후 발생하는 오류에 대해서는 기술지원을 하지 않습니다.
///
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

MakeUCC=function() {
	this.ComID				= "";
	this.ComURL				= "";
	this.UserID				= "";
	this.WatermarkUse		= "";
	this.WatermarkURL		= "null";
	this.PlayButtonUse		= "";
	this.PlayButtonURL		= "null";
	this.BannerUse			= "";
	this.BannerURL			= "null";
	this.AdTextUse			= "";
	this.AdTextURL			= "null";
	this.FtpDir				= "";
	this.ViewerParam1		="";
	this.ViewerParam2		="";
	this.DataBase			= "";
	this.CabID				= "0D07A301-DFC5-4bcb-A3AC-76A32F7E630B";
	this.CabName			= "MakeUCC.cab";
	this.CabVer				= "VERSION=2009,10,24,9";
	this.SwfName			= "makeucc.swf"
	this.UploadType			= "FTP";
	this.UploadPage			= "";
	this.LimitTime			= 0;
	this.FrameSize			= "default";
	this.UpParam1			= "";
	this.UpParam2			= "";
}

//재생 시간 제한 설정
MakeUCC.prototype.SetLimitTime=function(sec)
{
	if(sec == "")
	{
		alert("제한할 시간을 초 단위로 입력해주세요.");
		return;
	}

	this.LimitTime = sec;
}

//업로드 타입 설정
MakeUCC.prototype.SetUploadType=function(UploadType)
{
	this.UploadType = UploadType.toUpperCase();
}

//업로드 페이지 URL 설정
MakeUCC.prototype.SetUploadPage=function(UploadPage)
{
	if(this.UploadType != "HTTP")
	{
		alert("FTP 업로드 방식에서는 이 속성을 사용할 수 없습니다.")
		return;
	}

	this.UploadPage = UploadPage;
}

//프레임 사이즈 지정
MakeUCC.prototype.SetFrameSize=function(size)
{
	if(size == "")
	{
		alert("동영상 크기를 '가로x세로' 로 입력해주세요.");
		return;
	}

	this.FrameSize = size;
}


MakeUCC.prototype.SetUpParam1=function(param)
{
	if(param == "")
	{
		alert("파라미터 값을 입력하세요.");
		return;
	}
	
	this.UpParam1 = param;
}

MakeUCC.prototype.SetUpParam2=function(param)
{
	if(param == "")
	{
		alert("파라미터 값을 입력하세요.");
		return;
	}
	
	this.UpParam2 = param;
}


MakeUCC.prototype.SetID=function(UID) {
	this.ComID = UID;
}

MakeUCC.prototype.GetID=function() {
	return this.ComID;
}

MakeUCC.prototype.SetSrvID=function(SID) {
	this.UserID = SID;
}

MakeUCC.prototype.GetSrvID=function() {
	return this.UserID;
}

MakeUCC.prototype.SetUserID=function(UID) {
	this.UserID = UID;
}

MakeUCC.prototype.GetUserID=function() {
	return this.UserID;
}

MakeUCC.prototype.SetURL=function(CURL) {
	this.ComURL = CURL;
}

MakeUCC.prototype.GetURL=function() {
	return this.ComURL;
}

MakeUCC.prototype.SetDBName=function(DBN) {
	this.DataBase = DBN;
}

MakeUCC.prototype.GetDBName=function() {
	return this.DataBase;
}

MakeUCC.prototype.SetMakeUCC=function(CID, CURL) {
	if("" == CID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}
	if("" == CURL) {
		alert("MakeUCC : 컴포넌트 URL을 입력하세요.");
		return;
	}
	this.ComID = CID;
	this.ComURL = CURL;
}

MakeUCC.prototype.SetWatermark=function(WURL) {
	this.WatermarkUse = "1";
	if(undefined != WURL)
	{
		this.WatermarkURL = WURL;
	}
}

MakeUCC.prototype.SetPlayButton=function(PURL) {
	this.PlayButtonUse = "1";
	if(undefined != PURL)
	{
		this.PlayButtonURL = PURL;
	}
}

MakeUCC.prototype.SetBannerURL=function(BURL) {
	this.BannerUse = "1";
	if(undefined != BURL)
	{
		this.BannerURL = BURL;
	}
}

MakeUCC.prototype.SetAdText=function(AURL) {
	this.AdTextUse = "1";
	if(undefined != AURL)
	{
		this.AdTextURL = AURL;
	}
}

MakeUCC.prototype.SetFtpDir=function(Dir) {
	this.FtpDir = Dir;
}

MakeUCC.prototype.SetViewParam1=function(VP) {
	this.ViewerParam1 = VP;
}

MakeUCC.prototype.SetViewParam2=function(VP) {
	this.ViewerParam2 = VP;
}

MakeUCC.prototype.GetSelectFile=function() {
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}
	return MakeUCC_Converter.strSelectedFile;
}

MakeUCC.prototype.GetPlayTime=function() {
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}
	return MakeUCC_Converter.VideoPlayTime;
}

MakeUCC.prototype.GetVideoFileSize=function() {
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}
	return MakeUCC_Converter.nVideoFileSize
}

MakeUCC.prototype.Convert=function(bImage, nLimitSize) 
{
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}

	MakeUCC_Converter.ComponentURL	= this.ComURL;
	MakeUCC_Converter.DataBaseName	= this.DataBase;
	MakeUCC_Converter.ComponentID		= this.ComID;

	if("" != this.UserID) 
	{
		MakeUCC_Converter.ServiceID = this.UserID;
	}

	if( ("1" == this.WatermarkUse) && ("null" == this.WatermarkURL) )
	{
		MakeUCC_Converter.WatermarkURL = this.ComURL + "watermark.jpg";
	}
	else 
	{
		MakeUCC_Converter.WatermarkURL = this.WatermarkURL;
	}

	if(undefined == nLimitSize) 
	{
		MakeUCC_Converter.nLimitSize = 0;
	}
	else	
	{
		MakeUCC_Converter.nLimitSize = nLimitSize;
	}

	MakeUCC_Converter.nLimitTime = this.LimitTime;
	
	MakeUCC_Converter.sFrameSize = this.FrameSize;
	
	MakeUCC_Converter.Convert(bImage);
}

MakeUCC.prototype.GetUploadVideoFile=function() {
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}
	return MakeUCC_Converter.strConvertedVideoFile;
}

MakeUCC.prototype.GetUploadImageFile=function() {
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}	
	return MakeUCC_Converter.strConvertedImageFile;
}

MakeUCC.prototype.Upload=function(Folder, Ftp_Type) 
{
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}
	
	MakeUCC_Converter.WebRoot = this.FtpDir;
	MakeUCC_Converter.is_passive_ftp = Ftp_Type;

	if(this.UploadType == "HTTP" && this.UploadPage == "")
	{
		alert("Error!!! HTTP 업로드를 처리할 페이지 URL이 없습니다.");
		return;
	}

	MakeUCC_Converter.UploadPage = this.UploadPage;

	if(this.UpParam1 != "")
		MakeUCC_Converter.UpParam1 = this.UpParam1;

	if(this.UpParam2 != "")
		MakeUCC_Converter.UpParam2 = this.UpParam2;
	
	MakeUCC_Converter.Upload(Folder);
}

MakeUCC.prototype.CreateConverter=function() {
	this.CheckConverter();
	sTag = "<object id=\"MakeUCC_Converter\" classid=\"clsid:" + this.CabID + "\" ";
	//sTag += "codebase=\"" + this.ComURL + "/" + this.CabName + "#" + this.CabVer + "\" width=\"0\" height=\"0\"> ";
	sTag += "codebase=\"" + this.ComURL + this.CabName + "#" + this.CabVer + "\" width=\"0\" height=\"0\"> ";
	sTag += "</object>";
	document.write(sTag);
	return sTag;
}

MakeUCC.prototype.CreateConverterPopup=function(PopupName) {
	this.CheckConverter();
	sTag = "<object id=\"MakeUCC_Converter\" classid=\"" + this.CabID + "\" ";
	sTag += "codebase=\"" + this.ComURL + "/" + this.CabName + "#" + this.CabVer + "\" width=\"0\" height=\"0\" onerror=\""+ PopupName + "\"> ";
	sTag += "</object>";
	document.write(sTag);
	return sTag;
}

MakeUCC.prototype.CheckConverter=function() {
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}	
	if("" == this.ComURL) {
		this.CabID = "f1b6fcd7-5d5f-48fd-b431-5e80939a8583";
		this.CabName = "UCCLauncher.cab";
		this.CabVer = "VERSION=2008,5,19,1";
		this.ComURL = "http://service.makeucc.co.kr/install";
		if( ("1" == this.WatermarkUse) && ("null" == this.WatermarkURL) ){
			this.WatermarkURL = "http://admin.makeucc.co.kr/upload/comservice";
		}
	}
	if('/' != this.ComURL[this.ComURL.length - 1])
	{
		this.ComURL += "/";
	}
}

MakeUCC.prototype.CreateViewer=function(MovieID, nWidth, nHeight) {
	this.CheckViewer("normal");
	this.Viewer(MovieID, nWidth, nHeight);
}

MakeUCC.prototype.CreateMiniViewer=function(MovieID, nWidth, nHeight) {
	this.CheckViewer("mini");
	this.Viewer(MovieID, nWidth, nHeight);
}

MakeUCC.prototype.Viewer=function(MovieID, nWidth, nHeight) {
	sTag = "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" ";
	sTag += "codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0\" ";
	sTag += "width=\"" + nWidth +"\" height=\"" + nHeight +"\" id=\"MakeUCC_Viewer\" align=\"middle\" /> ";
	sTag += "<param name=\"allowScriptAccess\" value=\"always\" /> ";
	sTag += "<param name=\"allowfullscreen\" value=\"true\" /> ";
	sTag += "<param name=\"movie\" value=\"" + this.ComURL + this.SwfName + "\" /> ";
	sTag += "<param name=\"quality\" value=\"high\" /> ";
	sTag += "<param name=\"devicefont\" value=\"true\" /> ";
	sTag += "<param name=\"bgcolor\" value=\"#ffffff\" /> ";
	if( (this.UserID != undefined) && (this.UserID != "") ) {
		sTag += "<param name=\"FlashVars\" value=\"ComURL=" + this.ComURL + "&ComSrv_ID=" + this.ComID + "&Srv_ID=" + this.UserID + "&MovieID=" + MovieID  + "&playicon=" + this.PlayButtonURL + "&WatermarkURL=" + this.WatermarkURL + "&BannerURL=" + this.BannerURL  + "&ComSrv_AdText=" + this.AdTextURL + "&ViewerParam1=" + this.ViewerParam1 + "&ViewerParam2=" + this.ViewerParam2 + "\" /> ";
	}
	else {
		sTag += "<param name=\"FlashVars\" value=\"ComURL=" + this.ComURL + "&ComSrv_ID=" + this.ComID + "&MovieID=" + MovieID  + "&playicon=" + this.PlayButtonURL + "&WatermarkURL=" + this.WatermarkURL + "&BannerURL=" + this.BannerURL + "&ComSrv_AdText=" + this.AdTextURL  + "&ViewerParam1=" + this.ViewerParam1 + "&ViewerParam2=" + this.ViewerParam2  + "\" /> ";
	}
	sTag += "<embed src=\"" + this.ComURL + "makeucc.swf\" ";
	sTag += "quality=\"high\" wmode=\"transparent\" devicefont=\"true\" ";
	sTag += "bgcolor=\"#ffffff\" width=\"" + nWidth +"\" height=\"" + nHeight +"\" id=\"MakeUCC_Viewer\" name=\"MakeUCC_Viewer\" ";
	sTag += "align=\"middle\" allowScriptAccess=\"always\" allowfullscreen=\"true\" type=\"application/x-shockwave-flash\" ";
	sTag += "pluginspage=\"http://www.macromedia.com/go/getflashplayer\" ";
	if( (this.UserID != undefined) && (this.UserID != "") ) {
		sTag += "flashvars=\"ComURL=" + this.ComURL + "&ComSrv_ID=" + this.ComID + "&Srv_ID=" + this.UserID +"&MovieID=" + MovieID  + "&playicon=" + this.PlayButtonURL + "&WatermarkURL=" + this.WatermarkURL + "&BannerURL=" + this.BannerURL + "&ComSrv_AdText=" + this.AdTextURL + "&ViewerParam1=" + this.ViewerParam1 + "&ViewerParam2=" + this.ViewerParam2  + "\" /> ";
	}
	else {
		sTag += "flashvars=\"ComURL=" + this.ComURL + "&ComSrv_ID=" + this.ComID + "&MovieID=" + MovieID  + "&playicon=" + this.PlayButtonURL + "&WatermarkURL=" + this.WatermarkURL + "&BannerURL=" + this.BannerURL + "&ComSrv_AdText=" + this.AdTextURL  + "&ViewerParam1=" + this.ViewerParam1 + "&ViewerParam2=" + this.ViewerParam2  + "\" /> ";
	}
	
	sTag += "</object>";

	document.write(sTag);

	return sTag;
}

MakeUCC.prototype.CheckViewer=function(VTYPE) {
	if("" == this.ComID) {
		alert("MakeUCC : ID를 입력하세요.");
		return;
	}	
	if("" == this.ComURL) {
		this.ComURL = "http://service.makeucc.co.kr/install";
		if("mini" == VTYPE) {
			this.SwfName = "viewer_mini.swf";
		}
		else	{
			this.SwfName = "viewer.swf";
		}
	}
	else {
		if("mini" == VTYPE) {
			this.SwfName = "viewer_mini.swf";
		}
		else	{
			this.SwfName = "makeucc.swf";
		}
	}
	if('/' != this.ComURL[this.ComURL.length - 1])
	{
		this.ComURL += "/";
	}
	if( ("1" == this.PlayButtonUse) && ("null" == this.PlayButtonURL) ){
		this.PlayButtonURL = this.ComURL + "playbutton.png";
	}
	if( ("1" == this.WatermarkUse) && ("null" == this.WatermarkURL) ){
		this.WatermarkURL = this.ComURL + "watermark.png";
	}
	if( ("1" == this.AdTextUse) && ("null" == this.AdTextURL) ){
		this.AdTextURL = this.ComURL + "AdText.xml";
	}
}