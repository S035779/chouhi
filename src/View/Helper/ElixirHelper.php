<?php

namespace App\View\Helper;

use Cake\View\Helper;

class ElixirHelper extends Helper {

    /**
     * Get the path to a versioned Elixir file.
     *
     * @param  string  $file
     * @param  string  $buildDirectory
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    function version($file, $buildDirectory = 'build')
    {

        static $manifest = [];
        static $manifestPath;

        if (empty($manifest) || $manifestPath !== $buildDirectory) {
            $path = WWW_ROOT.$buildDirectory.'/rev-manifest.json';

            if (file_exists($path)) {
                $manifest = json_decode(file_get_contents($path), true);
                $manifestPath = $buildDirectory;
            }
        }

        if (isset($manifest[$file])) {
            return '/'.trim($buildDirectory.'/'.$manifest[$file], '/');
        }

        $unversioned = WWW_ROOT.$file;

        if (file_exists($unversioned)) {
            return '/'.trim($file, '/');
        }

        throw new \InvalidArgumentException("File {$file} not defined in asset manifest.");
    }
}
