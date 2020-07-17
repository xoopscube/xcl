<?php
/**
 * *
 *  * Login screen popup for SSL enabled in the preferences
 *  *
 *  * You should use this script only when your server supports SSL. Place this file under your SSL directory
 *  *
 *  * @package    Legacy
 *  * @author     Original Authors: Kazumi Ono (aka onokazu)
 *  * @author     Other Authors : Minahito
 *  * @copyright  2005-2020 The XOOPSCube Project
 *  * @license    Legacy : https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 *  * @license    Cube : https://github.com/xoopscube/xcl/blob/master/BSD_license.txt
 *  * @version    v 1.1 2007/05/15 02:34:30 minahito, Release: @package_230@
 *  * @link       https://github.com/xoopscube/xcl
 * *
 */

// path to your xoops main directory
$path = './';

include $path.'/mainfile.php';
if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}
include_once XOOPS_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/user.php';
$op = (isset($_POST['op']) && 'dologin' == $_POST['op']) ? 'dologin' : 'login';

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['userpass']) ? trim($_POST['userpass']) : '';
if ('' == $username || '' == $password) {
    $op ='login';
}

$header = '<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset='._CHARSET.'" />
    <meta http-equiv="content-language" content="'._LANGCODE.'" />
    <title>'.htmlspecialchars($xoopsConfig['sitename']).'</title>
    <link rel="stylesheet" type="text/css" media="all" href="'.XOOPS_URL.'/xoops.css" />
';
$style = getcss($xoopsConfig['theme_set']);
if ('' == $style) {
    $style = xoops_getcss($xoopsConfig['theme_set']);
}
if ('' !== $style) {
    $header .= '<link rel="stylesheet" type="text/css" media="all" href="'.$style.'" />';
}
$header .= '
  </head>
  <body>
';

if ('dologin' == $op) {
    $member_handler =& xoops_gethandler('member');
    $myts = new MyTextsanitizer();
    $myts->getInstance();
    $user =& $member_handler->loginUser(addslashes($myts->stripSlashesGPC($username)), $myts->stripSlashesGPC($password));
    if (is_object($user)) {
        if (0 == $user->getVar('level')) {
            redirect_header(XOOPS_URL.'/index.php', 5, _US_NOACTTPADM);
            exit();
        }
        if (1 == $xoopsConfig['closesite']) {
            $allowed = false;
            foreach ($user->getGroups() as $group) {
                if (in_array($group, $xoopsConfig['closesite_okgrp'], true) || XOOPS_GROUP_ADMIN == $group) {
                    $allowed = true;
                    break;
                }
            }
            if (!$allowed) {
                redirect_header(XOOPS_URL.'/index.php', 1, _NOPERM);
                exit();
            }
        }
        $user->setVar('last_login', time());
        if (!$member_handler->insertUser($user)) {
            //EMPTY
        }
        require_once XOOPS_ROOT_PATH . '/include/session.php';

        xoops_session_regenerate();
        $_SESSION = [];
        $_SESSION['xoopsUserId'] = $user->getVar('uid');
        $_SESSION['xoopsUserGroups'] = $user->getGroups();

        $config_handler =& xoops_gethandler('config');
        $moduleConfigUser =& $config_handler->getConfigsByDirname('user');

        if (!empty($moduleConfigUser['use_ssl'])) {
            echo $header;
            xoops_confirm([$moduleConfigUser['sslpost_name'] => session_id()], XOOPS_URL . '/misc.php?action=showpopups&amp;type=ssllogin', _US_PRESSLOGIN, _LOGIN);
        } else {
            echo $header;
            echo sprintf(_US_LOGGINGU, $user->getVar('uname'));
            echo '<div style="text-align:center;"><input value="'._CLOSE.'" type="button" onclick="document.window.opener.location.reload();document.window.close();" /></div>';
        }
    } else {
        xoops_error(_US_INCORRECTLOGIN.'<br><a href="login.php">'._BACK.'</a>');
    }
}

if ('login' == $op) {
    echo $header;
    echo '
    <div style="text-align: center; padding: 5; margin: 0">
    <form action="login.php" method="post">
      <table class="outer" width="95%">
        <tr>
          <td class="head">'._USERNAME.'</td>
          <td class="even"><input type="text" name="username" value="" /></td>
        </tr>
        <tr>
          <td class="head">'._PASSWORD.'</td>
          <td class="even"><input type="password" name="userpass" value="" /></td>
        </tr>
        <tr>
          <td class="head">&nbsp;</td>
          <td class="even"><input type="hidden" name="op" value="dologin" /><input type="submit" name="submit" value="'._LOGIN.'" /></td>
        </tr>
      </table>
    </form>
    </div>
    ';
}

echo '
  </body>
</html>
';
