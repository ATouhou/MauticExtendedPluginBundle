<?php

/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticExtendedPluginBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class FormFieldTextType
 */
class FormFieldTextType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $editor = ($options['editor']) ? ' editor-advanced' : '';
        
          $builder->add('text', 'textarea', array(
            'label' => 'mautic.form.field.type.freetext',
            'label_attr' => array('class' => 'control-label'),
            'attr' => array('class' => 'form-control' . $editor),
            'required' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'field_type' => 'textarea',
            'editor' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return "editor_advanced";
    }

}
