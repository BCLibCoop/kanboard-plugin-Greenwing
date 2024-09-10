<?php

namespace Kanboard\Plugin\Greenwing\Model;

use Kanboard\Model\ColorModel as BaseColorModel;

class ColorModel extends BaseColorModel
{
    /**
     * Default colors
     *
     * @access protected
     * @var array
     */
    protected $default_colors = array(
        'yellow' => array(
            'name' => 'Yellow',
        ),
        'blue' => array(
            'name' => 'Blue',
        ),
        'green' => array(
            'name' => 'Green',
        ),
        'purple' => array(
            'name' => 'Purple',
        ),
        'red' => array(
            'name' => 'Red',
        ),
        'orange' => array(
            'name' => 'Orange',
        ),
        'grey' => array(
            'name' => 'Grey',
        ),
        'brown' => array(
            'name' => 'Brown',
        ),
        'deep_orange' => array(
            'name' => 'Deep Orange',
        ),
        'dark_grey' => array(
            'name' => 'Dark Grey',
        ),
        'pink' => array(
            'name' => 'Pink',
        ),
        'teal' => array(
            'name' => 'Teal',
        ),
        'cyan' => array(
            'name' => 'Cyan',
        ),
        'lime' => array(
            'name' => 'Lime',
        ),
        'light_green' => array(
            'name' => 'Light Green',
        ),
        'amber' => array(
            'name' => 'Amber',
        ),
    );

    /**
     * Get available colors
     *
     * @access public
     * @param  bool $prepend
     * @return array
     */
    public function getList($prepend = false, $defaultLanguage = false)
    {
        $listing = $prepend ? array('' => t('All colors')) : array();
        foreach ($this->default_colors as $color_id => $color) {
            $listing[$color_id] = $defaultLanguage ? $color['name'] : t($color['name']);
        }

        $this->hook->reference('model:color:get-list', $listing);

        return $listing;
    }

    /**
     * Get CSS stylesheet of all colors
     *
     * @access public
     * @return string
     */
    public function getCss()
    {
        return '';
    }
}
