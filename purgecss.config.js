const purgecssWordpress = require('purgecss-with-wordpress');

module.exports = {
  content: [
    './**/*.php',
    './**/*.js',
    './**/*.html',
  ],
  css: [
    './css/bootstrap.min.css',
  ],
  safelist: [
    ...purgecssWordpress.safelist,
    
    // Modais
    'modal', 'fade', 'show', 'modal-backdrop', 'modal-open', 'modal-dialog-centered',
    'modal-header', 'modal-body', 'modal-footer', 'modal-content',
    
    // Collapse (Acordeões e Menus)
    'collapse', 'collapsing', 'show',
    
    // Dropdown
    'dropdown', 'dropdown-menu', 'dropdown-item', 'dropdown-toggle',
    'dropdown-divider', 'dropdown-header', 'dropup', 'dropright', 'dropleft',

    // Tooltips e Popovers
    'tooltip', 'bs-tooltip-top', 'bs-tooltip-bottom', 'bs-tooltip-start', 'bs-tooltip-end',
    'popover', 'bs-popover-top', 'bs-popover-bottom', 'bs-popover-start', 'bs-popover-end',

    // Carrossel
    'carousel', 'slide', 'carousel-item', 'carousel-inner', 'carousel-indicators', 'active',

    // Navbar
    'navbar', 'navbar-collapse', 'collapsing', 'show', 'nav-item', 'nav-link', 'nav-pills',
    
    // Alerts
    'alert', 'fade', 'show',

    // Botões
    'btn', 'btn-primary', 'btn-secondary', 'btn-success', 'btn-danger', 'btn-warning',
    'btn-info', 'btn-light', 'btn-dark', 'btn-link', 'disabled',

    // Spinners
    'spinner-border', 'spinner-grow',

    // Tabs
    'nav', 'nav-tabs', 'nav-pills', 'tab-pane', 'active', 'fade', 'show',

    // Progress
    'progress', 'progress-bar', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger',

    // Formulários
    'form-control', 'is-valid', 'is-invalid', 'was-validated',
    
    // Grids e Flexbox
    'row', 'col', 'g-0', 'd-flex', 'justify-content-center', 'align-items-center',
  ],
};
