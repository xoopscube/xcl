<?php
/**
 *
 * @package Legacy
 * @version $Id: session.php,v 1.5 2008/09/25 15:12:44 kilica Exp $
 * @copyright Copyright 2005-2021 XOOPS Cube Project  <https://github.com/xoopscube/legacy>
 * @license https://github.com/xoopscube/legacy/blob/master/docs/GPL_V2.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

/**
  * Regenerate New Session ID & Delete OLD Session
  * @deprecated
  */

function xoops_session_regenerate()
{
    $root =& XCube_Root::getSingleton();
    if (!isset($_SESSION)) {
      $root->mSession->regenerate();
    }
}
