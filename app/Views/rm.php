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
                <h1><?= $nama_pn; ?></h1>
                <h2><?= $rmData['cabang']; ?></h2>
            </div>
        </div>
        <div class="additional"> 
            <div class="column">
                <div class="row">
                    <div>
                        <p>Periode Laporan</p>
                    </div>
                    <div>
                        <p><?= $date; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p>Plafond</p>
                    </div>
                    <div>
                        <p>Rp. <?= number_format($rmData['total_pinjaman'], 0, '.', '.'); ?> (<?= $rmData['count_pinjaman']; ?> Deb)</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p>Baki Debet</p>
                    </div>
                    <div>
                    <p>Rp. <?= number_format($rmData['total_os'], 0, '.', '.'); ?> (<?= $rmData['count_pinjaman']; ?> Deb)</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p>Lancar</p>
                    </div>
                    <div>
                    <p>Rp. <?= number_format($rmData['total_os1'], 0, '.', '.'); ?> (<?= $rmData['count_os1']; ?> Deb)</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p>DPK</p>
                    </div>
                    <div>
                    <p>Rp. <?= number_format($rmData['total_os2'], 0, '.', '.'); ?> (<?= $rmData['count_os2']; ?> Deb)</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p>NPL</p>
                    </div>
                    <div>
                    <p>Rp. <?= number_format($rmData['total_os3'], 0, '.', '.'); ?> (<?= $rmData['count_os3']; ?> Deb)</p>
                    </div>
                </div>
            </div>
            <div class="p2pp">
                <div class="subcenter">
                    <p>POINT TO POINT / PAYMENT</p>
                </div>
                <div class="tem">
                    <div class="cap">
                        <div class="tem">
                            <div class = "subject">
                                <p>Rekening</p>
                            </div>
                            <div class = "left object">
                                <p><?=$rmData['count_done']; ?></p>
                            </div>
                            <div class = "object">
                                <p><?=number_format($float_done, 2, ',', '.'); ?>  %</p>
                            </div>
                        </div>
                        <div class="tem">
                            <div class = "subject">
                                <p>Out Standing</p>
                            </div>
                            <div class = "left object">
                                <p>Rp. <?=number_format($rmData['os_done'], 0, '.', '.'); ?></p>
                            </div>
                            <div class = "object">
                                <p><?=number_format($os_float_done, 2, ',', '.'); ?>  %</p>
                            </div>
                        </div>
                    </div>
                    <div class="done">
                        <p>Done</p>
                    </div>
                </div>
                <div class="tem"> 
                    <div class="cap">
                        <div class="tem">
                            <div class = "subject">
                                <p>Rekening</p>
                            </div>
                            <div class = "item">
                                <p><?=$total_not_done; ?></p>
                            </div>
                        </div>
                        <div class="tem">
                            <div class = "subject">
                                <p>Out Standing</p>
                            </div>
                            <div class = "item">
                                <p>Rp. <?=number_format($os_not_done, 0, '.', '.'); ?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="not_done">
                        <p>Not Done</p>
                    </div>
                </div>
            </div>
            <div class="cap with_border">
                <div class="cap">
                    <div class="tem">
                        <div class = "subject">
                            <p></p>
                        </div>
                        <div class = "item">
                            <p>COUNT</p>
                        </div>
                        <div class = "item">
                            <p>OS SUM</p>
                        </div>
                    </div>
                    <div class="tem">
                        <div class = "subject">
                            <p>Marked As PTP Today</p>
                        </div>
                        <div class = "item">
                            <p><?=$rmData['count_marked']; ?></p>
                        </div>
                        <div class = "item">
                            <p>Rp. <?=number_format($rmData['sum_marked'], 0, '.', '.'); ?> </p>
                        </div>
                    </div>
                    <div class="tem">
                        <div class = "subject">
                            <p>Marked As PTP Yesterday</p>
                        </div>
                        <div class = "item">
                            <p><?=$rmData['count_yesterday']; ?> </p>
                        </div>
                        <div class = "item">
                            <p>Rp. <?=number_format($rmData['sum_yesterday'], 0, '.', '.'); ?> </p>
                        </div>
                    </div>
                    <div class="tem">
                        <div class = "subject">
                            <p>Discrepancy detected</p>
                        </div>
                        <div class = "item">
                            <p><?=$rmData['count_wrong']; ?></p>
                        </div>
                        <div class = "item">
                            <p>Rp. <?=number_format($rmData['sum_wrong'], 0, '.', '.'); ?> </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="texts">
            <p>Showing 
                <?= $total_rows; ?> 
            Rows</p>
        </div>
        <div class="tables">
            <div class="top_tables">
                <div class="show_entries">
                    <p>Show</p>
                    <div class="dropdown">
                        <div class="dropdown-content hide">
                            <a href="/rm/<?= $nama_pn; ?>/1/5">5</a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="9" viewBox="0 0 8 9" fill="none">
                                <path d="M3.62351 6.07L1.22551 3.329C0.942505 3.0065 1.17251 2.5 1.60201 2.5H6.39801C6.49413 2.49992 6.58824 2.52754 6.66906 2.57957C6.74989 2.6316 6.814 2.70582 6.85373 2.79335C6.89346 2.88087 6.90711 2.978 6.89306 3.07309C6.87901 3.16818 6.83785 3.2572 6.77451 3.3295L4.37651 6.0695C4.32957 6.1232 4.2717 6.16625 4.20676 6.19574C4.14182 6.22523 4.07133 6.24049 4.00001 6.24049C3.92868 6.24049 3.85819 6.22523 3.79325 6.19574C3.72831 6.16625 3.67044 6.1232 3.62351 6.0695V6.07Z" fill="#9E9E9E"/>
                            </svg>
                        </div>
                        <div class="current">
                            <a href="/rm/<?= $nama_pn; ?>/1/10">10</a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="9" viewBox="0 0 8 9" fill="none">
                                <path d="M3.62351 6.07L1.22551 3.329C0.942505 3.0065 1.17251 2.5 1.60201 2.5H6.39801C6.49413 2.49992 6.58824 2.52754 6.66906 2.57957C6.74989 2.6316 6.814 2.70582 6.85373 2.79335C6.89346 2.88087 6.90711 2.978 6.89306 3.07309C6.87901 3.16818 6.83785 3.2572 6.77451 3.3295L4.37651 6.0695C4.32957 6.1232 4.2717 6.16625 4.20676 6.19574C4.14182 6.22523 4.07133 6.24049 4.00001 6.24049C3.92868 6.24049 3.85819 6.22523 3.79325 6.19574C3.72831 6.16625 3.67044 6.1232 3.62351 6.0695V6.07Z" fill="#9E9E9E"/>
                            </svg>
                        </div>
                        <div class="dropdown-content hide">
                            <a href="/rm/<?= $nama_pn; ?>/1/20">20</a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="9" viewBox="0 0 8 9" fill="none">
                                <path d="M3.62351 6.07L1.22551 3.329C0.942505 3.0065 1.17251 2.5 1.60201 2.5H6.39801C6.49413 2.49992 6.58824 2.52754 6.66906 2.57957C6.74989 2.6316 6.814 2.70582 6.85373 2.79335C6.89346 2.88087 6.90711 2.978 6.89306 3.07309C6.87901 3.16818 6.83785 3.2572 6.77451 3.3295L4.37651 6.0695C4.32957 6.1232 4.2717 6.16625 4.20676 6.19574C4.14182 6.22523 4.07133 6.24049 4.00001 6.24049C3.92868 6.24049 3.85819 6.22523 3.79325 6.19574C3.72831 6.16625 3.67044 6.1232 3.62351 6.0695V6.07Z" fill="#9E9E9E"/>
                            </svg>
                        </div>
                    </div>
                    <p>entries</p>
                </div>
                <!-- <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M14 14L11.0094 11.004L14 14ZM12.6667 6.99998C12.6667 8.50287 12.0697 9.94421 11.007 11.0069C9.94427 12.0696 8.50293 12.6666 7.00004 12.6666C5.49715 12.6666 4.05581 12.0696 2.9931 11.0069C1.9304 9.94421 1.33337 8.50287 1.33337 6.99998C1.33337 5.49709 1.9304 4.05575 2.9931 2.99304C4.05581 1.93034 5.49715 1.33331 7.00004 1.33331C8.50293 1.33331 9.94427 1.93034 11.007 2.99304C12.0697 4.05575 12.6667 5.49709 12.6667 6.99998V6.99998Z" stroke="#9E9E9E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p>Search...</p>
                </div> -->
            </div>
            <div class="content_tables">
                <div class="rows head">
                    <div class = "no">
                        <p>No</p>
                    </div>
                    <div class = "stdptp">
                        <p>Billing Date</p>
                        <!-- <svg class = "sort_image" xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M4.15138 7.83331H11.8494C12.424 7.83331 12.7294 7.15332 12.3474 6.72332L8.49871 2.39331C8.43628 2.32285 8.35961 2.26644 8.27377 2.2278C8.18792 2.18917 8.09485 2.16919 8.00071 2.16919C7.90657 2.16919 7.8135 2.18917 7.72766 2.2278C7.64181 2.26644 7.56514 2.32285 7.50271 2.39331L3.65271 6.72332C3.27071 7.15332 3.57604 7.83331 4.15138 7.83331ZM7.50204 14.606C7.56447 14.6764 7.64114 14.7329 7.72699 14.7715C7.81284 14.8101 7.9059 14.8301 8.00004 14.8301C8.09418 14.8301 8.18725 14.8101 8.2731 14.7715C8.35895 14.7329 8.43562 14.6764 8.49804 14.606L12.3467 10.276C12.7294 9.84665 12.424 9.16665 11.8487 9.16665H4.15138C3.57671 9.16665 3.27138 9.84665 3.65338 10.2766L7.50204 14.606Z" fill="#9E9E9E"/>
                        </svg> -->
                    </div>
                    <div class = "stdptp">
                        <p>No Rekening</p>
                        <!-- <svg class = "sort_image" xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M4.15138 7.83331H11.8494C12.424 7.83331 12.7294 7.15332 12.3474 6.72332L8.49871 2.39331C8.43628 2.32285 8.35961 2.26644 8.27377 2.2278C8.18792 2.18917 8.09485 2.16919 8.00071 2.16919C7.90657 2.16919 7.8135 2.18917 7.72766 2.2278C7.64181 2.26644 7.56514 2.32285 7.50271 2.39331L3.65271 6.72332C3.27071 7.15332 3.57604 7.83331 4.15138 7.83331ZM7.50204 14.606C7.56447 14.6764 7.64114 14.7329 7.72699 14.7715C7.81284 14.8101 7.9059 14.8301 8.00004 14.8301C8.09418 14.8301 8.18725 14.8101 8.2731 14.7715C8.35895 14.7329 8.43562 14.6764 8.49804 14.606L12.3467 10.276C12.7294 9.84665 12.424 9.16665 11.8487 9.16665H4.15138C3.57671 9.16665 3.27138 9.84665 3.65338 10.2766L7.50204 14.606Z" fill="#9E9E9E"/>
                        </svg> -->
                    </div>
                    <div class = "debitur">
                        <p>Debitur</p>
                        <!-- <svg class = "sort_image" xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M4.15138 7.83331H11.8494C12.424 7.83331 12.7294 7.15332 12.3474 6.72332L8.49871 2.39331C8.43628 2.32285 8.35961 2.26644 8.27377 2.2278C8.18792 2.18917 8.09485 2.16919 8.00071 2.16919C7.90657 2.16919 7.8135 2.18917 7.72766 2.2278C7.64181 2.26644 7.56514 2.32285 7.50271 2.39331L3.65271 6.72332C3.27071 7.15332 3.57604 7.83331 4.15138 7.83331ZM7.50204 14.606C7.56447 14.6764 7.64114 14.7329 7.72699 14.7715C7.81284 14.8101 7.9059 14.8301 8.00004 14.8301C8.09418 14.8301 8.18725 14.8101 8.2731 14.7715C8.35895 14.7329 8.43562 14.6764 8.49804 14.606L12.3467 10.276C12.7294 9.84665 12.424 9.16665 11.8487 9.16665H4.15138C3.57671 9.16665 3.27138 9.84665 3.65338 10.2766L7.50204 14.606Z" fill="#9E9E9E"/>
                        </svg> -->
                    </div>
                    <div class = "stdptp">
                        <p>Plafond</p>
                        <!-- <svg class = "sort_image" xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M4.15138 7.83331H11.8494C12.424 7.83331 12.7294 7.15332 12.3474 6.72332L8.49871 2.39331C8.43628 2.32285 8.35961 2.26644 8.27377 2.2278C8.18792 2.18917 8.09485 2.16919 8.00071 2.16919C7.90657 2.16919 7.8135 2.18917 7.72766 2.2278C7.64181 2.26644 7.56514 2.32285 7.50271 2.39331L3.65271 6.72332C3.27071 7.15332 3.57604 7.83331 4.15138 7.83331ZM7.50204 14.606C7.56447 14.6764 7.64114 14.7329 7.72699 14.7715C7.81284 14.8101 7.9059 14.8301 8.00004 14.8301C8.09418 14.8301 8.18725 14.8101 8.2731 14.7715C8.35895 14.7329 8.43562 14.6764 8.49804 14.606L12.3467 10.276C12.7294 9.84665 12.424 9.16665 11.8487 9.16665H4.15138C3.57671 9.16665 3.27138 9.84665 3.65338 10.2766L7.50204 14.606Z" fill="#9E9E9E"/>
                        </svg> -->
                    </div>
                    <div class = "kduko">
                        <p>Restruk</p>
                        <!-- <svg class = "sort_image" xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M4.15138 7.83331H11.8494C12.424 7.83331 12.7294 7.15332 12.3474 6.72332L8.49871 2.39331C8.43628 2.32285 8.35961 2.26644 8.27377 2.2278C8.18792 2.18917 8.09485 2.16919 8.00071 2.16919C7.90657 2.16919 7.8135 2.18917 7.72766 2.2278C7.64181 2.26644 7.56514 2.32285 7.50271 2.39331L3.65271 6.72332C3.27071 7.15332 3.57604 7.83331 4.15138 7.83331ZM7.50204 14.606C7.56447 14.6764 7.64114 14.7329 7.72699 14.7715C7.81284 14.8101 7.9059 14.8301 8.00004 14.8301C8.09418 14.8301 8.18725 14.8101 8.2731 14.7715C8.35895 14.7329 8.43562 14.6764 8.49804 14.606L12.3467 10.276C12.7294 9.84665 12.424 9.16665 11.8487 9.16665H4.15138C3.57671 9.16665 3.27138 9.84665 3.65338 10.2766L7.50204 14.606Z" fill="#9E9E9E"/>
                        </svg> -->
                    </div>
                    <div class = "kduko">
                        <p>Kol ADK</p>
                        <!-- <svg class = "sort_image" xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M4.15138 7.83331H11.8494C12.424 7.83331 12.7294 7.15332 12.3474 6.72332L8.49871 2.39331C8.43628 2.32285 8.35961 2.26644 8.27377 2.2278C8.18792 2.18917 8.09485 2.16919 8.00071 2.16919C7.90657 2.16919 7.8135 2.18917 7.72766 2.2278C7.64181 2.26644 7.56514 2.32285 7.50271 2.39331L3.65271 6.72332C3.27071 7.15332 3.57604 7.83331 4.15138 7.83331ZM7.50204 14.606C7.56447 14.6764 7.64114 14.7329 7.72699 14.7715C7.81284 14.8101 7.9059 14.8301 8.00004 14.8301C8.09418 14.8301 8.18725 14.8101 8.2731 14.7715C8.35895 14.7329 8.43562 14.6764 8.49804 14.606L12.3467 10.276C12.7294 9.84665 12.424 9.16665 11.8487 9.16665H4.15138C3.57671 9.16665 3.27138 9.84665 3.65338 10.2766L7.50204 14.606Z" fill="#9E9E9E"/>
                        </svg> -->
                    </div>
                    <div class = "right stdptp">
                        <p>Baki Debet</p>
                        <!-- <svg class = "sort_image" xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M4.15138 7.83331H11.8494C12.424 7.83331 12.7294 7.15332 12.3474 6.72332L8.49871 2.39331C8.43628 2.32285 8.35961 2.26644 8.27377 2.2278C8.18792 2.18917 8.09485 2.16919 8.00071 2.16919C7.90657 2.16919 7.8135 2.18917 7.72766 2.2278C7.64181 2.26644 7.56514 2.32285 7.50271 2.39331L3.65271 6.72332C3.27071 7.15332 3.57604 7.83331 4.15138 7.83331ZM7.50204 14.606C7.56447 14.6764 7.64114 14.7329 7.72699 14.7715C7.81284 14.8101 7.9059 14.8301 8.00004 14.8301C8.09418 14.8301 8.18725 14.8101 8.2731 14.7715C8.35895 14.7329 8.43562 14.6764 8.49804 14.606L12.3467 10.276C12.7294 9.84665 12.424 9.16665 11.8487 9.16665H4.15138C3.57671 9.16665 3.27138 9.84665 3.65338 10.2766L7.50204 14.606Z" fill="#9E9E9E"/>
                        </svg> -->
                    </div>
                    <div class = "no">
                        <p>Status</p>
                    </div>
                </div> 
                <?php foreach ($rm as $key => $row) : ?>
                    <!-- <a href="#"> -->
                        <div class="rows content">
                            <div class = "no">
                                <p><?= $key + 1 + ($limit * ($current_page - 1)); ?></p>
                            </div>
                            <div class = "stdptp">
                                <p><?= $row->tanggal_bayar; ?></p>
                            </div> 
                            <div class = "stdptp">
                                <p><?= $row->no_rek; ?></p>
                            </div>
                            <div class = "debitur">
                                <p><?= $row->debitur; ?></p>
                            </div>
                            <div class = "stdptp">
                                <p><?= number_format($row->pinjaman, 0, ",","."); ?></p>
                            </div>
                            <div class = "kduko">
                                <p><?= $row->flag; ?></p>
                            </div>
                            <div class = "kduko">
                                <p><?= $row->kol; ?></p>
                            </div>
                            <div class = "right stdptp">
                                <p><?= number_format($row->os1 + $row->os2 +$row->os3 +$row->os4 + $row->os5 , 0, ",","."); ?></p>
                            </div>
                            <div class = "no">
                                <button onclick="showForm(<?= $row->no_rek; ?>)">Done</button>
                            </div>
                        </div>
                        <div class="overlay" id="<?= $row->no_rek; ?>" onclick="hideForm(<?= $row->no_rek; ?>)">
                            <div class="modal" id="modal" onclick="event.stopPropagation();">
                                <span onclick="hideForm(<?= $row->no_rek; ?>)" style="cursor: pointer; float: right;">&times;</span>
                                <form id = "hiddenForm" method="post" action="<?= base_url("/add/$nama_pn"); ?>">
                                    <input type="hidden" name="no_rek" value="<?= $row->no_rek; ?>">

                                    <label for="keterangan">keterangan:</label>
                                    <input type="keterangan" name="keterangan" id="keterangan">

                                    <input type="submit" value="Submit">
                                </form>
                            </div>
                        </div>
                    <!-- </a> -->
                <?php endforeach;?>
            </div>
            <div class="bot_tables">
                <div class="centerer">
                    <?php if ($current_page > 1) : ?>
                        <a href="/rm/<?= $nama_pn; ?>/<?= $current_page - 1; ?>/<?= $limit; ?>">
                            <div class="bot_text">
                                <p>Previous</p>
                            </div>
                        </a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <a href="/rm/<?= $nama_pn; ?>/<?= $i; ?>/<?= $limit; ?>">
                            <?php if ($i == $current_page) : ?>
                                <div class="page_button selected">
                            <?php else : ?>
                                <div class="page_button">
                            <?php endif; ?>
                                    <p><?= $i; ?></p>
                                </div>
                        </a>
                    <?php endfor; ?>
                    <?php if ($current_page < $total_pages) : ?>
                        <a href="/rm/<?= $nama_pn; ?>/<?= $current_page + 1; ?>/<?= $limit; ?>">
                            <div class="bot_text">
                                <p>Next</p>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
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
    <script>
        function showForm(a) {
            var overlay = document.getElementById(a);
            overlay.style.display = 'flex';
        }

        function hideForm(a) {
            var overlay = document.getElementById(a);
            overlay.style.display = 'none';
        }
    </script>    
</body>

