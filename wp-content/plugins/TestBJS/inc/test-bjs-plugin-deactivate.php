<?php
/**
 * @Package TestBJS
 */

class TestBJSPluginDeactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}