<!-- modules/footer/footer.php -->
<div class="footer">

</div>

<script src="vendor/components/jquery/jquery.min.js"></script>
<script src="vendor/components/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/nostalgiaz/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="node_modules/jquery.fullscreen/release/jquery.fullscreen.min.js"></script>
<script src="modules/notification.js"></script>
<?php
$jsFiles = $variables;
foreach ($jsFiles as $jsFile) {
    echo '<script src="'.$jsFile.'"></script>'."\n";
}
?>

</body>
</html>