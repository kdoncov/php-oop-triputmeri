<div id="footer-content">
    <ul id="footer-list">
        <li><a href="contact.php">KONTAKT</a></li>
        <li id="footer_list_rw"><b>BESPLATNA DOSTAVA ZA PORUDŽBINE VEĆE OD 10000 RSD.</b></li>
        <li>
            <table id="footer-info">
                <tr>
                    <td rowspan="2"><i class="fa fa-map-marker" style="font-size:18px"></i></td>
                    <td>34000 Kragujevac</td>
                </tr>
                <tr>
                    <td>Nemanjina 5 tel.034/123-456</td>
                </tr>
            </table>
        </li>
    </ul>
</div>
<div id="hidden-footer">
<table>
    <tr>
        <th>Pomoć i informacije</th>
    </tr>
    <tr>
        <td><a href="shipping.php">Dostava</a></td>
        <td>
        <?php
        if (!isset($_SESSION['user'])){
            echo "<a href='login.php'>Login / registracija</a>";
        }
        else {
            echo "<a href='logout.php'>Logout</a>";
        }
        ?>
        </td>
    </tr>
    <tr>
        <td><a href="Return.php">Vraćanje i Zamena</a></td>
    </tr>
</table>
</div>
<script src="js/myJavaScript.js"></script>
