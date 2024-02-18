<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('/css/style.css'); ?>">

</head>

<body>
    <div class="container">
        <div class="sidebar">
        <img class="talk-icon" src="<?= base_url('/img/text-image.png'); ?>" alt="Dashboard Icon">
            <ul class="sidebar-list">
    <li class="sidebar-list-item">
        <a href="<?= base_url('dashboard'); ?>" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/Vector.png'); ?>" alt="Dashboard Icon">
            Dashboard
        </a>
    </li>
    <li class="sidebar-list-item">
        <a href="<?= base_url('dashboard/customers'); ?>" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/Vector1.png'); ?>"ng alt="Customer Icon">
            Customer
        </a>
    </li>
    <li class="sidebar-list-item">
        <a href="#" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/carbon_sales-ops.png'); ?>" alt="Sales Icon">
            Sales
        </a>
    </li>
    <li class="sidebar-list-item">
        <a href="<?= base_url('dashboard/task'); ?>" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/material-symbols_task-outline.png'); ?>" alt="Tasks Icon">
            Tasks
        </a>
    </li>
    <li class="sidebar-list-item">
        <a href="#" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/mdi_deal-outline.png'); ?>" lt="SLA Icon">
            SLA
        </a>
    </li>
    <li class="sidebar-list-item">
        <a href="#" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/humbleicons_support.png'); ?>" alt="Support Icon">
            Support
        </a>
    </li>
    <li class="sidebar-list-item">
        <a href="#" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/Group.png'); ?>" alt="Utilities Icon">
            Utilities
        </a>
    </li>
    <li class="sidebar-list-item">
        <a href="#" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/iconoir_reports-solid.png'); ?>" alt="Reports Icon">
            Reports
        </a>
    </li>
    <li class="sidebar-list-item">
        <a href="#" class="sidebar-link" onclick="handleItemClick(this)">
            <img src="<?= base_url('/img/ep_set-up.png'); ?>" alt="Setup Icon">
            Set up
        </a>
    </li>
</ul>
        </div>
        <div class="main-content">
            <div class="navbar">
            <div class="welcome-text">
                 Welcome <?= session()->get('full_name'); ?>
            </div>

                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search...">
                    <img src="<?= base_url('/img/search icon.png'); ?>" alt="Search Icon" class="search-icon">
                </div>

                <div class="navbar-icons">
                <img src="<?= base_url('/img/Vectorswe.png'); ?>" alt="Setup Icon">
                <img src="<?= base_url('/img/Vector123.png'); ?>" alt="Setup Icon">
                <img src="<?= base_url('/img/Vector23e.png'); ?>" alt="Setup Icon">
                <img src="<?= base_url('/img/Vector11.png'); ?>" alt="Setup Icon">
                </div>
            </div>
           <?= $this->renderSection("content");?>
        </div>

    </div>

    <script>
        function handleItemClick(link) {
            const links = document.querySelectorAll('.sidebar-link');
            links.forEach(item => {
                item.classList.remove('active-link');
            });
            link.classList.add('active-link');
        }

        
    </script>
</body>

</html>
