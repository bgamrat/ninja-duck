<p>Valid login names are <em>principal</em>, <em>guidance</em>, <em>teacher</em>.  Password doesn't matter.</p>
<p>HTML/CSS tested with Firefox 17.0 under CentOS</p><br><br>
<form method="post" action="auth">
<input type="hidden" name="X-xcsrf" value="<?php echo $xcsrf ?>">
<fieldset>
	<legend>Login</legend>
	<label for="username">Username
		<input type="text" id="username" name="username" value="" required>
	</label>
	<label for="password">Password
		<input type="password" id="password" name="password" value="password" required autocomplete="false">
	</label>
	<button type="submit">Login</button>
</fieldset>
</form>
