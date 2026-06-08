// 기본 정보
var TREE_ID = $("#TREE_ID").val();		// 메뉴 분류 ID
var PMENU = $("#PMENU").val();			// 부모창 PK
//alert(PMENU)
// Plug-in 기본 설정
var setting = {
	async: {
		enable: true,
		url:"../menu/ajax.tree.data.php",
		autoParam:["id", "level"],
		otherParam: {"TREE_ID": TREE_ID, "PMENU": PMENU},
		dataFilter: filter,
		type: "POST"
	},
	view: {
		expandSpeed: "fast",				// 속도 조절
		selectedMulti: false,				// 다중 선택 여부
		addHoverDom: addHoverDom,			// 마우스 오버 이벤트 - 우측 아이콘 표시
		removeHoverDom: removeHoverDom		// 마우스 아웃 이벤트 - 우측 아이콘 미표시
	},
	edit: {
		enable: true,						// 수정 가능
		showRenameBtn: false				// 이름 바꾸는 버튼 제거
	},
	data: {
		simpleData: {
			enable: true
		}
	},
	callback: {								// 이벤트 처리 함수
		beforeAsync: beforeAsync,			//
		onAsyncSuccess: onAsyncSuccess,		// 리스트 불러오기 성공시
		onAsyncError: onAsyncError,			// 리스트 불러오기 실패시
		beforeClick: beforeClick,			// Element의 클릭 이벤트
		beforeRemove: beforeRemove			// Element 제거 이벤트
	}
};


// ############################ TREE 목록 불러오기 ############################
function filter(treeId, parentNode, childNodes) {
	if (!childNodes) return null;
	return childNodes;
}
function beforeAsync() {
	curAsyncCount++;
}
function onAsyncSuccess(event, treeId, treeNode, msg) {
	//alert(11111)
	console.log(treeNode);
	curAsyncCount--;
	if (curStatus == "expand") expandAll();								// 자동펼침
	else if (curStatus == "async") asyncNodes(treeNode.children);		// 하위 Element 정보 불러오기 ( 펼치지 않음 )

	if (curAsyncCount <= 0) {
		if (curStatus != "init" && curStatus != "") asyncForAll = true;
		curStatus = "";
	}
	if ( curStatus == "async" ) doneAsync = true;
	// 시작시 전체 메뉴 불러오기
	asyncAll();
}
function onAsyncError(event, treeId, treeNode, XMLHttpRequest, textStatus, errorThrown) {
	curAsyncCount--;
	if (curAsyncCount <= 0) {
		curStatus = "";
		if (treeNode!=null) asyncForAll = true;
	}
}


// ############################ 메뉴 펼침, 접기 컨트롤 ############################
var curStatus = "init", curAsyncCount = 0, asyncForAll = false, goAsync = false, doneAsync= false;

function check() {
	if (curAsyncCount > 0) return false;
	return true;
}
function expandAll() {
	if (!check()) {
		return;
	}
	var zTree = $.fn.zTree.getZTreeObj("trees");
	if (asyncForAll) {
		$("#demoMsg").text(demoMsg.expandAll);
		zTree.expandAll(true);
	} else {
		expandNodes(zTree.getNodes());
		if (!goAsync) {
			$("#demoMsg").text(demoMsg.expandAll);
			curStatus = "";
		}
	}
}
function expandNodes(nodes) {
	console.log(nodes)
	if (!nodes) return;
	curStatus = "expand";
	var zTree = $.fn.zTree.getZTreeObj("trees");
	for (var i=0, l=nodes.length; i<l; i++) {
		zTree.expandNode(nodes[i], true, false, false);
		if (nodes[i].isParent && nodes[i].zAsync) {
			expandNodes(nodes[i].children);
		} else {
			goAsync = true;
		}
	}
}
// 목록펼침없이 하위메뉴 불러오기
function asyncAll() {
	if (!check()) return;
	var zTree = $.fn.zTree.getZTreeObj("trees");
	if (asyncForAll) {
		/* do nothing */
	} else {
		asyncNodes(zTree.getNodes());
		if (!goAsync) curStatus = "";
	}
}
function asyncNodes(nodes) {
	
	if (!nodes) return;
	curStatus = "async";
	var zTree = $.fn.zTree.getZTreeObj("trees");
	for (var i=0, l=nodes.length; i<l; i++) {
		if (nodes[i].isParent && nodes[i].zAsync) {
			asyncNodes(nodes[i].children);
		} else {
			goAsync = true;
			zTree.reAsyncChildNodes(nodes[i], "refresh", true);
		}
	}
}
// 메뉴 순서 저장
function saveOrderMenuList() {
	$.loader({
		className: "blue-with-image-2",
		content:''
	});
	var treeObj = $.fn.zTree.getZTreeObj("trees");
	var nodes = treeObj.transformToArray(treeObj.getNodes());

	var ajaxData = "";
	for ( var i in nodes ) {
		if ( ajaxData != "" ) ajaxData += "||";				// 줄구분
		ajaxData += nodes[i].id+"//";						// 식별번호
		if ( nodes[i].pId == "null" || !nodes[i].pId ) nodes[i].pId = "0";
		ajaxData += nodes[i].pId+"//";						// 부모식별번호
		ajaxData += (nodes[i].getIndex()+1)+"//";			// 정렬번호
		ajaxData += nodes[i].level;							// Depth 번호
	}
	//춘해대는 POST ajax 전송을 받지못하고 있음. 서버가 실서버 중이라 손대지 아니함.
	//console.log(ajaxData);
	// 2023.11.10 - ajax :: 403 error. 
	// 2024.01.10 - 전송방식 변경 : POST > GET
	// _data의 길이가 2048자 이상인 경우, 제대로 변경되지 않음
	if ( ajaxData.length <= 2030 ) {
		var _data = {"mode": "order", "TREE_ID": TREE_ID, "data": ajaxData};
		$.ajax({
			type: "GET",
			//url: "ajax.tree.lib.php",
			url: "/adframe/mng/menu/ajax.tree.lib.php",
			dataType: "text",
			data: _data,
			success: function (data) {
				alert("저장되었습니다.");
				$.loader('close');
				//parent.document.location.reload();
				document.location.reload();
				//console.log( JSON.parse(data) );
			}, error: function(xhr) {
				// do nothing
				console.log(xhr);
			}
		});
	} else {
		alert("저장될 데이터가 너무 큽니다. 관리자에게 문의바랍니다.");
		$.loader('close');
		return false;
	}
}

