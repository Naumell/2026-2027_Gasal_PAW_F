<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="processData_form.php" method="POST">
  <div class="field">
    <label for="surname">Surname</label>
    <input type="text" id="surname" name="surname" size="31"/>
  </div>
  <div class="field">
    <label for="email">Email address</label>
    <input type="text" id="email" name="email" size="31"/>
  </div>
  <div class="field">
    <label for="passwd">Password</label>
    <input type="password" id="passwd" name="passwd" size="31"/>
  </div>
  <div class="field">
    <label for="address">Street Address</label>
    <textarea id="address" name="address" rows="3" cols="22"></textarea>
  </div>
  <div class="field">
    <label for="state">State</label>
    <select name="state" id="state">
      <option value="-1" selected>[choose your state]</option>
      <option value="1">Jawa Timur</option>
      <option value="2">Jawa Tengah</option>
      <option value="3">Jawa Barat</option>
      <option value="4">DKI Jakarta</option>
      <option value="5">DI Yogyakarta</option>
      <option value="6">Banten</option>
      <option value="7">Bali</option>
      <option value="8">Sumatera Utara</option>
    </select>
  </div>
  <div class="field">
    <input type="hidden" name="country" value="Indonesia"/>
  </div>
  <div class="field">
    <label for="sex">Gender</label>
    <input type="radio" id="male" name="sex" value="male"/>Male
    <input type="radio" id="female" name="sex" value="female"/>Female
  </div>
  <div class="field">
    <label for="vegetarian">Vegetarian?</label>
    <input type="checkbox" id="vegetarian" name="vegetarian"/>
  </div>
  <div class="field">
    <label>&nbsp;</label>
    <input type="submit" value="Submit" name="submit"/><input type="reset" value="Reset" name="reset"/>
  </div>
</form>
</fieldset>
