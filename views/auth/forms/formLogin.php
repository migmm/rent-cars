<label for="username">Username:</label>
<input type="text" id="username" name="username" required>
<br><br>
<label for="password">Password:</label>
<input type="password" id="password" name="password" required>
<br><br>
<input type="checkbox" name="rememberme" value="1" <?php if (isset($_SESSION['rememberme'])) : ?> checked<?php endif; ?>>
<label for="rememberme">Remember me</label>
<br><br>
<button type="submit" name="login">Login</button>