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
            'mautic.form.type.submitaction_re_add' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\Form\Type\FormSubmitActioReAddType',
                'arguments' => 'mautic.factory',
                'alias' => 'submitaction_re_add'
            )
        ),
        'events' => array(
            'mautic.extendedplugin.emailbundle.subscriber' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\EventListener\EmailSubscriber'
            ),
            'mautic.extendedplugin.reportbundle.subscriber' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\EventListener\ReportSubscriber'
            ),
            'mautic.extendedplugin.formbundle.subscriber' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\EventListener\FormSubscriber'
            ),
        ),
    )
);
