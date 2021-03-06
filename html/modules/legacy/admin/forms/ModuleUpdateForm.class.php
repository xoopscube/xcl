<?php
/**
 *
 * @package Legacy
 * @version $Id: ModuleUpdateForm.class.php,v 1.3 2008/09/25 15:10:55 kilica Exp $
 * @copyright Copyright 2005-2021 XOOPS Cube Project  <https://github.com/xoopscube/legacy>
 * @license https://github.com/xoopscube/legacy/blob/master/docs/GPL_V2.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';

class Legacy_ModuleUpdateForm extends XCube_ActionForm
{
    public function getTokenName()
    {
        return 'module.legacy.ModuleUpdateForm.TOKEN.' . $this->get('dirname');
    }

    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['dirname'] =new XCube_StringProperty('dirname');
        $this->mFormProperties['force'] =new XCube_BoolProperty('force');
    }

    public function load(&$obj)
    {
        $this->set('dirname', $obj->get('dirname'));
    }

    public function update(&$obj)
    {
        $obj->set('dirname', $this->get('dirname'));
    }
}
