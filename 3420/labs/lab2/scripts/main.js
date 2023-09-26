"use strict";

/// ================================================================================================
/// This file handles the mobile navigation in the main layout.
/// ================================================================================================

(function () {
  const navButton = document.querySelector("#mobile-nav-trigger");
  const navElement = document.querySelector("#main-nav");

  if (navButton && navElement) {
    /**
     * Toggles the [data-opened] property so CSS can show the nav.
     */
    const onClick = () => {
      if (!navElement.dataset.opened || navElement.dataset.opened == "false") {
        navElement.dataset.opened = "true";
      } else {
        navElement.dataset.opened = "false";
      }
    };

    /**
     * Completely disables/enables this nav functionality when the window size changes.
     */
    const onChange = () => {
      // If it just changed to mobile, activate the button and set the nav to 'closed'
      if (query.matches) {
        navElement.dataset.opened = "false";
        navButton.addEventListener("click", onClick);
      }
      // If it just changed to desktop, delete the 'opened' state and deactivate the button
      else {
        delete navElement.dataset.opened;
        navButton.removeEventListener("click", onClick);
      }
    };

    // -------------

    // Make *sure* this matches the media query for `.mobile-only` and `.mobile-hide` in
    // layout-main.css
    const query = window.matchMedia("(max-width: 820px)");
    query.addEventListener("change", onChange);
    onChange();
  }
})();
