<?php

namespace Src\Providers;

class AbstractService {
    /**
     * @param String $apiKey
     *Valida se a chave da API é valida
     * @return bool
     */
    function isValidApiKey( String $apiKey) : bool {
        if ($apiKey == '862a2f7d-a9a4-488a-a3d8-299e9875df7es') {
            return true;
        }
        return false;
    }
}