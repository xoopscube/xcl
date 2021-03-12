<?php

require_once dirname(__DIR__) . '/include/main_functions.php';
require_once dirname(__DIR__) . '/include/history_functions.php';

// set $cat_id,$content_id from $older_history_id
[$_REQUEST['cat_id'], $_REQUEST['content_id'],] = pico_get_content_history_profile($mydirname, (int)@$_GET['older_history_id']);

// common prepend
require dirname(__DIR__) . '/include/common_prepend.inc.php';
// global $breadcrumbsObj, $picoRequest, $permissions, $currenCategoryObj
// global $xoopsModuleConfig(overridden)

// add request
$picoRequest['older_history_id'] = (int)@$_GET['older_history_id'];

$picoRequest['newer_history_id'] = (int)@$_GET['newer_history_id'];

$picoRequest['view'] = 'single' == @$_GET['view'] ? 'single' : 'diffhistories';

// controller
require_once dirname(__DIR__) . '/class/PicoControllerDiffHistories.class.php';

$controller = new PicoControllerDiffHistories($currentCategoryObj);

$controller->execute($picoRequest);

// render
if ($controller->isNeedHeaderFooter()) {

    $xoopsOption['template_main'] = $controller->getTemplateName();

    include XOOPS_ROOT_PATH . '/header.php';

    $xoopsTpl->assign($controller->getAssign());

    $xoopsTpl->assign('xoops_module_header', pico_main_render_moduleheader($mydirname, $xoopsModuleConfig, $controller->getHtmlHeader()) . $xoopsTpl->get_template_vars('xoops_module_header'));

    include XOOPS_ROOT_PATH . '/footer.php';

} else {
    $controller->render();
}
exit;
