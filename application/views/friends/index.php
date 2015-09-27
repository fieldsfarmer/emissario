<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
    <h2>Friends</h2>
    <div>
        <table>
            <tr class="header">
                <td>First Name</td>
                <td>Last Name</td>
                <td>City</td>
                <td>State</td>
                <td>Country</td>
            </tr>
            <?php foreach ($friends as $friend) { ?>
                <tr>
                    <td><?php echo $friend->First_Name ?></td>
                    <td><?php echo $friend->Last_Name ?></td>
                    <td><?php echo $friend->City ?></td>
                    <td><?php echo $friend->State ?></td>
                    <td><?php echo $friend->Country ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
