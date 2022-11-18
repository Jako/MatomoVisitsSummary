<?php
/**
 * Resolve system settings
 *
 * @package matomovisitssummary
 * @subpackage build
 *
 * @var array $options
 * @var xPDOObject $object
 */

$settings = [
    'piwikvisitssummary.url' => 'matomovisitssummary.url',
    'piwikvisitssummary.siteid' => 'matomovisitssummary.siteid',
    'piwikvisitssummary.token_auth' => 'matomovisitssummary.token_auth',
    'piwikvisitssummary.user' => 'matomovisitssummary.user',
    'piwikvisitssummary.password' => 'matomovisitssummary.password',
    'piwikvisitssummary.visitssummary.date' => 'matomovisitssummary.date',
];

$success = true;
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /** @var modX $modx */
            $modx = &$object->xpdo;
            foreach ($settings as $oldSetting => $newSetting) {
                /** @var modSystemSetting $oldSettingObject */
                $oldSettingObject = $modx->getObject('modSystemSetting', ['key' => $oldSetting]);
                /** @var modSystemSetting $newSettingObject */
                $newSettingObject = $modx->getObject('modSystemSetting', ['key' => $newSetting]);
                if ($oldSettingObject && $newSettingObject) {
                    if ($newSettingObject->get('value') == '') {
                        $newSettingObject->set('value', $oldSettingObject->get('value'));
                        $newSettingObject->save();
                        $modx->log(xPDO::LOG_LEVEL_INFO, $oldSetting . ' setting copied to ' . $newSetting);
                    }
                }
            }
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}
return $success;
