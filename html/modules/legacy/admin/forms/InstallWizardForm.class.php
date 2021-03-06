<?php
/**
 *
 * @package Legacy
 * @version $Id: InstallWizardForm.class.php,v 1.3 2008/09/25 15:10:54 kilica Exp $
 * @copyright Copyright 2005-2021 XOOPS Cube Project  <https://github.com/xoopscube/legacy>
 * @license https://github.com/xoopscube/legacy/blob/master/docs/GPL_V2.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';

class Legacy_InstallWizardForm extends XCube_ActionForm
{
    public function getTokenName()
    {
        return 'module.legacy.InstallWizardForm.TOKEN.' . $this->get('dirname');
    }

    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['dirname'] =new XCube_StringProperty('dirname');
        $this->mFormProperties['agree'] =new XCube_BoolProperty('agree');

        //
        // Set field properties
        //
        $this->mFieldProperties['agree'] =new XCube_FieldProperty($this);
        $this->mFieldProperties['agree']->setDependsByArray(['min']);
        $this->mFieldProperties['agree']->addMessage('min', _AD_LEGACY_ERROR_PLEASE_AGREE);
        $this->mFieldProperties['agree']->addVar('min', '1');
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
