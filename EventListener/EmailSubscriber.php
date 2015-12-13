<?php

namespace MauticPlugin\MauticExtendedPluginBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\EmailBundle\EmailEvents;
use Mautic\EmailBundle\Event\EmailBuilderEvent;
use Mautic\EmailBundle\Event\EmailSendEvent;

/**
 * Class EmailSubscriber
 */
class EmailSubscriber extends CommonSubscriber {

    /**
     * @return array
     */
    static public function getSubscribedEvents() {
        return array(
            EmailEvents::EMAIL_ON_BUILD => array('onEmailBuild', 0),
            EmailEvents::EMAIL_ON_SEND => array('onEmailGenerate', 0),
            EmailEvents::EMAIL_ON_DISPLAY => array('onEmailGenerate', 0)
        );
    }

    /**
     * Register the tokens and a custom A/B test winner
     *
     * @param EmailBuilderEvent $event
     */
    public function onEmailBuild(EmailBuilderEvent $event) {

        $buttons_active = $this->factory->getParameter('buttons_active');
        if (!$buttons_active)
            return;

        $buttons_colors = $this->factory->getParameter('buttons_colors');
        if (!$buttons_colors)
            return;

        $params = array();
        $params['colors'] = explode(',', $buttons_colors);
        $params['buttons_width'] = $this->factory->getParameter('buttons_width');
        $params['buttons_height'] = $this->factory->getParameter('buttons_height');
        $params['buttons_radius'] = $this->factory->getParameter('buttons_radius');
        $params['buttons_font_color'] = $this->factory->getParameter('buttons_font_color');
        $params['buttons_font_size'] = $this->factory->getParameter('buttons_font_size');
        $params['buttons_text'] = $this->factory->getParameter('buttons_text');

        // Add email tokens
        $content = $this->templating->render('MauticExtendedPluginBundle:SubscribedEvents\EmailToken:token.html.php',$params);
        $event->addTokenSection('extendedplugin.token', 'mautic.extendedplugin.email.token.header', $content);
    }

    /**
     * Search and replace tokens with content
     *
     * @param EmailSendEvent $event
     */
    public function onEmailGenerate(EmailSendEvent $event) {
        // Get content
        $content = $event->getContent();

        // Search and replace tokens
        $content = str_replace('{extendedplugin}', 'world!', $content);

        // Set updated content
        $event->setContent($content);
    }

}
