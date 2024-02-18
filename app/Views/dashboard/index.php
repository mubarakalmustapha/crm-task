<?= $this->extend("layout/dashboard-layout"); ?>

<?= $this->section("content"); ?>
<button class="three-dot-one">
<img  src="<?= base_url('/img/Vectorgjks.png'); ?>" alt="">
</button>

<div class="boxes">
    <div class="box">
        <div class="box-container">
            <img src="<?= base_url('/img/Frame.png'); ?>" alt="">
            <h1>0/0</h1>
        </div>
        <div class="invoice-container">
            <p>Invoices awaiting payment</p>
            <img class="gray-line" src="<?= base_url('/img/Rectangle 78.png'); ?>" alt="">
        </div>
    </div>
    <div class="box">
        <div class="box-container">
            <img src="<?= base_url('/img/Frameawsd.png'); ?>" alt="">
            <h1>0/0</h1>
        </div>
        <div class="invoice-container">
            <p>Converted Leads</p>
            <img class="gray-line" src="<?= base_url('/img/Rectangle 78.png'); ?>" alt="">
        </div>
    </div>
    <div class="box">
        <div class="box-container">
            <img src="<?= base_url('/img/Frame.png'); ?>" alt="">
            <h1>0/0</h1>
        </div>
        <div class="invoice-container">
            <p>Projects in Progress</p>
            <img class="gray-line" src="<?= base_url('/img/Rectangle 78.png'); ?>" alt="">
        </div>
    </div>
    <div class="box">
        <div class="box-container">
            <img src="<?= base_url('/img/Frameawsd.png'); ?>" alt="">
            <h1>0/0</h1>
        </div>
        <div class="invoice-container">
            <p>Tasks overdue</p>
            <img class="gray-line" src="<?= base_url('/img/Rectangle 78.png'); ?>" alt="">
        </div>
    </div>
</div>

<div class="container1">
    <div>
        <div class="left-content">
            <img src="<?= base_url('/img/NT2 1.png'); ?>" alt="">
        </div>
        
<div class="table-1">
    <table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Countdown</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>Tags</th>
            <th>Priority</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
    <tr>
    <td><p><?= substr($task['id'], 0, 4) . '...'; ?></p></td>
        <td><p><?= $task['Name1']; ?></p></td>
        <td><p><?= $task['Countdown']; ?></p></td>
        <td class="<?= getStatusClass($task['Status'], 'td'); ?>">
            <p><?= $task['Status']; ?></p>
        </td>
        <td><p><?= $task['Start_date1']; ?></p></td>
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
    <div>
        <div>
            <div class="right-content-one">
                <div>
                    <p class="first-p">My To Do Items</p>
                    <div>
                        <p>New To Do</p>
                        <p>View All</p>
                    </div>
                </div>
            </div>
            <div class="right-content-two">
                <div class="danger">
                    <img src="<?= base_url('/img/Vectord.png'); ?>" alt="">
                    <span>Latest to do’s</span>
                </div>
                <div class="check">
                    <input type="checkbox">
                    <p>
                        Go through and utilize every feature in this 
                        platform short comings of the platform 
                        ways to improve the platform
                    </p>
                </div>
                <div class="disply-time">
                    <span>2024-01-31    17:42:04</span> 
                    <div>
                        <div class="icons">
                            <img src="<?= base_url('/img/Vectorhhhhhh.png'); ?>" alt="">
                            <img src="<?= base_url('/img/Vectorggvh.png'); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="right-content-three">
            <p class="first-p">Leads Overview</p>
        </div>
    
        <div class="right-content-four">
            <img class="chart-bar" src="<?= base_url('/img/Frame 335.png'); ?>" alt="">
        </div>
    </div>
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
