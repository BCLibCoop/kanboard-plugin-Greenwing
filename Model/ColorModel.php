<?php

namespace Kanboard\Plugin\Greenwing\Model;

/**
 * Color model
 *
 * @package  Kanboard\Model
 * @author   Frederic Guillot
 */
class ColorModel extends \Kanboard\Model\ColorModel
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
            'color' => '#fbda38',
            'background' => '#fef6ce',
            'border' => '#fad106',
        ),
        'blue' => array(
            'name' => 'Blue',
            'color' => '#4694ff',
            'background' => '#dfecff',
            'border' => '#1377ff',
        ),
        'green' => array(
            'name' => 'Green',
            'color' => '#4ba975',
            'background' => '#b1dcc4',
            'border' => '#3b865d',
        ),
        'purple' => array(
            'name' => 'Purple',
            'color' => '#856be2',
            'background' => '#eeebfb',
            'border' => '#6240da',
        ),
        'red' => array(
            'name' => 'Red',
            'color' => '#ff2a2a',
            'background' => '#ffc3c3',
            'border' => '#f60000',
        ),
        'orange' => array(
            'name' => 'Orange',
            'color' => '#fb9531',
            'background' => '#fee2c7',
            'border' => '#f47b05',
        ),
        'grey' => array(
            'name' => 'Grey',
            'color' => '#a09c9c',
            'background' => '#ebeaea',
            'border' => '#878282',
        ),
        'brown' => array(
            'name' => 'Brown',
            'color' => '#ab6333',
            'background' => '#e0b497',
            'border' => '#844c27',
        ),
        'deep_orange' => array(
            'name' => 'Deep Orange',
            'color' => '#e66e0b',
            'background' => '#fac090',
            'border' => '#b55709',
        ),
        'dark_grey' => array(
            'name' => 'Dark Grey',
            'color' => '#737373',
            'background' => '#c0c0c0',
            'border' => '#5a5a5a',
        ),
        'pink' => array(
            'name' => 'Pink',
            'color' => '#f546d5',
            'background' => '#fdd7f6',
            'border' => '#f216ca',
        ),
        'teal' => array(
            'name' => 'Teal',
            'color' => '#49b1c1',
            'background' => '#bbe2e8',
            'border' => '#3792a0',
        ),
        'cyan' => array(
            'name' => 'Cyan',
            'color' => '#49cce0',
            'background' => '#ccf1f6',
            'border' => '#24bbd2',
        ),
        'lime' => array(
            'name' => 'Lime',
            'color' => '#5fc55f',
            'background' => '#cfeecf',
            'border' => '#40b140',
        ),
        'light_green' => array(
            'name' => 'Light Green',
            'color' => '#4af74a',
            'background' => '#ddfddd',
            'border' => '#19f519',
        ),
        'amber' => array(
            'name' => 'Amber',
            'color' => '#f1d042',
            'background' => '#fcf3d0',
            'border' => '#edc413',
        ),
    );

    /**
     * Get available colors
     *
     * Extended to use the default language for filtering purposes
     *
     * @access public
     * @param  bool $prepend
     * @param  bool $defaultLanguage
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
     * Output CSS custom properties for colors
     *
     * @access public
     * @return string
     */
    public function getCss()
    {
        $buffer = ':root {';

        foreach ($this->default_colors as $color => $values) {
            foreach ($values as $type => $value) {
                $buffer .= "--task-color-{$color}-{$type}: {$value};";
            }
        }

        $buffer .= '}';

        return $buffer;
    }
}
