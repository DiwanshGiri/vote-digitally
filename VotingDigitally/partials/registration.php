<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Voting System</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="registration.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <h4 class="center-align">Register</h4>
      <form action="../actions/register.php" method="POST" enctype="multipart/form-data">
        
      <div class="input-field">
          <input id="username" type="text" name="username" class="validate" required>
          <label for="username">Username</label>
        </div>
        
        <div class="input-field">
          <input id="mobile_number" type="text" name="mobile" class="validate" required maxlength="10" minlength="10">
          <label for="mobile_number">Mobile Number</label>
        </div>
        
        <div class="input-field">
          <input id="password" type="password" name="password" class="validate" required>
          <label for="password">Password</label>
        </div>
        
        <div class="input-field">
          <input id="image" type="file" name="photo" class="validate">
        </div>
        
        <div class="input-field">
          <select id="userType" name="std" required>
            <option value="" disabled selected>Choose your option</option>
            <option value="voter">Voter</option>
            <option value="group">Group</option>
          </select>
        </div>
        
        <div class="center-align">
            <p>Already have an account? <a href="../">Login Now</a></p>
            <button class="btn waves-effect waves-light" type="submit" name="action">Register</button>
        </div>
      
    </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
