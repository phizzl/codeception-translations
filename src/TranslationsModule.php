<?php


namespace Phizzl\Codeception\Modules\Translations;

use Codeception\Exception\ModuleException;
use Codeception\Module;
use Symfony\Component\Yaml\Yaml;

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
        if(isset($this->config['translations'])){
            $translations = is_array($this->config['translations'])
                ? $this->config['translations']
                : $this->loadFromFile($this->config['translations']);
        }

        $this->translator = new Translator($translations);
    }

    /**
     * @param string $file
     * @return array
     * @throws ModuleException
     */
    private function loadFromFile($file)
    {
        if(!in_array(substr($file, 0 , 1), ["\\", "/"])){
            $file = \Codeception\Configuration::dataDir() . $file;
        }

        if(!is_file($file)){
            throw new ModuleException($this, "file cannot be found -> \"$file\"");
        }

        return Yaml::parse(file_get_contents($file));
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