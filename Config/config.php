<?php

/**
 * @Author  Chad Windnagle
 * @Project TestPlugin
 * Date: 4/13/15
 */
return array(
    'name' => 'Extended Plugin',
    'description' => 'Just small improvements for Mautic',
    'version' => '1.0',
    'author' => 'kuzmany.biz',
    'services' => array(
        'forms' => array(
            'mautic.form.type.editor_advanced' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\Form\Type\FormFieldTextType',
                'alias' => 'editor_advanced'
            ),
        ),
        'events' => array(
            'mautic.extendedplugin.reportbundle.subscriber' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\EventListener\ReportSubscriber'
            ),
            'mautic.extendedplugin.formbundle.subscriber' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\EventListener\FormSubscriber'
            ),
        ),
    )
);
