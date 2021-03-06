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
            ),
             'mautic.form.type.extended_conf' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\Form\Type\ConfigType',
                'alias' => 'extended_conf'
            ),
        ),
        'events' => array(
            'mautic.extendedplugin.emailbundle.subscriber' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\EventListener\EmailSubscriber'
            ),
            'mautic.extendedplugin.formbundle.subscriber' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\EventListener\FormSubscriber'
            ),
            'mautic.extendedplugin.configbundle.subscriber' => array(
                'class' => 'MauticPlugin\MauticExtendedPluginBundle\EventListener\ConfigSubscriber'
            ),
        ),
    ),
    'parameters' => array(
        'buttons_active' => true,
        'buttons_width' => '200px',
        'buttons_height' => '35px',
        'buttons_radius' => '4px',
        'buttons_colors' => '#4cb939,#c70013',
        'buttons_font_color' => '#ffffff',
        'buttons_font_size' => '13px',
        'buttons_text' => 'Button',
    )
);
