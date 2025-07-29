<?php
/**
 * Class Lang
 *
 * Handles multi-language support.
 */
class Lang {
    /**
     * @var array The loaded translations.
     */
    private static $translations = [];

    /**
     * Loads a language file.
     *
     * @param string $lang The language to load (e.g., 'es', 'en').
     */
    public static function load($lang = 'es') {
        $file = "../lang/$lang.json";
        if (file_exists($file)) {
            self::$translations = json_decode(file_get_contents($file), true);
        }
    }

    /**
     * Gets a translated string by its key.
     *
     * @param string $key The key of the translation string.
     * @return string The translated string or the key if not found.
     */
    public static function get($key) {
        return self::$translations[$key] ?? $key;
    }
}
?>
