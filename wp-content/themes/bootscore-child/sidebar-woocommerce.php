<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<aside id="secondary" class="widget-area">
    
    <div id="sidebar-panel" class="sidebar-panel">
        <button class="btn btn-dark btn-icon btn-sidebar-control" id="close-sidebar-panel" onclick="document.getElementById('sidebar-panel').style.display='none'">
            <i class="fas fa-times"></i>
        </button>
        <?php if (is_active_sidebar('sidebar-woocommerce')) : ?>
            <?php dynamic_sidebar('sidebar-woocommerce'); ?>
        <?php endif; ?>
    </div>
</aside>