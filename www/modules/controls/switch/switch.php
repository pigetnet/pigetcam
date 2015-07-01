<?php
$check_property = true;
if (!isset($control->name)) {
    echo "<code>ERR name not defined</code>";
    $check_property = false;
}

if (!isset($control->state)) {
    echo "<code>ERR state not defined</code>";
    $check_property = false;
}

if ($check_property) {
    exec("pgrep -fl $control->state", $pids[$control->state]);
    array_pop($pids[$control->state]);

    if (empty($pids[$control->state])) {
        $processes[$control->name] = false;
    } else {
        $processes[$control->name] = true;
    }
?>
<tr>
    <td><?php echo $control->name ?></td>
        <td>    
            <input data-id="<?php echo $key ?>" 
                        id="<?php echo $key."_controls" ?>"
                        class="switches" 
                        type="checkbox" 
                        <? if ($processes[$control->name]){ echo "checked";}?>>
        </td>
</tr>
<?php
}
?>