// ############################ 마우스 오버 이벤트, 우측 메뉴 컨트롤 ############################
// 우측 메뉴 표시
function addHoverDom(treeId, treeNode) {
	var sObj = $("#" + treeNode.tId + "_span");
	if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
	var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
		+ "' title='add node' onfocus='this.blur();'></span>";
	sObj.after(addStr);
	var btn = $("#addBtn_" + treeNode.tId);
	if (btn) btn.bind("click", function () {
		// Sub-Element 추가
		if (newCount > 1) {
			alert("앞서 생성된 메뉴에 대한 정보를 입력한 뒤, 새로운 메뉴를 생성하실 수 있습니다.");	// 다중 입력 방지
			return false;
		} else {
			newCount++;
			var zTree = $.fn.zTree.getZTreeObj("trees");
			zTree.addNodes(treeNode, { id: (5000+newCount), pId: treeNode.id, name: "메뉴명을 입력하세요.", "mode": "new" });
		}
		//return false;
	});
};
// 우측 메뉴 미표시
function removeHoverDom(treeId, treeNode) {
	$("#addBtn_"+treeNode.tId).unbind().remove();
};

// ############################ Element 컨트롤 ############################
var newCount = 1;			// Element 추가 카운트
// Root Element 추가
function add(e) {
	if (newCount > 1) {
		alert("앞서 생성된 메뉴에 대한 정보를 입력한 뒤, 새로운 메뉴를 생성하실 수 있습니다.");
		return;
	} else {
		var zTree = $.fn.zTree.getZTreeObj("trees"), isParent = e.data.isParent, treeNode = "";
		treeNode = zTree.addNodes(null, {id:(5000+newCount), pId:0, isParent:isParent, name:"메뉴명을 입력하세요.", "mode": "new"});
		newCount++;
	}
}
// Element 삭제
function beforeRemove(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("trees");
	zTree.selectNode(treeNode);
	if ( confirm(" 하위 메뉴들도 같이 삭제됩니다. 삭제하시겠습니까? ") ) {
		$.ajax({
			type: "GET",
			url: "ajax.tree.lib.php",
			data: {"mode": "del", "TREE_NO": treeNode.id, "TREE_ID": TREE_ID},
			success: function(data) {
				if ( newCount > 1) newCount--;	// 다중 생성 방지
				if ( newCount < 1 ) newCount = 1;	// 여러개의 메뉴를 삭제해도 메뉴 생성을 위해서 고정값으로 주기
			}, error: function() { /* DO NOTHING */ }
		});
		return true;
	} else return false;
}
// Element 선택시, 클릭이벤트 ( 우측 정보 표기 )
function beforeClick(treeId, treeNode, clickFlag) {
	// 상위 카테고리 이름
	if ( treeNode.getParentNode() == null || treeNode.getParentNode() == "" ) $(".upperCategoryName").text("/");
	else $(".upperCategoryName").text(treeNode.getParentNode().name);

	// 하단 내용 입력 Frame 초기화
	$("#sub-ifrm-control").attr("src", "/adframe/mng/include/index.php?menu=blank");

	// 정보 입력
	var f = document.frm_menuInfo;					// 입력Form 확인
	f.TREE_NO.value = treeNode.id;					// 식별번호
	f.TREE_ID.value = TREE_ID;						// 분류
	f.PARENT.value = treeNode.pId;					// 부모식별번호
	f.DEPTH.value = treeNode.level;					// Depth 번호
	f.ORDER_NO.value = treeNode.getIndex() + 1;		// 정렬 번호
	f.NAME.value = treeNode.name;					// 메뉴 이름

	$("#hidden-select-1depth").show();			// 상세 정보 입력란 보여주기
	$("#subfrm-common").hide();					// 공통부분관리 버튼 감추가

	if ( treeNode.mode == "new" ) {
		// Element 추가
		$("#subfrm-contents").hide();				// 내용관리 버튼 감추기
		$("#depthMenu_image").hide();				// 대표이미지 버튼 감추가
		f.mode.value = treeNode.mode;				// 입력상태 입력
		$("#checkbox0101").attr('checked', false);	// 새창연결 '해제'
		$("#radio_Y").attr('checked', true);		// 표시상태 '표시'
	} else {
		// Element 정보 수정
		f.CONTENTS.value = treeNode.contents; // 내용 및 URL 추가
		// 새로 추가된 메뉴 구분 ( 예외처리 )
		//if ( treeNode.id > 5000 ) f.mode.value = "new";
		//else f.mode.value = "edit";

        f.mode.value = "edit";
		$("#ETC1").val(treeNode.ETC1); // 분류 상태
		// 내용관리 버튼 ( 해당 Element의 구분이 '컨텐츠'일 경우 )
		if ( $("#ETC1").val() == "CONTENTS" || $("#ETC1").val() == "TAB" ) $("#subfrm-contents").show();
		else $("#subfrm-contents").hide();
		// 대표이미지 버튼 ( 해당 Element의 구분이 '메뉴카테고리'일 경우 )
		if ( $("#ETC1").val() == "MENU" ) $("#depthMenu_image").show();
		else $("#depthMenu_image").hide();
		// 새창열림
		if ( treeNode.link_target == "1" ) $("#checkbox0101").attr('checked', true);
		else $("#checkbox0101").attr('checked', false);
		// 메뉴 표시 여부
		if ( treeNode.menu_on == "Y" ) $("#radio_Y").attr("checked", true);
		else $("#radio_N").attr("checked", true);
		$("#ETC2").val(treeNode.ETC2); //담당부서
		$("#ETC3").val(treeNode.ETC3); //담당자
		$("#ETC4").val(treeNode.ETC4); //이메일
		$("#ETC5").val(treeNode.ETC5); //전화번호
	}
	// 입력 포커스
	document.frm_menuInfo.NAME.focus();
}
// 메뉴 순서 저장
function asyncAll() {
	if (!check()) return;
	var zTree = $.fn.zTree.getZTreeObj("trees");
	if (asyncForAll) {
		//$("#demoMsg").text(demoMsg.asyncAll);
	} else {
		asyncNodes(zTree.getNodes());
		if (!goAsync) {
			//$("#demoMsg").text(demoMsg.asyncAll);
			curStatus = "";
		}
	}
}

