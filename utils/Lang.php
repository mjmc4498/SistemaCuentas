<?php
class Lang {
    private static $translations = [];

    public static function load($lang = 'es') {
        $file = "../lang/$lang.json";
        if (file_exists($file)) {
            self::$translations = json_decode(file_get_contents($file), true);
        }
    }

    public static function get($key) {
        return self::$translations[$key] ?? $key;
    }
}
?>
