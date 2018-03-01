<?php

/**
 * iPhorm_Filter_Filename
 *
 * Sanitises a filename
 *
 * @package iPhorm
 * @subpackage Filter
 * @copyright Copyright (c) 2009-2011 ThemeCatcher (http://www.themecatcher.net)
 */
class iPhorm_Filter_Filename implements iPhorm_Filter_Interface
{
    /**
     * Sanitise a filename
     *
     * @param string $value The value to filter
     * @return string The filtered value
     */
    public function filter($value)
    {
        return sanitize_file_name($value);
    }
}