// ############################ CMS Control 기타 버튼 ############################
// Element 정보입력 Form 초기화
function resetInfo(frm) {
	// 입력 FORM 초기화
	$(".upperCategoryName").text("");
	frm.reset();
	// 기본 정보 보여주는 내용을 제외하고 모두 감추기
	$("#hidden-select-1depth").hide();
	$("#depthMenu_image").hide();
	$("#subfrm-common").hide();
	$("#subfrm-contents").hide();
	frm.TREE_ID.value = TREE_ID;			// 분류값 삽입
}

// '확인' 버튼 이벤트 (  Element 삽입위치 및 상세정보 필수 입력사항 체크  )
function InsertMenu(frm) {
	// 상위 카테고리 위치 확인
	if ( $(".upperCategoryName").text() == "" ) {
		alert("메뉴를 삽입할 위치를 선택해주세요.");
		return;
	}
	// 메뉴명 입력 여부 확인
	if ( frm.NAME.value == "" ) {
		alert("메뉴명을 입력해주세요.");
		frm.NAME.focus();
		return;
	}
	frm.action = "tree.manage.proc.php";
	frm.submit();
}

// ############################ TREE 실행 ############################
$(document).ready(function(){
	$.fn.zTree.init($("#trees"), setting);						// Tree 생성

	$(".addParent").bind("click", {isParent: false}, add);		// Element 추가
	$(".saveMenuList").bind("click", saveOrderMenuList);					// Element 순서 저장

	// 처음 로딩시, 감춰질 내용
	$("#hidden-select-1depth").hide();		// 메뉴명을 제외한 나머지 입력부분
	$("#subfrm-common").hide();				// 공통부분관리버튼
	$("#subfrm-contents").hide();			// 컨텐츠내용관리버튼
	$("#depthMenu_image").hide();			// 대표이미지 등록 버튼
});
