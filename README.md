# Basic CRSF Validation
You can use a token to validate requests. Use the following CRSF class like this:
```php
$csrf = new CSRF();

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    if (!$csrf->verifyRequest()) {
        die('Invalid CSRF token');
    }

    echo "Valid CSRF token: " . $name;
}
?>

<form method="POST">
    <?= $csrf->addToken(); ?>
    <input type="text" name="name" id="">
    <button type="submit" name="submit">Submit</button>
</form>
```
