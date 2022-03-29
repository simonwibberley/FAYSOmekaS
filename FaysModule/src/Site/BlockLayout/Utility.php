<?php

namespace FaysModule\Site\BlockLayout;

class Utility {
    public static function fieldName($name) {
        return sprintf('o:block[__blockIndex__][o:data][%s]', $name);
    }

    public static function parseCol(string $prefix, string $raw) {
        $pos = strpos($raw, $prefix);

        $result = false;

        $n = strlen($prefix);

        if($pos !== false) {
            $result = substr($raw, $pos + $n, 2);
            $result = is_numeric($result) ? $result : substr($raw, $pos + $n, 1);
        }

        return $result;
    }

    public static function parse(string $raw): array
    {
        return [
            'xs'  => Utility::parseCol("xs", $raw),
            'xso' => Utility::parseCol("xso", $raw),
            'sm'  => Utility::parseCol("sm", $raw),
            'smo' => Utility::parseCol("smo", $raw),
            'md'  => Utility::parseCol("md", $raw),
            'mdo' => Utility::parseCol("mdo", $raw),
            'lg'  => Utility::parseCol("lg", $raw),
            'lgo' => Utility::parseCol("lgo", $raw)
        ];
    }
}


//echo Utility::parseCol("md", "sm12 smo0 md6 md0");

?>
