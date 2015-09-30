<?php
$check_property = true;
if (!isset($control->name)) {
    echo "<code>ERR name not defined in $control->file.json</code>";
    $check_property = false;
}

if (!isset($control->state) && !isset($control->process)) {
    echo "<code>ERR state / process not defined</code>";
    $check_property = false;
}

if ($check_property) {
    if (isset($control->process)) {
        exec("pgrep -fl $control->process", $pids[$control->process]);
        array_pop($pids[$control->process]);

        if (empty($pids[$control->process])) {
            $processes[$control->file] = false;
        } else {
            $processes[$control->file] = true;
        }
    }

    if (isset($control->state)) {
        if (file_exists("/user/state/$control->state/state")) {
            $file_tmp = file_get_contents("/user/state/$control->state/state");
            $file_tmp = trim($file_tmp);
            $processes[$control->file] = $file_tmp;
            unset($file_tmp);
        }
        if (file_exists("/user/state/$control->state/description")) {
            $file_tmp = file_get_contents("/user/state/$control->state/description");
            $control->description = $file_tmp;
            unset($file_tmp);
        }
    }

?>
    <tr>
        <td>
            <?php
            echo $control->name;
            if (isset($control->description)) { echo "<code>$control->description</code>"; }
            ?>
        </td>
        <td>    
            <input data-id="<?php echo $key ?>" 
            id="<?php echo $key."_controls" ?>"
            class="switches" 
            type="checkbox" 
            <? if ($processes[$control->file]){ echo "checked";}?>>
        </td>
    </tr>
    <?php
}
?>
