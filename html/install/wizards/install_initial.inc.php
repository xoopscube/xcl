<?php
/**
 *
 * @package Legacy
 * @version $Id: install_initial.inc.php,v 1.3 2008/09/25 15:12:17 kilica Exp $
 * @copyright Copyright 2005-2021 XOOPS Cube Project  <https://github.com/xoopscube/legacy>
 * @license https://github.com/xoopscube/legacy/blob/master/docs/GPL_V2.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */
// confirm database setting
include_once '../mainfile.php';

$wizard->render('install_initial.tpl.php');
