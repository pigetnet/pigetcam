<?php
$controls = new JsonSettings;

$settings = $controls->settings;

if ($settings) {
?>

<!-- CAMERA CONTROLS -->
<div class="container">
<div class="panel panel-primary">
    <div class="panel-heading">Controls</div>
    <table class="table  table-condensed table-bordered">
        <?php
        foreach ($settings as $key => $control) {

            if (isset($control->type)) {
                include("modules/controls/$control->type/$control->type.php");
            } else {
                echo "<code>ERR $key.json type not defined</code>";
            }
        }
        ?>
    </table>
</div>
</div>

<?php
}
?>