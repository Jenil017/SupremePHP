<?php
$page_title = 'Password Hash Generator';
include 'header.php';

$password_to_hash = '';
$hashed_password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password_to_hash = $_POST['password'] ?? '';
    if (!empty($password_to_hash)) {
        // Generate a secure hash using the default algorithm (currently bcrypt)
        $hashed_password = password_hash($password_to_hash, PASSWORD_DEFAULT);
    }
}
?>

<h2 style="margin-top: 0; margin-bottom: 1.5rem;">Generate a Secure Password Hash</h2>

<p>Use this tool to create a secure password hash for your admin accounts. Copy the generated hash and paste it directly into the `password` column of the `admin` table in your database.</p>

<form action="" method="POST">
    <div class="form-group">
        <label for="password">Enter Password:</label>
        <input type="text" id="password" name="password" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.5rem;">
    </div>
    <button type="submit" class="submit-btn">Generate Hash</button>
</form>

<?php if ($hashed_password): ?>
<div style="margin-top: 2rem;">
    <h3>Generated Hash:</h3>
    <pre style="background-color: #f1f5f9; padding: 1rem; border-radius: 0.5rem; word-wrap: break-word;"><code><?= htmlspecialchars($hashed_password) ?></code></pre>
    <p><strong>Password hashed:</strong> <?= htmlspecialchars($password_to_hash) ?></p>
</div>
<?php endif; ?>

<style>
.submit-btn {
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    background-color: var(--primary);
    color: #fff;
}
</style>

<?php include 'footer.php'; ?>
