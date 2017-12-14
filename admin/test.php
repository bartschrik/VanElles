<?php
include_once('includes/header.php');
?>

<input id="datetime">

</body>
<script src="../js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script>
    $("#datetime").datetimepicker({
        step: 30
    });
</script>
</html>