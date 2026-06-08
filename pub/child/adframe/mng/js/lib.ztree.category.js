// 기본 정보
var PMENU = $("#PMENU").val();			// 부모창 PK

// Plug-in 기본 설정
var setting = {
	async: {
		enable: true,
		url:"../category/ajax.tree.data.php",
		autoParam:["id", "level"],
		otherParam: {"PMENU": PMENU},
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
	curAsyncCount--;
	if (curStatus == "expand") expandAll();								// 자동펼침
	else if (curStatus == "async") asyncNodes(treeNode.children);		// 하위 Element 정보 불러오기 ( 펼치지 않음 )

	if (curAsyncCount <= 0) {
		if (curStatus != "init" && curStatus != "") asyncForAll = true;
		curStatus = "";
	}
	if ( curStatus == "async" ) doneAsync = true;
	// 시작시 전체 카테고리 불러오기
	asyncAll();
}
function onAsyncError(event, treeId, treeNode, XMLHttpRequest, textStatus, errorThrown) {
	curAsyncCount--;
	if (curAsyncCount <= 0) {
		curStatus = "";
		if (treeNode!=null) asyncForAll = true;
	}
}


// ############################ 카테고리 펼침, 접기 컨트롤 ############################
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
// 목록펼침없이 하위카테고리 불러오기
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
// 카테고리 순서 저장
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
	$.ajax({
		type: "POST",
		url: "ajax.tree.lib.php",
		data: {"mode": "order", "data": ajaxData},
		success: function (data) {
			alert("저장되었습니다.");
			$.loader('close');
		}, error: function() {
			// do nothing
		}
	});
}

// ############################ 마우스 오버 이벤트, 우측 카테고리 컨트롤 ############################
// 우측 카테고리 표시
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
			alert("앞서 생성된 카테고리에 대한 정보를 입력한 뒤, 새로운 카테고리를 생성하실 수 있습니다.");	// 다중 입력 방지
			return false;
		} else {
			newCount++;
			var zTree = $.fn.zTree.getZTreeObj("trees");
			zTree.addNodes(treeNode, { id: (5000+newCount), pId: treeNode.id, name: "카테고리명을 입력하세요.", "mode": "new" });
		}
		//return false;
	});
};
// 우측 카테고리 미표시
function removeHoverDom(treeId, treeNode) {
	$("#addBtn_"+treeNode.tId).unbind().remove();
};

// ############################ Element 컨트롤 ############################
var newCount = 1;			// Element 추가 카운트
// Root Element 추가
function add(e) {
	if (newCount > 1) {
		alert("앞서 생성된 카테고리에 대한 정보를 입력한 뒤, 새로운 카테고리를 생성하실 수 있습니다.");
		return;
	} else {
		var zTree = $.fn.zTree.getZTreeObj("trees"), isParent = e.data.isParent, treeNode = "";
		treeNode = zTree.addNodes(null, {id:(5000+newCount), pId:0, isParent:isParent, name:"카테고리명을 입력하세요.", "mode": "new"});
		newCount++;
	}
}
// Element 삭제
function beforeRemove(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("trees");
	zTree.selectNode(treeNode);
	if ( confirm(" 하위 카테고리들도 같이 삭제됩니다. 삭제하시겠습니까? ") ) {
		$.ajax({
			type: "POST",
			url: "ajax.tree.lib.php",
			data: {"mode": "del", "TREE_NO": treeNode.id, },
			success: function(data) {
				if ( newCount > 1) newCount--;	// 다중 생성 방지
				if ( newCount < 1 ) newCount = 1;	// 여러개의 카테고리를 삭제해도 카테고리 생성을 위해서 고정값으로 주기
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


	// 정보 입력
	var f = document.frm_menuInfo;					// 입력Form 확인
	f.TREE_NO.value = treeNode.id;					// 식별번호
	f.PARENT.value = treeNode.pId;					// 부모식별번호
	f.DEPTH.value = treeNode.level;					// Depth 번호
	f.ORDER_NO.value = treeNode.getIndex() + 1;		// 정렬 번호
	f.NAME.value = treeNode.name;					// 카테고리 이름

	$("#subfrm-common").hide();					// 공통부분관리 버튼 감추가

	if ( treeNode.mode == "new" ) {
		// Element 추가
		f.mode.value = treeNode.mode;				// 입력상태 입력
		$("#checkbox0101").attr('checked', false);	// 새창연결 '해제'
		$("#radio_Y").attr('checked', true);		// 표시상태 '표시'
	} else {
		// 새로 추가된 카테고리 구분 ( 예외처리 )
		//if ( treeNode.id > 5000 ) f.mode.value = "new";
		//else f.mode.value = "edit";
        f.mode.value = "edit";
	}
	// 입력 포커스
	document.frm_menuInfo.NAME.focus();
}
// 카테고리 순서 저장
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
	$("#subfrm-common").hide();
}

// '확인' 버튼 이벤트 (  Element 삽입위치 및 상세정보 필수 입력사항 체크  )
function InsertMenu(frm) {
	// 상위 카테고리 위치 확인
	if ( $(".upperCategoryName").text() == "" ) {
		alert("카테고리를 삽입할 위치를 선택해주세요.");
		return;
	}
	// 카테고리명 입력 여부 확인
	if ( frm.NAME.value == "" ) {
		alert("카테고리명을 입력해주세요.");
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
	$("#subfrm-common").hide();				// 공통부분관리버튼
});
