<?php
/**
 * *
 *  * Form select field with a choice of available users
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

/**
 * Parent
 */
include_once XOOPS_ROOT_PATH . '/class/xoopsform/formselect.php';

// RMV-NOTIFY

class XoopsFormSelectUser extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param	string	$caption
     * @param	string	$name
     * @param	bool	$include_anon	Include user "anonymous"?
     * @param	mixed	$value	    	Pre-selected value (or array of them).
     * @param	int		$size	        Number or rows. "1" makes a drop-down-list.
     * @param	bool    $multiple       Allow multiple selections?
     */
    public function __construct($caption, $name, $include_anon=false, $value=null, $size=1, $multiple=false)
    {
        $this->XoopsFormSelect($caption, $name, $value, $size, $multiple);
        $member_handler =& xoops_gethandler('member');
        if ($include_anon) {
            global $xoopsConfig;
            $this->addOption(0, $xoopsConfig['anonymous']);
        }
        $this->addOptionArray($member_handler->getUserList());
    }
    public function XoopsFormSelectUser($caption, $name, $include_anon=false, $value=null, $size=1, $multiple=false)
    {
        return $this->__construct($caption, $name, $include_anon, $value, $size, $multiple);
    }
}
