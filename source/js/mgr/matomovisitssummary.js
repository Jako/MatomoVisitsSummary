var matomovisitssummary = function (config) {
    config = config || {};
    matomovisitssummary.superclass.constructor.call(this, config);
};
Ext.extend(matomovisitssummary, Ext.Component, {
    initComponent: function () {
        this.stores = {};
        this.ajax = new Ext.data.Connection({
            disableCaching: true,
        });
    }, page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, util: {}, form: {}
});
Ext.reg('matomovisitssummary', matomovisitssummary);

MatomoVisitsSummary = new matomovisitssummary();
