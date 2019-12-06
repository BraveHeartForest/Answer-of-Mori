<?php
/**
 * /app/View/Hello/index.ctp
 */
?>
<form action="/mori_folder/Answer-of-mori/cake/hello/export" method="POST">
    <div class="input text">
        <label for="txtTitle">テキスト</label>
        <input type="text" name="txt" id="txtTitle" />
    </div>
    <div class="submit">
        <input type="submit" value="Send" />
    </div>
</form>