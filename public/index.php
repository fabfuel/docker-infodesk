<?php

$data = [
    "request" => [
        "host" => $_SERVER["HTTP_HOST"],
    ],
    "container" => [
        "hostname" => gethostbyaddr($_SERVER["SERVER_ADDR"]),
        "ip" => $_SERVER["SERVER_ADDR"],
        "port" => $_SERVER["SERVER_PORT"],
    ],
    "proxy (remote)" => [
        "hostname" => gethostbyaddr($_SERVER["REMOTE_ADDR"]),
        "ip" => $_SERVER["REMOTE_ADDR"],
        "port" => $_SERVER["REMOTE_PORT"],
    ],
];

if ($_ENV['TUTUM_NODE_FQDN']) {
    $data["host"] = [
        "external hostname" => $_ENV['TUTUM_NODE_FQDN'],
        "external ip" => gethostbyname($_ENV['TUTUM_NODE_FQDN']),
        "internal hostname" => $_ENV['TUTUM_NODE_HOSTNAME'],
        "internal ip" => gethostbyname($_ENV['TUTUM_NODE_HOSTNAME']),
    ];
}

$data['tutum'] = [];

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
        <?php if (!$values): continue; endif; ?>
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
