<?php
/**
 * *
 *  * Form text field with calendar popup
 *  *
 *  * @package    kernel
 *  * @subpackage form
 *  * @author     Original Authors: Kazumi Ono (aka onokazu)
 *  * @author     Other Authors : Minahito
 *  * @copyright  2000-2020 The XOOPSCube Project
 *  * @license    Legacy : https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 *  * @license    Cube : https://github.com/xoopscube/xcl/blob/master/BSD_license.txt
 *  * @version    Release: @package_230@
 *  * @link       https://github.com/xoopscube/xcl
 * *
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}


class XoopsFormTextDateSelect extends XoopsFormText
{

    public function __construct($caption, $name, $size = 15, $value= 0)
    {
        $value = !is_numeric($value) ? time() : (int)$value;
        $this->XoopsFormText($caption, $name, $size, 25, $value);
    }
    public function XoopsFormTextDateSelect($caption, $name, $size = 15, $value= 0)
    {
        return $this->__construct($caption, $name, $size, $value);
    }

    public function render()
    {
        $root =& XCube_Root::getSingleton();
        $renderSystem =& $root->getRenderSystem(XOOPSFORM_DEPENDENCE_RENDER_SYSTEM);

        $renderTarget =& $renderSystem->createRenderTarget('main');

        $renderTarget->setAttribute('legacy_module', 'legacy');
        $renderTarget->setTemplateName('legacy_xoopsform_textdateselect.html');
        $renderTarget->setAttribute('element', $this);
        $renderTarget->setAttribute('date', date('Y-m-d', $this->getValue()));

        $jstime = formatTimestamp($this->getValue(), '"F j, Y H:i:s"');
        include_once XOOPS_ROOT_PATH.'/include/calendarjs.php';    //< FIXME

        $renderSystem->render($renderTarget);

        return $renderTarget->getResult();
    }
}
