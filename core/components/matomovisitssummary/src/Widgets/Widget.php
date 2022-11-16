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
     * modDashboardWidgetLogrequest constructor.
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

    /**
     * @param $type string
     * @return string
     */
    public function renderCustom($type)
    {
        $assetsUrl = $this->matomovisitssummary->getOption('assetsUrl');
        $jsUrl = $this->matomovisitssummary->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->matomovisitssummary->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';

        if ($this->matomovisitssummary->getOption('debug') && ($this->matomovisitssummary->getOption('assetsUrl') != MODX_ASSETS_URL . 'components/matomovisitssummary/')) {
            $this->controller->addJavascript($jsSourceUrl . 'matomovisitssummary.js');
            $this->controller->addJavascript($jsSourceUrl . 'helper/util.js');
            $this->controller->addCss($cssSourceUrl . 'matomovisitssummary.css');
        } else {
            $this->controller->addJavascript($jsUrl . 'matomovisitssummary.min.js');
            $this->controller->addCss($cssUrl . 'matomovisitssummary.min.css');
        }
        $this->modx->controller->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            MatomoVisitsSummary.config = ' . json_encode($this->matomovisitssummary->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';
            MODx.load({
                xtype: "matomovisitssummary-grid-matomovisitssummary-' . $type . '",
                renderTo: "matomovisitssummary-grid-matomovisitssummary-' . $type . '",
                connector_url: MatomoVisitsSummary.config.connectorUrl
            });
        });
        </script>');
        return $this->getFileChunk($this->matomovisitssummary->getOption('templatesPath') . 'matomovisitssummary_' . $type . '.tpl');
    }
}
