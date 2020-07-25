<?php

namespace GGBear\Validation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

class ValidatorFactory
{
    public $dirLang;
    public $filenameMessages;
    /**
     * @var Factory
     */
    public $factory;
    public $dirErrorMessages;
    // Translations root directory
    public $basePath;
    public static $translator;

    public function __construct($dirLang = 'en', $dirErrorMessages = 'ErrorMessages', $filenameMessages = 'validation')
    {
        $this->dirLang = $dirLang;
        $this->filenameMessages = $filenameMessages;
        $this->dirErrorMessages = $dirErrorMessages;
        $this->basePath = $this->getTranslationsRootPath();
        $this->factory = new Factory($this->loadTranslator());
    }

    public function translationsRootPath(string $path = '')
    {
        if (!empty($path)) {
            $this->basePath = $path;
            $this->reloadValidatorFactory();
        }
        return $this;
    }

    private function reloadValidatorFactory()
    {
        $this->factory = new Factory($this->loadTranslator());
        return $this;
    }

    public function getTranslationsRootPath(): string
    {
        return dirname(__FILE__) . '/';
    }

    public function loadTranslator(): Translator
    {
        $loader = new FileLoader(new Filesystem(), $this->basePath . $this->dirErrorMessages);
        $loader->addNamespace($this->dirErrorMessages, $this->basePath . $this->dirErrorMessages);
        $loader->load($this->dirLang, $this->filenameMessages, $this->dirErrorMessages);
        return static::$translator = new Translator($loader, $this->dirLang);
    }

    public function __call($method, $args)
    {
        return $this->factory->$method(...$args);
    }
}
