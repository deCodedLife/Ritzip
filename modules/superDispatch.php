<?php

/**
 * @file
 * Интеграция с IP телефонией Дом.ру
 */

class superDispatch {

    /**
     * Настройки IP
     */
    private $settings = null;

    function __construct ( $superDispatchSettings ) {

        /**
         * Подключение настроек IP телефонии
         */
        $this->settings = $superDispatchSettings;

    } // function. __construct

    public function getAccounts () {

    }

} // class. Services

$superDispatch = new superDispatch( $settings );