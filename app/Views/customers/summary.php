<?= $this->extend("layout/dashboard-layout"); ?>

<?= $this->section("content"); ?>
<button class="three-dot-two">
    <img class="threedot" src="<?= base_url('/img/Vectorgjks.png'); ?>" alt="">
</button>

<div class="container2">
    <div>
        <div class="task-content-1">
            <div>
                <button class="news-task" onclick="openPopupForm()">NEW TASK</button>
                <button class="news-task">IMPORT CUSTOMERS</button>
            </div>
            <div class="overview-div">
                
                <button class="task-overview-icon">
                    <img src="<?= base_url('/img/images.png'); ?>" alt="">
                </button>
            </div>

        </div>
        <div class="task-content">
            <h3>Customers Summary</h3>
        </div>

        <div class="overlay" id="overlay" onclick="closePopupForm()"></div>
        <form action="<?= base_url('dashboard/customer/add'); ?>" method="post">

            <div class="popup-form" id="popupForm">
                <div class="popup-header">
                    <h2>New Customer</h2>
                    <button type="button" onclick="closePopupForm()">X</button>
                </div>

                <!-- Company -->
                <div class="form-group">
                    <label for="company">Company:</label>
                    <input type="text" id="company" name="company" />
                </div>

                <div class="form-group">
                    <label for="primaryEmail">Primary Email:</label>
                    <input type="text" id="primaryEmail" name="primaryEmail" />
                </div>

                <!-- Phone Number and Website (Inline) -->
                <div class="form-group inline">
                    <div>
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" />
                    </div>
                    <div>
                        <label for="website">Website:</label>
                        <input type="text" id="website" name="website" />
                    </div>
                </div>

                <!-- City and State (Inline) -->
                <div class="form-group inline">
                    <div>
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" />
                    </div>
                    <div>
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" />
                    </div>
                </div>

                <!-- Zip Code and Country (Inline) -->
                <div class="form-group inline">
                    <div>
                        <label for="zipCode">Zip Code:</label>
                        <input type="text" id="zipCode" name="zipCode" />
                    </div>
                    <div>
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" />
                    </div>
                </div>

                <div class="button-container">
                    <!-- Use type="submit" to make the button submit the form -->
                    <button type="submit" class="save-button">Save</button>
                    <button class="close-button" type="button" onclick="closePopupForm()">Close</button>
                </div>
            </div>
        </form>

        
        <div class="table-2">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>#</th>
                    <th>Company</th>
                    <th>Primary Contact</th>
                    <th>Primary Email</th>
                    <th>Phone</th>
                    <th>Active</th>
                    <th>Groups</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $task): ?>
    <tr>
        <td><input type="checkbox" class="taskCheckbox" value="<?= $task['id'] ?? ''; ?>"></td>
        <td>
            <span><?= $task['id'] ?? ''; ?></span>
        </td>
        <td><p><?= $task['Company'] ?? ''; ?></p></td>
        <td><p><?= $task['Primary_Contact'] ?? ''; ?></p></td>
        <td><p><?= $task['Primary_Email'] ?? ''; ?></p></td>
        <td><p><?= $task['Phone'] ?? ''; ?></p></td>
        <td>
            <div class="toggle-switch <?= (isset($task['Status']) && $task['Status'] === 'Active') ? 'active' : ''; ?>" onclick="toggleStatus(this)">
                <div class="toggle-handle"></div>
            </div>
        </td>
        <td><p><?= implode(', ', $task['Tag'] ?? []); ?></p></td>
        <td>
            <p><?= $task['Date_Created'] ?? ''; ?></p>
        </td>
    </tr>
<?php endforeach; ?>


    </tbody>
    </table>

            <div class="pagination-container">
                <p>Showing 1 to 8 of 3 entries</p>
                <div class="pagination-buttons">
                    <p>Previous</p>
                    <button>1</button>
                    <p>Next</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openPopupForm() {
            document.getElementById('popupForm').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closePopupForm() {
            document.getElementById('popupForm').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }


        function toggleStatus(element) {
            element.classList.toggle('active');
        }
        

    </script>
</div>

<?= $this->endSection(); ?>

<?php
function getStatusClass($status) {
    switch (strtolower($status)) {
        case 'in progress':
            return 'status in-progress';
        case 'to do':
            return 'status todo';
        case 'done':
            return 'status done';
        case 'overdue':
            return 'status overdue';
        default:
            return '';
    }
}

function getPriorityClass($priority) {
    switch (strtolower($priority)) {
        case 'high':
            return 'priority-high';
        case 'medium':
            return 'priority-medium';
        case 'low':
            return 'priority-low';
        default:
            return '';
    }
}
?>
