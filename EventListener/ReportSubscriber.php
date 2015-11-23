<?php

// addons\HelloWorldBundle\EventListener\ReportSubscriber

namespace MauticPlugin\MauticExtendedPluginBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\CoreBundle\Helper\GraphHelper;
use Mautic\ReportBundle\Event\ReportBuilderEvent;
use Mautic\ReportBundle\Event\ReportGeneratorEvent;
use Mautic\ReportBundle\Event\ReportGraphEvent;
use Mautic\ReportBundle\ReportEvents;

/**
 * Class ReportSubscriber
 *
 * @package Mautic\EmailBundle\EventListener
 */
class ReportSubscriber extends CommonSubscriber {

    /**
     * @return array
     */
    static public function getSubscribedEvents() {
        return array(
            ReportEvents::REPORT_ON_BUILD => array('onReportBuilder', 0),
            ReportEvents::REPORT_ON_GENERATE => array('onReportGenerate', 0),
            ReportEvents::REPORT_ON_GRAPH_GENERATE => array('onReportGraphGenerate', 0)
        );
    }

    /**
     * Add available tables and columns to the report builder lookup
     *
     * @param ReportBuilderEvent $event
     *
     * @return void
     */
    public function onReportBuilder(ReportBuilderEvent $event) {
        if ($event->checkContext(array('email.clicks'))) {

            if ($event->checkContext('email.clicks')) {
                $prefix = 'e.';
                $variantParent = 'vp.';
                $pageRedirects_prefix = 'pr.';
                $columns = array(
                    $pageRedirects_prefix . 'url' => array(
                        'label' => 'mautic.email.url',
                        'type' => 'string'
                    ),
                    $pageRedirects_prefix . 'hits' => array(
                        'label' => 'mautic.email.hits',
                        'type' => 'int'
                    ),
                    $pageRedirects_prefix . 'unique_hits' => array(
                        'label' => 'mautic.email.unique_hits',
                        'type' => 'int'
                    ),
                    $prefix . 'subject' => array(
                        'label' => 'mautic.email.subject',
                        'type' => 'string'
                    ),
                    $prefix . 'lang' => array(
                        'label' => 'mautic.core.language',
                        'type' => 'string'
                    ),
                    $prefix . 'read_count' => array(
                        'label' => 'mautic.email.report.read_count',
                        'type' => 'int'
                    ),
                    $prefix . 'revision' => array(
                        'label' => 'mautic.email.report.revision',
                        'type' => 'int'
                    ),
                    $variantParent . 'id' => array(
                        'label' => 'mautic.email.report.variant_parent_id',
                        'type' => 'int'
                    ),
                    $variantParent . 'subject' => array(
                        'label' => 'mautic.email.report.variant_parent_subject',
                        'type' => 'string'
                    ),
                    $prefix . 'variant_start_date' => array(
                        'label' => 'mautic.email.report.variant_start_date',
                        'type' => 'datetime'
                    ),
                    $prefix . 'variant_sent_count' => array(
                        'label' => 'mautic.email.report.variant_sent_count',
                        'type' => 'int'
                    ),
                    $prefix . 'variant_read_count' => array(
                        'label' => 'mautic.email.report.variant_read_count',
                        'type' => 'int'
                    )
                );

                $data = array(
                    'display_name' => 'mautic.extendedplugin.table.most.emails.clicks',
                    'columns' => array_merge($columns, $event->getStandardColumns($prefix), $event->getCategoryColumns())
                );
                $event->addTable('email.clicks', $data);

                // Register Graphs
                $context = 'email.clicks';
                $event->addGraph($context, 'table', 'mautic.email.table.most.emails.click.stats');
            }
        }
    }

    /**
     * Initialize the QueryBuilder object to generate reports from
     *
     * @param ReportGeneratorEvent $event
     *
     * @return void
     */
    public function onReportGenerate(ReportGeneratorEvent $event) {
        $context = $event->getContext();
        if ($context == 'email.clicks') {
            $qb = $this->factory->getEntityManager()->getConnection()->createQueryBuilder();

            $qb->from(MAUTIC_TABLE_PREFIX . 'page_redirects', 'pr')
                    ->leftJoin('pr', MAUTIC_TABLE_PREFIX . 'emails', 'e', 'e.id = pr.email_id')
                    ->leftJoin('e', MAUTIC_TABLE_PREFIX . 'emails', 'vp', 'vp.id = e.variant_parent_id');
            $event->addCategoryLeftJoin($qb, 'e');
            //$event->addLeadLeftJoin($qb, 'ph');
            //$event->addIpAddressLeftJoin($qb, 'ph');

            $event->setQueryBuilder($qb);
        }
    }

    /**
     * Initialize the QueryBuilder object to generate reports from
     *
     * @param ReportGeneratorEvent $event
     *
     * @return void
     */
    public function onReportGraphGenerate(ReportGraphEvent $event) {

        // Context check, we only want to fire for Lead reports
        if (!$event->checkContext('email.clicks')) {
            return;
        }

        $graphs = $event->getRequestedGraphs();
        $qb = $event->getQueryBuilder();
        $statRepo = $this->factory->getEntityManager()->getRepository('MauticEmailBundle:Stat');

        foreach ($graphs as $g) {
            $options = $event->getOptions($g);
            $queryBuilder = clone $qb;
            switch ($g) {
                case 'mautic.email.table.most.emails.click.stats':
                    $queryBuilder->select('e.id, e.subject AS Subject, e.sent_count as "Sends", SUM(pr.hits) as Clicks, SUM(pr.unique_hits) as "Unique clicks"')
                            ->groupBy('e.id, e.subject')
                            ->orderBy('Clicks', 'DESC');

                    $limit = 30;
                    $offset = 0;
                    $items = $statRepo->getMostEmails($queryBuilder, $limit, $offset);
                    $qb2 = $this->factory->getEntityManager()->getConnection()->createQueryBuilder();
                    foreach ($items as $key => $item) {
                        $qb2->from(MAUTIC_TABLE_PREFIX . 'email_stats', 'es')
                                ->select('count(CASE WHEN es.is_read THEN 1 ELSE null END) as "read"')
                                ->where('es.email_id = :email_id')
                                ->setParameter('email_id', $item['id']);
                        $opens = $qb2->execute()->fetchColumn();
                        $items[$key]['Clicks ratio'] = round($items[$key]['Clicks'] / $items[$key]['Sends'] * 100, 1);
                        $items[$key]['Read ratio'] = round($opens / $items[$key]['Sends'] * 100, 1);
                        $items[$key]['Opens'] = $opens;
                    }


                    $graphData = array();
                    $graphData['data'] = $items;
                    $graphData['name'] = 'mautic.testplugin.table.most.emails.clicks';
                    $graphData['iconClass'] = 'fa-external-link';
                    $graphData['link'] = 'mautic_email_action';
                    $event->setGraph($g, $graphData);
                    break;
            }
            unset($queryBuilder);
        }
    }

}
