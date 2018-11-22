    <header>
        <div class="header-container">
            <a href="<?= base_url();?>main" class="header-title">
                <img src="<?= base_url();?>assets/logos/logo-header.svg" class="header-logo" alt="growpartpicker">
            </a>
            <div class="header-content">
                <div class="header-searchbar">
                    <input type="text" class="header-search-input" placeholder="What are you looking for?">
                    <button type="submit" class="header-search-button">
                        <img src="<?= base_url();?>assets/icons/search_24.svg">
                    </button>
                </div>
                <a href="<?= base_url();?>users/signin" class="header-link-login">Log In</a>
                <a href="<?= base_url();?>users/signup" class="header-link-signup">Sign Up</a>
                <button id="header-nav-button" class="header-nav-button">
                    <img src="<?=base_url();?>assets/icons/menu_36.png" alt="Menu" class="header-nav-menu">
                </button>
            </div>
        </div>
    </header>
