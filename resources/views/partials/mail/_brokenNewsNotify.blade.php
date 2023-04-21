<?php
  use Carbon\Carbon;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <title>NewsConnect Informer</title>
  </head>
  <body>
    <h3 style="text-decoration: underline;">NewsConnect API Notification</h3>
    <p>File <strong>{{$fileName}}</strong> was moved to <strong>/broken_news/</strong> folder as some data were missing from the XML structure.</p>
    <p>Please find attached related file that triggered this notification generated at <strong><?= Carbon::now()->format('m/d/Y h:i:s A') ?></strong>.</p>
    <p>
      Best Regards,
      <br />
      NewsConnect API Team
    </p>
  </body>
</html>
