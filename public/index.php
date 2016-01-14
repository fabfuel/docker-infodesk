<?php

$data = [
    "host" => [
        "HTTP_HOST" => $_SERVER["HTTP_HOST"],
        "SERVER_NAME" => $_SERVER["SERVER_NAME"],
        "SERVER_ADDR" => $_SERVER["SERVER_ADDR"],
        "SERVER_PORT" => $_SERVER["SERVER_PORT"],
    ],
    "remote" => [
        "REMOTE_ADDR" => $_SERVER["REMOTE_ADDR"],
        "REMOTE_PORT" => $_SERVER["REMOTE_PORT"],
    ],
];

foreach ($_ENV as $key => $value) {
    if (strpos($key, 'TUTUM') === 0) {
        $data['tutum'][$key] = $value;
    } else {
        $data['env'][$key] = $value;
    }
}

?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

<div class="container">

    <?php foreach ($data as $title => $values): ?>
        <div class="panel">
            <table class="table table-striped">
                <tr class="info">
                    <th colspan="2"><?= $title ?></th>
                </tr>

                <?php foreach ($values as $key => $value): ?>
                <tr>
                    <td style="width: 25%"><?= $key ?></td>
                    <td style="width: 75%"><?= $value ?></td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
