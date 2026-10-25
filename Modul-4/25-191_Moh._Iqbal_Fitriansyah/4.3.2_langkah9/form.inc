<?php
// fungsi bantu: ambil nilai lama dari $_POST dan amankan dari XSS
function old($key)
{
    return isset($_POST[$key]) ? htmlspecialchars($_POST[$key], ENT_QUOTES) : '';
}
$states = array('1' => 'Jawa Timur', '2' => 'Jawa Tengah', '3' => 'Jawa Barat',
                '4' => 'DKI Jakarta', '5' => 'DI Yogyakarta', '6' => 'Banten',
                '7' => 'Bali', '8' => 'Sumatera Utara');
$selState = isset($_POST['state']) ? (string)$_POST['state'] : '-1';
?>
<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="processData_form.php" method="POST">
  <div class="field">
    <label for="surname">Surname</label>
    <input type="text" id="surname" name="surname" size="31" value="<?php echo old('surname'); ?>"/>
  </div>
  <div class="field">
    <label for="email">Email address</label>
    <input type="text" id="email" name="email" size="31" value="<?php echo old('email'); ?>"/>
  </div>
  <div class="field">
    <label for="passwd">Password</label>
    <input type="password" id="passwd" name="passwd" size="31"/> <!-- password sengaja tidak diisi ulang -->
  </div>
  <div class="field">
    <label for="address">Street Address</label>
    <textarea id="address" name="address" rows="3" cols="22"><?php echo old('address'); ?></textarea>
  </div>
  <div class="field">
    <label for="state">State</label>
    <select name="state" id="state">
      <option value="-1" <?php if ($selState === '-1') echo 'selected'; ?>>[choose your state]</option>
      <?php foreach ($states as $val => $name): ?>
      <option value="<?php echo $val; ?>" <?php if ($selState === (string)$val) echo 'selected'; ?>><?php echo $name; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="field">
    <input type="hidden" name="country" value="Indonesia"/>
  </div>
  <div class="field">
    <label for="sex">Gender</label>
    <input type="radio" id="male" name="sex" value="male" <?php if (($_POST['sex'] ?? '') === 'male') echo 'checked'; ?>/>Male
    <input type="radio" id="female" name="sex" value="female" <?php if (($_POST['sex'] ?? '') === 'female') echo 'checked'; ?>/>Female
  </div>
  <div class="field">
    <label for="vegetarian">Vegetarian?</label>
    <input type="checkbox" id="vegetarian" name="vegetarian" <?php if (isset($_POST['vegetarian'])) echo 'checked'; ?>/>
  </div>
  <div class="field">
    <label>&nbsp;</label>
    <input type="submit" value="Submit" name="submit"/><input type="reset" value="Reset" name="reset"/>
  </div>
</form>
</fieldset>
