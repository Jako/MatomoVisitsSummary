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
        $settings['protocol'] = $this->matomovisitssummary->getOption('protocol', [], false);
        $settings['url'] = rtrim($this->modx->getOption('matomovisitssummary.url', [], false), '/') . '/';
        $settings['siteid'] = $this->modx->getOption('matomovisitssummary.siteid', [], false);
        $settings['token_auth'] = $this->modx->getOption('matomovisitssummary.token_auth', [], false);
        $settings['visitssummary.date'] = $this->modx->getOption('matomovisitssummary.visitssummary.date', null, 'today', TRUE);
        $settings['user'] = $this->modx->getOption('matomovisitssummary.user', [], false);
        $settings['password'] = $this->modx->getOption('matomovisitssummary.password', [], false);
        $settings['date'] = $this->modx->getOption('matomovisitssummary.date', [], 'today');

        if (!$settings['protocol'] || !$settings['url'] || !$settings['siteid'] || !$settings['token_auth']) {
            return $this->modx->lexicon('matomovisitssummary.settings_not_found');
        }

        return $this->modx->getChunk('matomovisitssummary.iframe', $settings);
    }

}

return 'modDashboardWidgetMatomoVisitsSummary';
