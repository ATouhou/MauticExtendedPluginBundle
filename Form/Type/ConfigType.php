<?php

/**
 * @package     Mautic
 * @copyright   2015 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticExtendedPluginBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ConfigType
 *
 * @package Mautic\PageBundle\Form\Type
 */
class ConfigType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('buttons_active', 'yesno_button_group', array(
            'label' => 'mautic.extended.plugin.config.buttons.active',
            'data' => (bool) $options['data']['buttons_active'],
        ));
        
        $builder->add('buttons_width', 'text', array(
            'label' => 'mautic.extended.plugin.config.buttons_width',
            'label_attr' => array('class' => 'control-label'),
            'data' =>  $options['data']['buttons_width'],
            'attr' => array(
                'class' => 'form-control col-sm-2',
            ),
        ));
        $builder->add('buttons_height', 'text', array(
            'label' => 'mautic.extended.plugin.config.buttons_height',
            'label_attr' => array('class' => 'control-label'),
            'data' =>  $options['data']['buttons_height'],
            'label_attr' => array('class' => 'control-label'),
            'attr' => array(
                'class' => 'form-control',
            ),
        ));
        $builder->add('buttons_radius', 'text', array(
            'label' => 'mautic.extended.plugin.config.buttons_radius',
            'data' =>  $options['data']['buttons_radius'],
            'label_attr' => array('class' => 'control-label'),
            'attr' => array(
                'class' => 'form-control col-sm-2',
            ),
        ));
        $builder->add('buttons_colors', 'text', array(
            'label' => 'mautic.extended.plugin.config.buttons_colors',
            'data' =>  $options['data']['buttons_colors'],
            'label_attr' => array('class' => 'control-label'),
            'attr' => array(
                'class' => 'form-control col-sm-2',
            ),
        ));
        $builder->add('buttons_font_color', 'text', array(
            'label' => 'mautic.extended.plugin.config.buttons_font_color',
            'data' =>  $options['data']['buttons_font_color'],
            'label_attr' => array('class' => 'control-label'),
            'attr' => array(
                'class' => 'form-control col-sm-2',
            ),
        ));
        $builder->add('buttons_font_size', 'text', array(
            'label' => 'mautic.extended.plugin.config.buttons_font_size',
            'data' =>  $options['data']['buttons_font_size'],
            'label_attr' => array('class' => 'control-label'),
            'attr' => array(
                'class' => 'form-control',
            ),
        ));
        $builder->add('buttons_text', 'text', array(
            'label' => 'mautic.extended.plugin.config.buttons_text',
            'data' =>  $options['data']['buttons_text'],
            'label_attr' => array('class' => 'control-label'),
            'attr' => array(
                'class' => 'form-control',
            ),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'extended_conf';
    }

}
