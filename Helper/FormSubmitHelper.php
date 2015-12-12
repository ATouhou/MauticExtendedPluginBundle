<?php

/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticExtendedPluginBundle\Helper;

use Mautic\AssetBundle\Entity\Asset;
use Mautic\CoreBundle\Factory\MauticFactory;
use Mautic\FormBundle\Entity\Action;
use Mautic\FormBundle\Entity\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FormSubmitHelper
 *
 * @package Mautic\AssetBundle\Helper
 */
class FormSubmitHelper {

    /**
     * @param Action        $action
     * @param MauticFactory $factory
     *
     * @return array
     */
    public static function onFormSubmit($tokens, Action $action, MauticFactory $factory, $feedback) {
        $properties = $action->getProperties();
        $leadModel = $factory->getModel('lead');
        $emailRepo = $factory->getModel('email');
        // Deal with Lead email
        if (!empty($feedback['lead.create']['lead'])) {
            //the lead was just created via the lead.create action
            $currentLead = $feedback['lead.create']['lead'];
        } else {
            $currentLead = $leadModel->getCurrentLead();
        }

        if ($currentLead instanceof Lead) {
            //flatten the lead
            $lead = $currentLead;
            $currentLead = array(
                'id' => $lead->getId()
            );
            $leadFields = $leadModel->flattenFields($lead->getFields());

            $currentLead = array_merge($currentLead, $leadFields);
        }
        $email_address = $currentLead->getEmail();
        if ($email_address)
            $emailRepo->removeDoNotContact($email_address);
    }

}
