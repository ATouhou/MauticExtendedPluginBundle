<?php

/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticExtendedPluginBundle\EventListener;

use Mautic\ApiBundle\Event\RouteEvent;
use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\CoreBundle\Event as MauticEvents;
use Mautic\FormBundle\Event as Events;
use Mautic\FormBundle\FormEvents;

/**
 * Class FormSubscriber
 */
class FormSubscriber extends CommonSubscriber {

    /**
     * {@inheritdoc}
     */
    static public function getSubscribedEvents() {
        return array(
            FormEvents::FORM_ON_BUILD => array('onFormBuilder', 0)
        );
    }

    /**
     * Add a simple email form
     *
     * @param FormBuilderEvent $event
     */
    public function onFormBuilder(Events\FormBuilderEvent $event) {
        // Register a custom form field
        $event->addFormField(
                'MauticExtendedPluginBundle.editor_advanced', array(
            // Field label
            'label' => 'mautic.extendedplugin.formfield.editor.advanced',
            // Form service for the field's configuration
            'formType' => 'editor_advanced',
            'type' => 'editor_advanced',
            // Template to use to render the formType
            'template' => 'MauticExtendedPluginBundle:SubscribedEvents\Field:editor_advanced.html.php'
                )
        );
    }

}
