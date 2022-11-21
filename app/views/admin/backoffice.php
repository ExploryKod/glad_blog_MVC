<?php ?>
<h1>Espace d'administration</h1>

<form action="/deleteUser" method="post">
    <input type="text" name="username">
    <input type="number" name="userId">
    <button type="submit" name="delete">Delete this user</button>
</form>

<?php if($message) {
    echo "<div class='container'>
            <p class='purple'>{$message}</p>
        </div>";

} ?>