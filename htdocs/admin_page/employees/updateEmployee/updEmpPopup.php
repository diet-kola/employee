<div class="modal" id="updateEmployeeModal" style="display: <?= $showUpdModal ? 'flex' : 'none' ?>;">
    <div class="modal-content">
        <span class="close" id="closeUpdateModal">&times;</span>

        <h2>Update Employee</h2>
 
        <?php if (!empty($updError)) { ?>
            <p id="updErrMsg">
                <?php echo $updError;?>
            </p>
        <?php } ?>

        <form id="updateEmployeeForm" method="POST" action=".">
            
            <input type="hidden" name="action" value="updateEmployee">
            <input type="hidden" name="updateId" id="updateId">

            <label>First Name</label>
            <input type="text" name="first_name" id="updateFirstName">

            <label>Last Name</label>
            <input type="text" name="last_name" id="updateLastName">

            <label>Email</label>
            <input type="email" name="email" id="updateEmail">

            <label>Contact No</label>
            <input type="text" name="phoneNum" id="updatePhoneNum">

            <label>Position</label>
            <select name="position_id" id="updatePosition">
                <option value="">Select Option</option>
                <?php foreach ($positions as $row): ?>
                    <option value="<?= $row['position_id'] ?>"><?= $row['position_name'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="submit-btn">Update Employee</button>
        </form>
    </div>
</div>