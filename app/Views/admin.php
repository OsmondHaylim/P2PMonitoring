<!DOCTYPE html>
<html lang="en">
<head>
    <title>Point to Point Monitoring</title>
    <link rel="stylesheet" href="/Asset/style.css">
</head>
<body>
    <div class="container">
        <div class="spaces">

        </div>
        <div class="navbar">
            <a href="/" class="nav_home">Home</a>
            <a href="/" class="logo right">Point to Point Monitoring</a>
        </div>
        <div class="headers kc">
            <div class="left">
                <h1>Point to Point Monitoring</h1>
                <h2>Regional Office Bandung</h2>
            </div>
            <div class="right">
                <h2>Data Inputting</h2>
            </div>
        </div>
        <div class="headers">
            <h2>Input Data Bulanan</h2>
            <form action="<?= base_url('csv/monthly') ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file_monthly" required>
                <button type="submit">Upload</button>
            </form>
        </div>
        <div class="headers">
            <h2>Input Data Harian</h2>
            <form action="<?= base_url('csv/updated') ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file_updated" required>
                <button type="submit">Upload</button>
            </form>
        </div>
        <div class="headers">
            <h2>Input Data Cabang</h2>
            <form action="<?= base_url('csv/cabang') ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file_cabang" required>
                <button type="submit">Upload</button>
            </form>
        </div>
        <div class="texts">
            <p>Tools monitoring Point to Point RO Bandung, merupakan data KKP Kolektibilitas 1 dan 2 yang berhasil tertagihkan sehingga tidak terjadi pemburukan Kolektibilitas</p>
        </div>
        <div class="footer">
            <div class="divide">
                <div class="copyright">
                    <p>©2023 Kantor Wilayah Bandung<br>
                        CONSUMER LOAN FACTORY DEPARTMENT<br>
                        All rights reserved.</p>
                </div>
                <div class="logo down_center">
                    <p>Point to Point Monitoring</p>
                </div>
                <div class="version">
                    <p>v. 2.1.0</p>
                </div>
            </div>
            
            <div class="line">
                <hr>
            </div>
            <div class="breadcrumbs">
                <p>Home</p>
            </div>
        </div>
    </div>
</body>