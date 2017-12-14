<?php
include_once('includes/header.php');
include_once('../includes/footer.php');
?>

<input id="datetime">
<script>
    $("#datetime").datetimepicker({
        step: 30
    });
</script>