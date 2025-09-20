<!DOCTYPE html>
<html>
<head>
<style>
  form.rawemailform {
    border: 1px solid #ccc;
    padding: 40px 20px;
    max-width: 400px;
    border-radius: 8px;
    height: max-content;
    margin: 40px auto;
    overflow: hidden;
}
form.rawemailform .form-group label {
    font-size: 1.2rem;
    font-family: sans-serif;
    font-weight: 600;
}
form.rawemailform .form-group {
    display: flex;
    flex-direction: column;
    gap:10px;
    margin-bottom:20px;
}
form.rawemailform .text-center input {
    text-align: center;
    width: 50%;
    padding: 10px;
    background: bisque;
    border-color: bisque;
    border: 1px solid bisque;
    border-radius: 4px;
    margin: auto;
    display: flex;
}
form.rawemailform .form-group textarea#allemail {
    width: 100% ! IMPORTANT;
    box-sizing: border-box;
    padding: 10px;
    min-height: 200px;
}
input[type="submit"] {
    padding: 10px 36px;
    border-radius: 6px;
    border: none;
}
form {
    text-align: center;
}


</style>
</head>
<body>

<?php 
// echo $_SERVER['SERVER_NAME'];
?>
<form method="post" action="email.php" class="rawemailform">
  <div class="row">
    <div class="col-sm-12 col-12">
      <div class="form-group">
        <label>Raw Email</label>
        <textarea class="form-control" id="allemail" name="allemail" required></textarea>
      </div>
    </div>
  </div>
  <div class="text-center">
    <input type="submit" name="submit" value="Validate">
  </div>
</form>

<br>
<form method="post" action="export_valid_emails.php">
    <input type="submit" value="Export Valid Emails">
</form>

</body>
</html>