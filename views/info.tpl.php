<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener Logs</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <table class="log-table">
            <thead>
                <tr>
                    <th>Short URL</th>
                    <th>Referrer</th>
                    <th>IP</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log) : ?>
                    <tr>
                        <td><?= $log['short_url'] ?></td>
                        <td><?= $log['Referrer'] ?></td>
                        <td><?= $log['Ip'] ?></td>
                        <td><?= $log['User_Agent'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>