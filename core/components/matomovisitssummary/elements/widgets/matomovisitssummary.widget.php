<?php
/**
 * Matomo VisitsSummary Widget
 *
 * @package matomovisitssummary
 * @subpackage dashboard
 */

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use TreehillStudio\MatomoVisitsSummary\Widgets\Widget;

class modDashboardWidgetMatomoVisitsSummary extends Widget
{
    public $cssBlockClass = 'dashboard-block-treehillstudio" id="dashboard-block-treehillstudio-matomovisitssummary';

    /**
     * @return string
     */
    public function render(): string
    {
        $assetsUrl = $this->matomovisitssummary->getOption('assetsUrl');
        $jsUrl = $this->matomovisitssummary->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->matomovisitssummary->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';

        if ($this->matomovisitssummary->getOption('debug') && ($this->matomovisitssummary->getOption('assetsUrl') != MODX_ASSETS_URL . 'components/matomovisitssummary/')) {
            $this->controller->addJavascript($jsSourceUrl . 'matomovisitssummary.js');
            $this->controller->addCss($cssSourceUrl . 'matomovisitssummary.css');
        } else {
            $this->controller->addJavascript($jsUrl . 'matomovisitssummary.min.js');
            $this->controller->addCss($cssUrl . 'matomovisitssummary.min.css');
        }
        $this->modx->controller->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            MatomoVisitsSummary.config = ' . json_encode($this->matomovisitssummary->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';
        });
        </script>');

        $settings = array();

        $widgetProperties = ($this->matomovisitssummary->getOption('modxversion') >= 3) ? $this->widget->get('properties') ?? [] : [];

        $settings['url'] = rtrim($this->matomovisitssummary->getOption('url', $widgetProperties, false), '/') . '/';
        $settings['siteid'] = $this->matomovisitssummary->getOption('siteid', $widgetProperties, false);
        $settings['token_auth'] = $this->matomovisitssummary->getOption('token_auth', $widgetProperties, false);
        $settings['user'] = $this->matomovisitssummary->getOption('user', $widgetProperties, false);
        $settings['password'] = $this->matomovisitssummary->getOption('password', $widgetProperties, false);
        $settings['date'] = $this->matomovisitssummary->getOption('date', $widgetProperties, 'today');

        $tpl = $this->matomovisitssummary->getOption('tpl', $widgetProperties, 'matomovisitssummary.iframe');

        if (!$settings['url'] || !$settings['siteid'] || !$settings['token_auth']) {
            return $this->modx->lexicon('matomovisitssummary.settings_not_found');
        }

        return $this->modx->getChunk($tpl, $settings);
    }

}

return 'modDashboardWidgetMatomoVisitsSummary';
