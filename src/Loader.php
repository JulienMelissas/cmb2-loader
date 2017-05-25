<?php

namespace Schrapel\CMB2Loader;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Noodlehaus\Config;
use Schrapel\CMB2Loader\Models\CMB2;

class Loader
{
    /**
     * @var array
     */
    private $paths;

    /**
     * Loader constructor.
     *
     * @param array|null $paths
     */
    public function __construct(array $paths = null)
    {
        $this->paths = $paths ?? $this->getPaths();
    }

    /**
     * Get the current paths
     *
     * @return array
     */
    private function getPaths() : array
    {
        if (! has_filter('schrapel/cmb2-loader/paths')) {
            return [
                get_stylesheet_directory() . '/cmb2',
            ];
        }

        return apply_filters('schrapel/cmb2-loader/paths', $this->paths);
    }

    /**
     * Load the configs
     */
    public function load()
    {
        foreach ($this->paths as $path) {
            if (! file_exists($path)) {
                continue;
            }

            $directories = new RecursiveDirectoryIterator($path);
            foreach (new RecursiveIteratorIterator($directories) as $filename => $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), [ 'json', 'php', 'yml', 'yaml' ], true)) {
                    $this->route(new Config($file));
                }
            }
        }
    }

    /**
     * Route to class
     *
     * @param Config $config
     */
    protected function route(Config $config)
    {
        if (isset($config['id'])) {
            ( new CMB2($config) )->run();
        }
    }
}
