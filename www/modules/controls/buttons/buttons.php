<?php
$check_property = true;
if (!isset($control->name)) {
    echo "<code>ERR name not defined</code>";
    $check_property = false;
}

if (!isset($control->buttons["0"])) {
    echo "<code>ERR buttons not defined</code>";
    $check_property = false;
}



?>
<tr>
    <td><?php echo $control->name ?></td>
        <td> 
        <?php
        foreach ($control->buttons as $button_key => $button) {
        ?>
            <button 
                          class="btn btn-lg btn-<?php echo $button->color ?>"
                          data-id="<?php echo $key ?>" 
                          data-command="<?php echo $button->action ?>"
                          onclick="buttonsClicked(this)">
                          <span class="<?php echo $button->icon ?>"></span>
            </button>
        <?php
        }
        ?>
        </td> 
</tr>
      
