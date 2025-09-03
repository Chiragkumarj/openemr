<?php
use OpenEMR\Core\Header;
Header::setupHeader();
?>

<script>
    alert(" Reminder: <?php echo htmlspecialchars($name); ?> is over 50. Consider preventive screening.");
</script>
