﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>

        <div class="block">    
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter Old Password..."  name="adminPass" class="medium" />
                        </td>
                    </tr>
    				<tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="" class="medium" />
                        </td>
                    </tr>
    				<tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>