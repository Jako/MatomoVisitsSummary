After the package is installed, populate the MODX system settings in the
namespace `matomovisitssummary` and install the widget(s) in the dashboard to
display the Matomo visits summary graph.

## Widget

MatomoVisitsSummary contains a dashboard widget to display the Matomo visits summary graph.

## System Settings

MatomoVisitsSummary uses the following system settings in the namespace
`matomovisitssummary`:

| Key                            | Name                           | Description                                                                                                                                | Default |
|:-------------------------------|--------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------|---------|
| matomovisitssummary.debug      | Debug                          | Log debug information in the MODX error log.                                                                                               | No      |
| matomovisitssummary.date       | Date for statistics            | Choose between "today" or "yesterday" as start for the "VisitsSummary" statistics.                                                         | -       |
| matomovisitssummary.password   | Matomo Password                | The MD5 coded password of a Matomo user with view permission for the Matomo Site ID.                                                       | -       |
| matomovisitssummary.siteid     | Matomo Site ID                 | The Matomo Site ID.                                                                                                                        | -       |
| matomovisitssummary.token_auth | Matomo Token Auth              | The token auth of a Matomo user with view permission for the Matomo Site ID.                                                               | -       |
| matomovisitssummary.url        | URL of the Matomo installation | The URL of the Matomo installation without protocol.                                                                                       | -       |
| matomovisitssummary.user       | Matomo Username                | The username of a Matomo user with view  permission for the Matomo Site ID. Leave empty if no link to full statistics should be generated. | -       |

## Widget Settings

In MODX 3, the widget can be modified with widget properties. These properties
are based on the system settings. They take precedence over the system settings
and must be added by editing the widget:

| Property   | Description                                                                                                                                | Default |
|:-----------|--------------------------------------------------------------------------------------------------------------------------------------------|---------|
| date       | Choose between "today" or "yesterday" as start for the "VisitsSummary" statistics.                                                         | -       |
| password   | The MD5 coded password of a Matomo user with view permission for the Matomo Site ID.                                                       | -       |
| siteid     | The Matomo Site ID.                                                                                                                        | -       |
| token_auth | The token auth of a Matomo user with view permission for the Matomo Site ID.                                                               | -       |
| tpl        | The template chunk for the Widget display.                                                                                                 | -       |
| url        | The URL of the Matomo installation without protocol.                                                                                       | -       |
| user       | The username of a Matomo user with view  permission for the Matomo Site ID. Leave empty if no link to full statistics should be generated. | -       |

If you want to display multiple MatomoVisitsSummary widgets in your dashboard,
you have to duplicate the `matomovisitssummary.widget` widget with a new name
(i.e. by duplicating the record in the database) and add i.e. a `siteid`
property in the widget and fill it with for each widget with a different Matomo
site id.
