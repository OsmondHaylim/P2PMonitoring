<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to CodeIgniter 4!</title>
    <link rel="stylesheet" href="/Asset/style.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="#" class="nav_home">Home</a>
            <a href="#" class="logo">Point to Point Monitoring</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>KD UKO</th>
                    <th>Nama KC</th>
                    <th>Jumlah PTP</th>
                    <th>Persen PTP</th>
                    <th>OS PTP</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($uko as $row) : ?>
                    <tr>
                        <td><?= $row->KD_UKO; ?></td>
                        <td><?= $row->UKO_Name; ?></td>
                        <td><?= $row->PTP_Amount; ?></td>
                        <td><?= $row->PTP_Percentage; ?></td>
                        <td><?= $row->OS_PTP; ?></td>
                    </tr>
                    
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    

</body>