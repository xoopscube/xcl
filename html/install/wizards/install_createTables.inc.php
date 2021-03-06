<?php
/**
 *
 * @package Legacy
 * @version $Id: install_createTables.inc.php,v 1.3 2008/09/25 15:12:35 kilica Exp $
 * @copyright Copyright 2005-2021 XOOPS Cube Project  <https://github.com/xoopscube/legacy>
 * @license https://github.com/xoopscube/legacy/blob/master/docs/GPL_V2.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */
include_once '../mainfile.php';
include_once './class/dbmanager.php';

$dbm = new db_manager();

$tables = [];

$result = $dbm->queryFromFile('./sql/' . ((XOOPS_DB_TYPE === 'mysqli') ? 'mysql' : XOOPS_DB_TYPE) . '.structure.sql');

$wizard->assign('reports', $dbm->report());
if (!$result) {
    $wizard->assign('message', _INSTALL_L114);
    $wizard->setBack(['start', _INSTALL_L103]);
} else {
    $wizard->assign('message', _INSTALL_L115);
}
$wizard->render('install_createTables.tpl.php');
