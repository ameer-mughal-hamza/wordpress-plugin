<?php
/**
 * @Package TestBJS
 */

class TestBJSPluginActivate
{
    public static function activate()
    {
        flush_rewrite_rules();
    }
}