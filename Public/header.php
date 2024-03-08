<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$username = "";

if (isset($_SESSION['loggedIn'])) {
    if ($_SESSION['loggedIn'] == true) {
        $username = " - " . $_SESSION['username'];
    }
}



echo ('
            <tr id="headerTableRow">
                <td id="headerTableData">
                    <!-- Header Table -->
                    <table id="headerTable">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="./index.php" class="headerP"><img src="./IMAGES/poster.png" width="38" height="38"></a>
                                </td>
                                <td>
                                    <h1 class="headerP">Poster' . $username . '</h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
');
