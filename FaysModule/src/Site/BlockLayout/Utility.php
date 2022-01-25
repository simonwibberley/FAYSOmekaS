<?php

namespace FaysModule\Site\BlockLayout;

class Utility {
    public static function fieldName($name) {
        return sprintf('o:block[__blockIndex__][o:data][%s]', $name);
    }
}
?>
