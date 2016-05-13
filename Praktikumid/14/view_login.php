<!doctype html>
<html>
    <head>
        <meta charset="utf8" />
        <title>Logi sisse</title>
    </head>
    <body>

        <h1>Logi sisse</h1>

        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">

            <input type="hidden" name="action" value="login">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

            <table>
                <tr>
                    <td>Kasutajanimi</td>
                    <td>
                        <input type="text" name="kasutajanimi" required>
                    </td>
                </tr>
                <tr>
                    <td>Parool</td>
                    <td>
                        <input type="password" name="parool" required>
                    </td>
                </tr>
            </table>

            <p>
                <button type="submit">Logi sisse</button> või <a href="<?= $_SERVER['PHP_SELF']; ?>?view=register">registreeri konto</a>
            </p>

        </form>
    </body>
</html>
