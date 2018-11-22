window.addEventListener('DOMContentLoaded', () => {
    /* General Functions */

    /* Header Links */

    /* Navigation Links */

    // Mobile Main Navigation Toggle
    const mobileMenuBtn = document.getElementById('header-nav-button');
    const navContainer = document.getElementById('nav-container');
    let navContainerHeight = '';

    function getNavContainerHeight() {
        navContainerHeight = navContainer.offsetHeight;
    };

    function setNavContainerMaxHeight() {
        navContainer.style.maxHeight = navContainerHeight + 'px';
    };

    function closeMobileDropdownNavigation() {
        navMobileDropdownContainer.style.maxHeight = '0px';
    }

    // Call functions to set variables for use of mobile menu open/close transitioning
    getNavContainerHeight();
    setNavContainerMaxHeight();

    // Toggle for mobile menu 'hamburger' icon
    toggleMobileMenu = () => {
        if (navContainer.offsetHeight > 0) {
            // Close the mobile nav menu
            navContainer.style.maxHeight = '0px';
        }
        else {
            // Open mobile nav menu
            // close category dropdown menu before opening nav
            closeMobileDropdownNavigation();
            navContainer.style.maxHeight = navContainerHeight + 'px';
        }
    }

    // Trigger for mobile menu 'hamburger' icon to show or display mobile menu
    mobileMenuBtn.addEventListener('click', toggleMobileMenu);


    // Mobile Dropdown Category Menu
    const navMobileDropdownContainer = document.getElementById('nav-mobile-dropdown-container');
    const navMobileDropdownMenu = document.getElementById('nav-mobile-dropdown-menu');
    const navMobileDropdownMenuMaxHeight = parseInt(navMobileDropdownMenu.scrollHeight);


    toggleMobileDropdownNavigation = () => {
        // Check if Dropdown is currently closed
        if (navMobileDropdownContainer.style.maxHeight === '0px' || 
            navMobileDropdownContainer.style.maxHeight === '') 
        {
            // Expand the mobile category drop down menu
            // TODO
            // This needs to be a calculated height based on the height of the menu
            navContainer.style.maxHeight = '300vh'; 
            navMobileDropdownContainer.style.maxHeight = navMobileDropdownMenuMaxHeight * 3 + 'px';
            // Set Button Styles
            document.getElementsByClassName('nav-button')[2].style.backgroundColor = '#334a58';
            document.getElementById('nav-resources').style.borderTop = '2px solid #FFFFFF';
        }
        else {
            // Close the mobile dropdown category menu
            navMobileDropdownContainer.style.maxHeight = '0px';
            // Set Button Styles
            document.getElementsByClassName('nav-button')[2].style.backgroundColor = '#233039';
            // Wait to hide nav button border until mobile category dropdown menu is closed
            setTimeout(() => {
                document.getElementById('nav-resources').style.borderTop = 'none';
            }, 500);
        }
    };

    // Trigger the mobile cateogry dropdown menu to either display or hide
    document.getElementById('nav-mobile-dropdown-categories')
        .addEventListener('click', toggleMobileDropdownNavigation);

    // TODO: mouse over event for Search By Category button to give hover color

    // Go the Users Build Page
    document.getElementById('nav-my-build').addEventListener('click', () => {
        document.location.href = 'builds';
    });

    // Go to the Featured Builds Page
    document.getElementById('nav-search-builds').addEventListener('click', () => {
        document.location.href = 'builds';
    });

    /* Dropdown Menu */
    const dropdownContainer = document.getElementById('dropdown-container');
    const dropdownMenu = document.getElementById('dropdown-menu');

    function toggleDropdownMenu() {
        // Check if Dropdown is currently closed
        if (dropdownContainer.style.maxHeight === '0px' || 
            dropdownContainer.style.maxHeight === '') 
        {
            // get the height of the dropdown menu
            const dropdownMenuMaxHeight = parseInt(dropdownMenu.scrollHeight);
            // Expand the category drop down menu
            navContainer.style.maxHeight = '100vh';
            dropdownContainer.style.maxHeight = dropdownMenuMaxHeight * 4 + 'px';
            // Set Button Styles
            document.getElementById('nav-search-categories').style.backgroundColor = '#334a58';
            // Change arrow direction to point up
            document.getElementById('nav-button-expand-more').style.display = 'none';
            document.getElementById('nav-button-expand-less').style.display = 'block';
        }
        else {
            // Close the dropdown category menu
            dropdownContainer.style.maxHeight = '0px';
            // Set Button Styles
            // Wait to change button styles until dropdown menu is closed
            setTimeout(() => {
                document.getElementById('nav-search-categories').style.backgroundColor = '#233039';
                // Change arrow direction to point down
                document.getElementById('nav-button-expand-more').style.display = 'block';
                document.getElementById('nav-button-expand-less').style.display = 'none';
            }, 500);

        }
    };

    // Trigger to open or close the category dropdown menu
    document.getElementById('nav-search-categories').addEventListener('click', () => {
        toggleDropdownMenu();
    });

    // Go to the resources page
    document.getElementById('nav-resources').addEventListener('click', () => {
        document.location.href = 'resources';
    });

});