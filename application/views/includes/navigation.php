    <nav id="nav-container" class="nav-container">

        <button id="nav-my-build" class="nav-button">
            <img src="<?=base_url();?>assets/icons/assignment_24.png" alt="See My Build" class="nav-button-icon">
            <span>See My Build</span>
        </button>
        <button id="nav-search-builds" class="nav-button">
            <img src="<?=base_url();?>assets/icons/layers_24.png" alt="Search By Builds" class="nav-button-icon">
            <span>Search By Builds</span>
        </button>
        <button id="nav-mobile-dropdown-categories" class="nav-button nav-button__mobile">
            <img src="<?=base_url();?>assets/icons/list_24.png" alt="Search By Category" class="nav-button-icon">
            <span>Search By Category</span>
            <img 
                src="<?=base_url();?>assets/icons/expand_more_24w.png" 
                class="nav-button-expand-more"
            >
            <img 
                src="<?=base_url();?>assets/icons/expand_less_24w.png" 
                class="nav-button-expand-less"
            >
        </button>
        <button id="nav-search-categories" class="nav-button nav-button__desktop">
            <img src="<?=base_url();?>assets/icons/list_24.png" alt="Search By Category" class="nav-button-icon">
            <span>Search By Category</span>
            <img 
                src="<?=base_url();?>assets/icons/expand_more_24w.png" 
                id="nav-button-expand-more" 
                class="nav-button-expand-more"
            >
            <img 
                src="<?=base_url();?>assets/icons/expand_less_24w.png" 
                id="nav-button-expand-less" 
                class="nav-button-expand-less"
            >
        </button>
        <!-- Mobile Category Dropdown Menu -->
        <?php include(APPPATH.'views/partials/navigation/nav_mobile_dropdown.php');?>

        <button id="nav-resources" class="nav-button">
            <img src="<?=base_url();?>assets/icons/book_24.png" alt="Resources" class="nav-button-icon">
            <span>Resources</span>
        </button>

    </nav>
    <!-- Desktop Category Dropdown Menu -->
    <?php include(APPPATH.'views/partials/navigation/nav_dropdown.php');?>

    <!-- Start of Main Page -->
    <main class="main-container"> 