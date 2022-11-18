<?php
/**
 * MatomoVisitsSummary
 *
 * Copyright 2013-2022 by Christian Seel <hallo@chsmedien.de>
 * Copyright 2022 by Thomas Jakobi <office@treehillstudio.com>
 *
 * @package matomovisitssummary
 * @subpackage classfile
 */

namespace TreehillStudio\MatomoVisitsSummary;

use modX;

/**
 * Class MatomoVisitsSummary
 */
class MatomoVisitsSummary
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public modX $modx;

    /**
     * The namespace
     * @var string $namespace
     */
    public $namespace = 'matomovisitssummary';

    /**
     * The package name
     * @var string $packageName
     */
    public string $packageName = 'MatomoVisitsSummary';

    /**
     * The version
     * @var string $version
     */
    public string $version = '1.1.1';

    /**
     * The class options
     * @var array $options
     */
    public array $options = [];

    /**
     * MatomoVisitsSummary constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    public function __construct(modX &$modx, array $options = [])
    {
        $this->modx =& $modx;
        $this->namespace = $this->getOption('namespace', $options, $this->namespace);

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/' . $this->namespace . '/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/' . $this->namespace . '/');
        $modxversion = $this->modx->getVersionData();

        // Load some default paths for easier management
        $this->options = array_merge([
            'namespace' => $this->namespace,
            'version' => $this->version,
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'vendorPath' => $corePath . 'vendor/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'pagesPath' => $corePath . 'elements/pages/',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'pluginsPath' => $corePath . 'elements/plugins/',
            'controllersPath' => $corePath . 'controllers/',
            'processorsPath' => $corePath . 'processors/',
            'templatesPath' => $corePath . 'templates/',
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $assetsUrl . 'connector.php'
        ], $options);

        // Add default options
        $this->options = array_merge($this->options, [
            'debug' => $this->getBooleanOption('debug', $options, false),
            'modxversion' => $modxversion['version'],
            'url' => $this->getOption('url', $options, ''),
            'siteid' => $this->getOption('siteid', $options, ''),
            'key' => $this->getOption('key', $options, ''),
            'user' => $this->getOption('user', $options, ''),
            'password' => $this->getOption('password', $options, ''),
            'date' => $this->getOption('date', $options, ''),
        ]);

        $this->modx->addPackage($this->namespace, $this->getOption('modelPath'));

        $lexicon = $this->modx->getService('lexicon', 'modLexicon');
        $lexicon->load($this->namespace . ':default');
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption(string $key, array $options = [], $default = null)
    {
        $option = $default;
        if (!empty($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("$this->namespace.$key", $this->modx->config)) {
                $option = $this->modx->getOption("$this->namespace.$key");
            }
        }
        return $option;
    }

    /**
     * Get Boolean Option
     * @param string $key
     * @param array $options
     * @param mixed $default
     * @return bool
     */
    public function getBooleanOption(string $key, array $options = [], $default = null): bool
    {
        $option = $this->modx->getOption($key, $options, $default);
        return ($option === 'true' || $option === true || $option === '1' || $option === 1);
    }
}
