<!DOCTYPE html>
<html>
    <head>
        <title>Web Journey Leaderboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/indexCSS.css">
    </head>
    <body>
    <div id="leaderboard-parent">
        <div id="leaderboard">
        <h1>Tablica rankingowa</h1>
        <div id="tabela">
            <table>
                <tr>
                    <th>Miejsce</th>
                    <th>Login</th>
                    <th>Punkty</th>
                </tr>
                <?php
                include ('../php/connect.php');

                $sql = "SELECT login_user, score_user FROM users ORDER BY score_user DESC ";
                $res = mysqli_query($conn, $sql);
                $i = 0;
                if ($res->num_rows>0)
                {
                    while($row=$res->fetch_assoc())
                    {
                        $i++;
                        echo '<tr><td>'.$i.'.</td>'.
                        '<td>'.$row["login_user"]."</td>".
                        "<td>".$row["score_user"]."</td></tr>";
                    }
                }
                ?>
            </table>
            </div>
        </div>
        </div>
    </body>
</html>
