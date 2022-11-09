<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="./assets/img/main-icon.png" rel="icon">
    <title>Print Account</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #table_body td,
        th {
            border: 0.5px solid black;
            padding: 5px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <table cellspacing="0" id="table_top" width="100%">
        <tr>
            <th><img src="./assets/img/logoTW.png" /></th>
        </tr>
        <tr>
            <th>ACCOUNT MANAGEMENT</th>
        </tr>
    </table>

    <table cellspacing="0" id="table_body" width="100%">
        <tr>
            <th>Username</th>
            <th>Fullname</th>
            <th>Department</th>
            <th>Position</th>
            <th>Status</th>
            <th>Date Created</th>
        </tr>
        <tbody>
            <?php foreach($account as $row): ?>
                <tr>
                    <td><?= $row['generated_id'];?></td>
                    <td><?= $row['l_name'];?>, <?= $row['f_name'];?> <?= $row['m_name'];?></td>
                    <td><?= $row['department'];?></td>
                    <td><?= $row['position'];?></td>
                    <td><?= $row['is_active'];?></td>
                    <td><?= $row['created_at'];?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>