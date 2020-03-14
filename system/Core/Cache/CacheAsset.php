<?php

namespace Racoon\Core\Cache;

use Racoon\Core\Facade\App;
use Racoon\Lib\Locale\LocaleFactory;

class CacheAsset extends CacheBase {

    protected $path;
    protected $ext = '.php';

    protected $context;
    protected $factory;
    protected $file;
    protected $data = [];
    protected $enables;

    protected $locale_data;

    public function __construct(CacheFactory $factory) {
        $this->factory = $factory;
        $this->context = $factory->getContext();
        $this->file = $factory->getFile();

        $this->path = App::root() . 'asset/';
        $this->enables = $factory->configData('assets');

        if($factory->exist() && $factory->enabled()) {
            $this->data = $factory->read();
            
            if($this->enables['locale'] ?? false) {
                $this->locale_data = $this->data['locale'] ?? null;
            }
        }
    }

    /**
     * Return cache locale.
     */

    public function locale() {
        return is_null($this->locale_data) ? $this->cacheAllLocale() : $this->locale_data;
    }

    /**
     * Return list of locale files.
     */

    private function getLocaleFiles() {
        return array_diff(scandir($this->path . 'locale'), ['.', '..']);
    }

    /**
     * Load all locale files.
     */

    private function cacheAllLocale() {
        $files = $this->getLocaleFiles();
        $dataset = [];

        foreach($files as $file) {
            $this->loadFile($this->path . 'locale/' . $file);
            $name = explode('.', $file)[0];
            $set = [];

            $factory = LocaleFactory::getRegisteredLocale();
            foreach($factory as $key => $data) {
                $set[$key] = $data->getLabelData();
            }

            $dataset[$name] = $set;
        }

        $this->locale_data = $dataset;
        $this->data['locale'] = $dataset;

        if(($this->enables['locale'] ?? false) && $this->factory->enabled()) {
            $this->factory->write($this->data);
        }

        return $dataset;
    }

}