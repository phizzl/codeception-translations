<?php


namespace Phizzl\Codeception\Modules\Translations;


class Translator
{
    /**
     * @var array
     */
    private $translations;

    /**
     * I18n constructor.
     * @param array $translations
     */
    public function __construct(array $translations)
    {
        $this->translations = $translations;
    }

    /**
     * @param string $string
     * @return string
     */
    public function translate($string)
    {
        if(strpos($string, "\${") !== false
            && preg_match_all('/\\${([^}]+)}/', $string, $matches, PREG_SET_ORDER, 0)){
            return $this->translateKeysInString($string, $matches);
        }

        return isset($this->translations[$string]) ? $this->translations[$string] : $string;
    }

    /**
     * @param string $string
     * @param array $matches
     * @return string
     */
    private function translateKeysInString($string, array $matches)
    {
        foreach($matches as $match){
            $string = str_replace($match[0], $this->get($match[1]), $string);
        }

        return $string;
    }
}