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
                <button class="switch-task">SWITCH TO KAN BAN</button>
            </div>
            <div class="overview-div">
                <button class="task-overview">TASK OVERVIEW</button>
                <button class="task-overview-icon">
                    <img src="<?= base_url('/img/images.png'); ?>" alt="">
                </button>
            </div>
        </div>
        <div class="task-content">
            <h3>Tasks Summary</h3>
        </div>

        <div style="color: red;">
                <?= \Config\Services::validation()->listErrors(); ?>
        </div>
        <div class="overlay" id="overlay" onclick="closePopupForm()"></div>
        <form action="<?= base_url('dashboard/task'); ?>" method="post">
 
            <div class="popup-form" id="popupForm">
                <div class="popup-header">
                    <h2>New Task</h2>
                    <button type="button" onclick="closePopupForm()">X</button>
                </div>

                <!-- Display validation errors with red color -->
                <?php if (\Config\Services::validation()->getErrors()): ?>
                    <div style="color: red;">
                        <?= \Config\Services::validation()->listErrors(); ?>
                    </div>
                <?php endif; ?>


                <!-- Name -->
                <div class="form-group">
                    <label for="taskName">Name</label>
                    <input type="text" id="taskName" name="taskName" />
                </div>

                <!-- Hourly Rate -->
                <div class="form-group">
                    <label for="hourlyRate">Hourly Rate</label>
                    <input type="text" id="hourlyRate" name="hourlyRate" />
                </div>

                <!-- Start Date and Due Date (Inline) -->
                <div class="form-group inline">
                    <div>
                        <label for="startDate">Start Date</label>
                        <select id="startDate" name="startDate">
                            <option value="24">24hrs</option>
                            <option value="48">48hrs</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div>
                        <label for="dueDate">Due Date</label>
                        <select id="dueDate" name="dueDate">
                            <option value="24">24hrs</option>
                            <option value="48">48hrs</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>

                <!-- Priority and Related to (Inline) -->
                <div class="form-group inline">
                    <div>
                        <label for="priority">Priority</label>
                        <select id="priority" name="priority">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div>
                        <label for="relatedTo">Related To</label>
                        <select id="relatedTo" name="relatedTo">
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                            <option value="Low">Low</option>
                            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="customers">Customers</label>
                    <?php if (!empty($customers)): ?>
                        <select id="customers" name="customers[]" multiple>
                            <?php foreach ($customers as $customer): ?>
                                <option value="<?= $customer['id']; ?>"><?= $customer['company_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <p>No customers available. Please add customers first.</p>
                    <?php endif; ?>
                </div>

                <!-- Task Description -->
                <div class="form-group">
                    <label for="taskDescription">Task Description</label>
                    <textarea id="taskDescription" name="taskDescription"></textarea>
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
            <th>Name</th>
            <th>Status</th>
            <th>SLA Status</th>
            <th>Customers</th>
            <th>Tags</th>
            <th>Priority</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><input type="checkbox" class="taskCheckbox" value="<?= $task['id']; ?>"></td>
                <td>
                    <span><?= $task['id']; ?></span>
                    <img style="width: 12px;" src="<?= base_url('/img/down.png'); ?>" alt="ID Icon" style="margin-right: 5px;">
                </td>
                <td><p><?= $task['Name1']; ?></p></td>
                <td class="<?= getStatusClass($task['Status'], 'td'); ?>" style="position: relative;">
                    <p><?= $task['Status']; ?></p>
                    <img style="position: absolute; right: 20px; top: 28px; width: 13px" src="<?= base_url('/img/down.png'); ?>" alt="Status Icon" style="margin-right: 5px;">
                </td>
                <td>
                    <p><?= $task['Sla_Status'] . 'hrs' . 'mins'; ?></p>
                </td>
                <td>
                    <?php foreach ($task['Customers'] as $customer): ?>
                        <img src="<?= base_url('/img/Vector11.png'); ?>" alt="Customer Icon" style="margin-right: 15px;">
                    <?php endforeach; ?>
                </td>
                <td><p><?= $task['Target']; ?></p></td>
                <td class="Priority <?= getPriorityClass($task['Priority'], 'td'); ?>">
                    <p><?= $task['Priority']; ?></p>
                    <img src="<?= base_url('/img/down.png'); ?>" alt="">
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
