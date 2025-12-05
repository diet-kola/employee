<div class="modal" id="addEmployeeModal" style="display: <?= $showAddModal ? 'flex' : 'none' ?>;">
        <div class="modal-content">
            <span class="close" id="closeAddEmployee">&times;</span>

            <h2>Add Employee</h2>

            <form class="addEmployee" action="." method="POST">
                <input type="hidden" name="action" value="addEmployee">

                <?php if (!empty($addError)) { ?>
                    <p id="addErrMsg"><?php echo $addError; ?></p>
                <?php } ?>

                <label>First Name</label>
                <input type="text" name="first_name">

                <label>Last Name</label>
                <input type="text" name="last_name">

                <label>Email</label>
                <input type="email" name="email">

                <label>Contact No</label>
                <input type="text" name="phoneNum">

                <label>Position</label>
                <select name="position_id">
                    <option value="">Select Option</option>
                    <?php foreach ($positions as $row) { ?>
                        <option value="<?= $row['position_id'] ?>">
                            <?php echo $row['position_name'] ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" class="submit-btn">Add Employee</button>
            </form>
        </div>
    </div>