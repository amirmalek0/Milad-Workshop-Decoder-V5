<?php
if (isset($_POST['decode'])) {
    $code = $_POST['encoded'];
    $version = '5.0';
    $file_text = $code;
    $rand = rand(10000, 100000);
    $temp_file = 'fetch-'.$rand.'.txt';
    file_put_contents($temp_file, $file_text);
    if (strpos($code, $version) !== false) {

        $fetch_file = file_get_contents($temp_file);
        function UpdateFile()
        {
            global $temp_file, $fetch_file;
            $fetch_file = file_get_contents($temp_file);
        }

        function B64Decode()
        {
            global $fetch_file, $temp_file;
            $Base64_decode = base64_decode($fetch_file);
            file_put_contents($temp_file, $Base64_decode);
        }

        function CleanFile($start, $offset)
        {
            global $fetch_file, $temp_file;
            $clean = substr($fetch_file, $start, $offset);
            file_put_contents($temp_file, $clean);
        }

        function RemoveExtraCodes($RegexPattern)
        {
            global $fetch_file, $temp_file;
            $replace = preg_replace($RegexPattern, '', $fetch_file);
            file_put_contents($temp_file, $replace);
        }

        function Output()
        {
            global $fetch_file, $temp_file;
            $output = gzinflate(base64_decode($fetch_file));
            file_put_contents($temp_file, $output);

        }

        function Step1()
        {
            global $fetch_file, $temp_file;
            if (preg_match('/[\s\S]*?(?=\(")/', $fetch_file)) {
                RemoveExtraCodes('/[\s\S]*?(?=\(")/');
                UpdateFile();
                CleanFile(2, -8);
                B64Decode();
                UpdateFile();
            }
        }

        function step2()
        {
            RemoveExtraCodes('/[\s\S]*?(?=\(")/');
            UpdateFile();
            CleanFile(2, -5);
            B64Decode();
            UpdateFile();
        }

        function step3()
        {
            RemoveExtraCodes('/[\s\S]*?(?=\(")/');
            UpdateFile();
            CleanFile(2, -7);
            B64Decode();
            UpdateFile();
        }

        function step4()
        {
            RemoveExtraCodes('/[\s\S]*?(?=eval)/');
            UpdateFile();
            RemoveExtraCodes('/[\s\S]*?(?=\(")/');
            UpdateFile();
            CleanFile(2, -8);
            B64Decode();
            UpdateFile();
            RemoveExtraCodes('/[\s\S]*?(?=eval)/');
            UpdateFile();
            RemoveExtraCodes('/[\s\S]*?(?=\(")/');
            UpdateFile();
            CleanFile(2, -7);
            B64Decode();
            UpdateFile();
        }

        function step5()
        {
            RemoveExtraCodes('/[\s\S]*?(?=eval)/');
            UpdateFile();
            RemoveExtraCodes('/[\s\S]*?(?=\(")/');
            UpdateFile();
            CleanFile(2, -5);
            UpdateFile();
            Output();
        }

        Step1();
        Step2();
        step3();
        step4();
        step5();


    } else {
        file_put_contents($temp_file, 'The code is either invalid or corrupted');
    }

}
?>
<html>
<!--
 _       _                  _                                 _    _
( )  _  ( )                ( )                               ( )  ( )
| | ( ) | |   _    _ __   _| | _ _    _ __   __    ___   ___ `\`\/'/'
| | | | | | /'_`\ ( '__)/'_` |( '_`\ ( '__)/'__`\/',__)/',__)  >  <
| (_/ \_) |( (_) )| |  ( (_| || (_) )| |  (  ___/\__, \\__, \ /'/\`\
`\___x___/'`\___/'(_)  `\__,_)| ,__/'(_)  `\____)(____/(____/(_)  (_)
                              | |
                              (_)


PHP Decoder BY @WordPressX Telegram Channel
-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="assets/favicon.ico"/>
    <meta name="description"
          content="PHP DECODER for MiladWorkShop Encoder Version 5 - Decode PHP Files which are encoded by MiladWorkShop Encoder V5 "/>
    <title>MiladWorkShop Decoder V5</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h1>MiladWorkshop Decoder</h1>
<h3>Version 5.0</h3>
<form action="" method="POST">
    <textarea name="encoded" id="encoded" rows="30" placeholder='Paste Your Code here ...'><?php if (isset($code)) {
            echo $code;
        } ?></textarea>
    <button type="submit" name="decode" class="dcd_btn">Decode</button>
    <?php
    if (isset($temp_file)) {
        echo '<textarea rows="30">' . htmlspecialchars(file_get_contents($temp_file)) . '</textarea>';
        unlink($temp_file);
    }
    ?>
</form>
</body>
</html>
