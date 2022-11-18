<?php
/**
 * MatomoVisitsSummary Widget
 *
 * @package matomovisitssummary
 * @subpackage widget
 */

namespace TreehillStudio\MatomoVisitsSummary\Widgets;

use MatomoVisitsSummary;
use modDashboardWidget;
use modDashboardWidgetInterface;
use modManagerController;
use xPDO;

// Compatibility between 2.x/3.x
if (!class_exists('modDashboardWidget')) {
    class_alias(\MODX\Revolution\modDashboardWidget::class, \modDashboardWidget::class);
}

abstract class Widget extends modDashboardWidgetInterface
{
    /** @var $matomovisitssummary MatomoVisitsSummary */
    public $matomovisitssummary;

    public $cssBlockClass = 'dashboard-block-treehillstudio';

    /**
     * modDashboardWidgetMatomoVisitsSummary constructor.
     * @param xPDO $modx
     * @param modDashboardWidget $widget
     * @param modManagerController $controller
     */
    public function __construct(xPDO &$modx, modDashboardWidget &$widget, modManagerController &$controller)
    {
        parent::__construct($modx, $widget, $controller);

        $corePath = $this->modx->getOption('matomovisitssummary.core_path', null, $this->modx->getOption('core_path') . 'components/matomovisitssummary/');
        $this->matomovisitssummary = $this->modx->getService('matomovisitssummary', 'MatomoVisitsSummary', $corePath . 'model/matomovisitssummary/', [
            'core_path' => $corePath
        ]);

        $this->controller->addLexiconTopic($this->widget->get('lexicon'));
    }

    /**
     * Renders the content of the block in the appropriate size
     * @return string
     */
    public function process()
    {
        $output = $this->render();
        $modxVersion = $this->modx->getVersionData();
        if (!empty($output)) {
            $widgetArray = $this->widget->toArray();
            $widgetArray['content'] = $output;
            $widgetArray['class'] = 'modx' . $modxVersion['version'] . ' ' . $this->cssBlockClass;
            $widgetArray['name_trans'] .= '<span class="treehillstudio-widget-about modx' . $modxVersion['version'] . '"><img width="91" height="25" src="' . $this->matomovisitssummary->getOption('assetsUrl') . 'img/mgr/treehill-studio-mini.png" srcset="' . $this->matomovisitssummary->getOption('assetsUrl') . 'img/mgr/treehill-studio-mini@2x.png 2x" alt="Treehill Studio"></span>';
            $output = $this->getFileChunk('dashboard/block.tpl', $widgetArray);
            $output = preg_replace('/\[\[([^\[\]]++|(?R))*?]]/s', '', $output);
        }
        return $output;
    }
}
