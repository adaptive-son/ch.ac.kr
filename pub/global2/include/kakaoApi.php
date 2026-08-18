<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

<!-- 3. 실행 스크립트 -->
<script charset="UTF-8">
new daum.roughmap.Lander({
    "timestamp" : "1709084509390",
    "key" : "2iafy",
    // "mapWidth" : "640",
    "mapHeight" : "420"
}).render();
</script>

<script>
var mapContainer = document.getElementById('map');
var mapOption = {
center: new kakao.maps.LatLng(37.5665, 126.9780), // 지도 중심 좌표 (서울)
level: 4 // 지도 확대 레벨
};

// 지도 생성
var map = new kakao.maps.Map(mapContainer, mapOption);

// 창 크기 조절 이벤트
window.addEventListener('resize', function() {
// 창 크기가 변경될 때 지도 크기 재조절
map.relayout();
});
</script>
