<?php
/**
 * @Author  Chad Windnagle
 * @Project TestPlugin
 * Date: 4/13/15
 */

namespace MauticPlugin\MauticExtendedPluginBundle\Controller;

use Mautic\CoreBundle\Controller\FormController;

/**
 * Class PluginController
 */
class TestController extends FormController
{
    /**
     * @param int $page
     */
    public function indexAction ($page = 1)
    {
        $tmpl = $this->request->isXmlHttpRequest() ? $this->request->get('tmpl', 'index') : 'index';

        return $this->delegateView(array(
                'viewParameters'  => array(
                    'tmpl' => $tmpl,
             ),
             'contentTemplate' => 'MauticExtendedPluginBundle:Test:index.html.php',
           )
        );
    }
}