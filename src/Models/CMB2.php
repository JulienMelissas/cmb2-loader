<?php

namespace Schrapel\CMB2Loader\Models;

use Noodlehaus\Config;

class CMB2
{
    /**
     * @var Config
     */
    private $config;

    /**
     * CMB2 constructor.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function run()
    {
        if ($this->isDisabled()) {
            return;
        }

        $box = $this->registerBox($this->config->all());

        foreach ($this->config['fields'] as $field) {
            $field = $box->add_field($field);

            if (isset($field['fields'])) {
                foreach ($field['fields'] as $group_field) {
                    $box->add_group_field($field, $group_field);
                }
            }
        }
    }

    public function registerBox(array $box) : \CMB2
    {
        return new_cmb2_box($box);
    }

    private function isDisabled()
    {
        return $this->config['active'] === false;
    }
}
