<?php


namespace Phizzl\Codeception\Modules\Translations;

use Codeception\Exception\ModuleException;
use Codeception\Module;
class TranslationsModule extends Module
{
    /**
     * @var Translator
     */
    private $translator;

    /**
     * @throws ModuleException
     */
    public function _initialize()
    {
        parent::_initialize();

        $translations = [];
        if(isset($this->config['translations'])
            && is_array($this->config['translations'])){
            $translations = $this->config['translations'];
        }

        $this->translator = new Translator($translations);
    }

    /**
     * @param string $string
     * @return string
     */
    public function translate($string)
    {
        return $this->translator->translate($string);
    }
}