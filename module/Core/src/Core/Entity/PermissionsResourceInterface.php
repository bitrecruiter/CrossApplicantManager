<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2104 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

/** PermissionsInterface.php */ 
namespace Core\Entity;

interface PermissionsResourceInterface 
{
    public function getPermissionsResourceId();
    public function getPermissionsUserIds();
}

