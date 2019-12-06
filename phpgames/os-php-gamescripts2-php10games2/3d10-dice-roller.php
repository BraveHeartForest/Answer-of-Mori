<?php

/*
 * 3d10-die-roller.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

/* A really basic function to simulate rolling a simple die with N sides */

function roll($sides) {
    if($sides<1 || gettype($sides)!="integer"){
        return false;
    }else{
        return mt_rand(1,$sides);
    }
}

/* Next we put in a sloppy bit of form to allow you to pick the number of sides, and roll away */

?>
<form method="post">
<label for="number">？面ダイス :</label>
<input type="number" name="sides" id="number" value="<?php echo @$_POST['sides'] ?>"/> <br>
結果 : <?php echo roll((int) @$_POST['sides'])  ?> 
<br>
<input type="submit" value="ダイスロール" />
</form>
<pre>
Result : &lt;?php echo roll((int) @$_POST['sides'])  ?&gt;
</pre>
<p>では自作関数rollの内容物に(int)を事前に付けることで型変換を行っている。</p>
<p>@$_POSTでエラー時には表示されないように設定する。</p>
<p>input:numberに変更しましたが、何が起こるかは分からないので、このままです。</p>