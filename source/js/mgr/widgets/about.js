Ext.onReady(function () {
    var widget = Ext.get('dashboard-block-treehillstudio-matomovisitssummary');
    var about = widget.select('.treehillstudio-widget-about');
    about.on('click', function () {
        var msg = '<span style="display: inline-block; text-align: center;">' +
            '&copy; 2013-2023 by <a href="https://chsmedien.de" target="_blank">chsmedien.de</a><br>' +
            '<img src="' + MatomoVisitsSummary.config.assetsUrl + 'img/mgr/treehill-studio.png" srcset="' + MatomoVisitsSummary.config.assetsUrl + 'img/mgr/treehill-studio@2x.png 2x" alt="Treehill Studio" style="margin-top: 10px"><br>' +
            '&copy; 2022 by <a href="https://treehillstudio.com" target="_blank">treehillstudio.com</a></span>';
        Ext.Msg.show({
            title: _('matomovisitssummary') + ' ' + MatomoVisitsSummary.config.version,
            msg: msg,
            buttons: Ext.Msg.OK,
            cls: 'treehillstudio_window',
            width: 358
        });
    });
});
