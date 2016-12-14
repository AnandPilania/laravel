<?php

$leftMenu = Menu::instance('admin-menu');

$rightMenu = Menu::instance('admin-menu-right');

Event::fire('admin::menus');
/**
 * @see https://github.com/pingpong-labs/menus
 * 
 * @example adding additional menu.
 *
 * $leftMenu->url('your-url', 'The Title');
 * 
 * $leftMenu->route('your-route', 'The Title');
 */

