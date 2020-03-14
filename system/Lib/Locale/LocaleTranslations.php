<?php

namespace Racoon\Lib\Locale;

abstract class LocaleTranslations {

    /**
     * Contains all locale translation methods.
     */

    public function en(string $label) {
        $this->label['en'] = $label;
        return $this;
    }

}