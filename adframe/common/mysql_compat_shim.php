<?php
// PHP7 호환 shim: ext/mysql(mysql_*)이 PHP 5.5+에서 폐지, PHP 7.0에서 완전히 제거되면서
// 코드 전반(약 140개 파일)의 mysql_* 호출이 전부 치명적 오류를 일으키던 것을 막기 위한 대체 구현.
// mysqli 위에서 동작하며, 명시적 mysql_connect() 없이 쓰이던 기존 코드 관행에 맞춰
// 최초 호출 시 사이트 기본 DB로 지연 연결한다(기본값 ch_2020, 사이트별 override는
// MYSQL_SHIM_DEFAULT_* 상수 참고). 신규 코드는 mysqli_*를 직접 사용할 것.
if (!function_exists('mysql_connect')) {

    if (!defined('MYSQL_ASSOC')) define('MYSQL_ASSOC', MYSQLI_ASSOC);
    if (!defined('MYSQL_NUM'))   define('MYSQL_NUM', MYSQLI_NUM);
    if (!defined('MYSQL_BOTH'))  define('MYSQL_BOTH', MYSQLI_BOTH);

    function mysql_connect($host = 'localhost', $user = 'root', $pass = 'se130901') {
        $link = @mysqli_connect($host ?: 'localhost', $user, $pass);
        if ($link) {
            $GLOBALS['__mysql_shim_link'] = $link;
        }
        return $link;
    }

    // $explicit=false(링크 인자 생략)일 때만 공용 기본 연결로 대체한다.
    // 링크 인자가 실제로 넘어왔는데 mysqli 인스턴스가 아니면(예: PEAR DB 객체를
    // mysql_close($adb)처럼 잘못 넘긴 경우) 원래 ext/mysql처럼 조용히 실패시켜야
    // 한다 — 이걸 공용 연결로 대체해버리면 코드가 실수로 공용 연결을 끊는 등
    // 엉뚱한 부작용이 생긴다.
    function __mysql_shim_link($link, $explicit) {
        if ($explicit) {
            return ($link instanceof mysqli) ? $link : false;
        }
        if (!empty($GLOBALS['__mysql_shim_link'])) {
            return $GLOBALS['__mysql_shim_link'];
        }
        // 과거 php.ini의 mysql.default_* 설정으로 암묵적 연결에 의존하던 코드 호환.
        // 이 shim 파일은 여러 사이트(각기 다른 DB)에서 재사용되므로, 사이트별
        // inc.constant.php에서 이 파일을 require 하기 전에 MYSQL_SHIM_DEFAULT_HOST/
        // USER/PASS/DB 상수를 정의해두면 그 값을 쓰고, 없으면 기존 ch.ac.kr 메인
        // 사이트 기본값으로 대체된다.
        $link = @mysqli_connect(
            defined('MYSQL_SHIM_DEFAULT_HOST') ? MYSQL_SHIM_DEFAULT_HOST : 'localhost',
            defined('MYSQL_SHIM_DEFAULT_USER') ? MYSQL_SHIM_DEFAULT_USER : 'root',
            defined('MYSQL_SHIM_DEFAULT_PASS') ? MYSQL_SHIM_DEFAULT_PASS : 'se130901',
            defined('MYSQL_SHIM_DEFAULT_DB')   ? MYSQL_SHIM_DEFAULT_DB   : 'ch_2020'
        );
        if ($link) {
            $GLOBALS['__mysql_shim_link'] = $link;
        }
        return $link;
    }

    function mysql_select_db($db, $link = null) {
        $link = __mysql_shim_link($link, func_num_args() > 1);
        return $link ? mysqli_select_db($link, $db) : false;
    }

    function mysql_query($query, $link = null) {
        $link = __mysql_shim_link($link, func_num_args() > 1);
        return $link ? mysqli_query($link, $query) : false;
    }

    function mysql_fetch_array($result, $type = MYSQLI_BOTH) {
        return $result ? mysqli_fetch_array($result, $type) : false;
    }

    function mysql_fetch_assoc($result) {
        return $result ? mysqli_fetch_assoc($result) : false;
    }

    function mysql_num_rows($result) {
        return $result ? mysqli_num_rows($result) : 0;
    }

    function mysql_affected_rows($link = null) {
        $link = __mysql_shim_link($link, func_num_args() > 0);
        return $link ? mysqli_affected_rows($link) : 0;
    }

    function mysql_insert_id($link = null) {
        $link = __mysql_shim_link($link, func_num_args() > 0);
        return $link ? mysqli_insert_id($link) : 0;
    }

    function mysql_error($link = null) {
        $link = __mysql_shim_link($link, func_num_args() > 0);
        return $link ? mysqli_error($link) : mysqli_connect_error();
    }

    function mysql_errno($link = null) {
        $link = __mysql_shim_link($link, func_num_args() > 0);
        return $link ? mysqli_errno($link) : mysqli_connect_errno();
    }

    function mysql_real_escape_string($str, $link = null) {
        $link = __mysql_shim_link($link, func_num_args() > 1);
        return $link ? mysqli_real_escape_string($link, $str) : addslashes($str);
    }

    function mysql_escape_string($str) {
        return addslashes($str);
    }

    function mysql_close($link = null) {
        $link = __mysql_shim_link($link, func_num_args() > 0);
        return $link ? mysqli_close($link) : false;
    }
}
