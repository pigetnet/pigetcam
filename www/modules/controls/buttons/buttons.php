<?php
$check_property = true;

// Check property in json files

if (!isset($control->name)) {
    echo "<code>ERR name not defined</code>";
    $check_property = false;
}

//Check if there are a buttons array

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
      

<?
/*
Example:

$control->name : Name displayed
$control->type : Type of controls (-> buttons)
$control->"action id" : Command to execute
for $control->buttons 
  $button->color (bootstrap color)
  $button->action (action id)
  $button->icon (bootstrap glyphicon)


{
  "name": "Raspberry Pi Controls",
  "type": "buttons",
  "buttons": [
    {
    "icon": "glyphicon glyphicon-repeat",
    "color": "warning",
    "action": "reboot"
    },
    {
    "icon": "glyphicon glyphicon-off",
    "color": "danger",
    "action": "halt"
    }
  ],
   "reboot":"/sbin/reboot",
  "halt":"/sbin/halt"
}
*/
?>