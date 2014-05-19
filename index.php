<!DOCTYPE html>
<html lang="en">
<head>
<title>Password Generator</title>
<style type="text/css"><!--input#new_password{font-family:courier}--></style>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">$(function(){$('input[class^="password_"]').each(function(){$(this).attr({width:'auto',size:$(this).val().length})});$('input[class^="password_"]').on({click:function(){$(this).select()},focus:function(){$(this).select()},mouseup:function(e){e.preventDefault()}})})</script>
</head>
<body>
<h2>Password Generator</h2>
<?php
if(isset($_GET['password_length']) && is_numeric($_GET['password_length']) && 4 <= $_GET['password_length'] && $_GET['password_length'] <= 64 && isset($_GET['quantity']) && is_numeric($_GET['quantity']) && 1 <= $_GET['quantity'] && $_GET['quantity'] <= 10)
{
    require_once('class.PW.php');
    $PW = new PW;
    $PW->set_password_length($_GET['password_length']);
    if(isset($_GET['numbers']))
        $PW->set_numbers(true);
    if(isset($_GET['case_insensitive']))
        $PW->set_case_insensitive(true);
    if(isset($_GET['special_chars']))
        $PW->set_special_chars(true);
    $PW->set_quantity($_GET['quantity']);
    $PW->generate();
?><h4>Here <?php echo ($_GET['quantity'] == 1 ? 'is' : 'are'); ?> your new password<?php echo ($_GET['quantity'] == 1 ? '' : 's'); ?>:</h4><?php
    foreach($PW->get_passwords() as $id => $password){
?><p>Password #<?php echo ($id + 1); ?>: <input type="text" class="password_<?php echo $id; ?>" id="new_password" size="50" value="<?php echo $password; ?>"></p><?php
    }
}
?>
<hr>
<form method="get">
<table cellpadding="5">
<tr><td>Password Length</td><td><input type="text" size="4" name="password_length"<?php if(isset($_GET['password_length']) && is_numeric($_GET['password_length']) && 4 <= $_GET['password_length'] && $_GET['password_length'] <= 64){ ?> value="<?php echo $_GET['password_length']; ?>"<?php } ?>> (4 - 64 chars)</td></tr>
<tr><td>Include Letters</td><td><input type="checkbox" name="letters" checked="checked" disabled="disabled"> (required)</td></tr>
<tr><td>Include Mixed Case</td><td><input type="checkbox" name="case_insensitive"<?php if(isset($_GET['case_insensitive']) && $_GET['case_insensitive'] == "on"){ ?> checked="checked"<?php } ?>> (e.g. AbcDEf)</td></tr>
<tr><td>Include Numbers</td><td><input type="checkbox" name="numbers"<?php if(isset($_GET['numbers']) && $_GET['numbers'] == "on"){ ?> checked="checked"<?php } ?>> ( e.g. a9b8c7d)</td></tr>
<tr><td>Include Punctuation</td><td><input type="checkbox" name="special_chars"<?php if(isset($_GET['special_chars']) && $_GET['special_chars'] == "on"){ ?> checked="checked"<?php } ?>> (e.g. a!b*c_d)</td></tr>
<tr><td>Quantity</td><td><select name="quantity"><?php
foreach(range(1,10) as $int){
?><option value="<?php echo $int; ?>"<?php echo (isset($_GET['quantity']) && $_GET['quantity'] == $int ? ' selected="selected"' : ''); ?>><?php echo $int; ?></option><?php
}
?></td></tr>
<tr><td colspan="2"><input type="submit"></td></tr>
</table>
</form>
<hr>
<a href="https://github.com/zzatkin/pw">Source code</a>
</body>
</html>
