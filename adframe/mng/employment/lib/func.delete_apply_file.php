<?php
// 채용 지원서 삭제 시 첨부파일(file_name, file_name2 ...)도 함께 삭제하기 위한 공통 함수.
// 저장 경로: /home/dev/pub/main + "/recruit(또는 recruit4)/file_data/날짜[/타임스탬프]/파일"
// 안전장치: 허용 디렉토리(file_data) 하위가 아니면 삭제하지 않는다. (.. 경로 조작 방지)
if (!function_exists('delete_apply_file')) {
	function delete_apply_file($web_path) {
		$web_path = trim((string)$web_path);
		if ($web_path === '' || strpos($web_path, "\0") !== false) return false;
		if (!preg_match('#^/recruit[0-9]*/file_data/#', $web_path)) return false;

		$base = realpath("/home/dev/pub/main");
		if ($base === false) return false;
		$real = realpath($base . $web_path);
		if ($real === false || !is_file($real)) return false;

		// 허용 디렉토리(file_data) 밖이면 거부
		$prefix = $base . DIRECTORY_SEPARATOR;
		if (strpos($real, $prefix) !== 0) return false;
		if (!preg_match('#/recruit[0-9]*/file_data/#', str_replace('\\', '/', $real))) return false;

		$ok = @unlink($real);

		// 중복파일용 하위 폴더(file_data/날짜/타임스탬프)가 비었으면 정리. 날짜 폴더는 건드리지 않는다.
		if ($ok) {
			$dir = dirname($real);
			if (preg_match('#/file_data/[^/]+/[^/]+$#', str_replace('\\', '/', $dir))) {
				@rmdir($dir); // 비어있을 때만 성공
			}
		}
		return $ok;
	}
}
