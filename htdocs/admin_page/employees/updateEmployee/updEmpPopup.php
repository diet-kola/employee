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
            <input type="hidden" name="updateId" id="updateId" value="<?= isset($_POST['updateId']) ? $_POST['updateId'] : '' ?>">

            <label>First Name</label>
            <input type="text" name="first_name" id="updateFirstName" value="<?= isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '' ?>">

            <label>Last Name</label>
            <input type="text" name="last_name" id="updateLastName" value="<?= isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '' ?>">

            <label>Email</label>
            <input type="email" name="email" id="updateEmail"  value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" >

            <label>Contact No</label>
            <input type="text" name="phoneNum" id="updatePhoneNum"  value="<?= isset($_POST['phoneNum']) ? htmlspecialchars($_POST['phoneNum']) : '' ?>">

            <label>Position</label>
            <select name="position_id" id="updatePosition">
                <option value="">Select Option</option>
                <?php foreach ($positions as $row): ?>
                    <option value="<?= $row['position_id'] ?>" 
                        <?= (isset($_POST['position_id']) && $_POST['position_id'] == $row['position_id']) ? 'selected' : '' ?>>
                        <?= $row['position_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="submit-btn">Update Employee</button>
        </form>
    </div>
</div>