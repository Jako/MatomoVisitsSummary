After the package is installed, populate the MODX system settings in the
namespace `matomovisitssummary` and install the widget(s) in the dashboard to
display the Matomo visits summary graph.

## Widget

LogRequest contains a dashboard widget to display the Matomo visits summary graph.

## System Settings

LogRequest uses the following system settings in the namespace `matomovisitssummary`:

| Key                            | Description                                                                                                                                                      | Default |
|--------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------|
| Debug                          | Log debug information in the MODX error log.                                                                                                                     | No      |
| Date for statistics            | Choose between "today" or "yesterday" as start for the "VisitsSummary" statistics.                                                                               | -       |
| Matomo Password                | Please enter the MD5 coded password of a Matomo user with view permission for the Matomo Site ID. Leave empty if no link to full statistics should be generated. | -       |
| Matomo Site ID                 | Please enter the Matomo Site ID.                                                                                                                                 | -       |
| Matomo Token Auth              | Please enter the token auth of a Matomo user with view permission for the Matomo Site ID.                                                                        | -       |
| URL of the Matomo installation | Please enter the URL of the Matomo installation without protocol. The URL must end with a slash!                                                                 | -       |
| Matomo Username                | Please enter the username of a Matomo user with view  permission for the Matomo Site ID. Leave empty if no link to full statistics should be generated.          | -       |
