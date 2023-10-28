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
            <a href="#" class="logo right">Point to Point Monitoring</a>
        </div>
        <div class="spaces">

        </div>
        <div class="headers">
            <h1>Point to Point Monitoring</h1>
            <h2>Regional Office Bandung</h2>
            <h3>Last Updated : 30 September 2023</h3>
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
    
    <div class="footer">
        
    </div>
</body>