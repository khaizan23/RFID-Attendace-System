<?php
date_default_timezone_set("Asia/Manila");
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}


$dir = "uploads/";
$image_extensions = array("png", "jpg", "jpeg", "gif");
$dates = array();
$files = array();
$temp_length = 6;

if (is_dir($dir)) {
  foreach (scandir($dir) as $d_key => $d) {
    if ($d_key > 1) {
      $date = explode(".", $d)[0];
      array_push($dates, $date);
      array_push($files, $d);
    }
  }
}

uasort($files, "comp");

function comp($a, $b)
{
  if ((int)explode(".", $a)[0] == (int)explode(".", $b)[0]) return 0;
  return ((int)explode(".", $a)[0] < (int)explode(".", $b)[0]) ? 1 : -1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css">
  <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/userslog.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous">
    </script>  
  <script src="https://cdn.tailwindcss.com"></script>
  <script type="text/javascript" src="js/bootbox.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    
  <title>ESP32-CAM Photo Gallery</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900;1000&display=swap');
  </style>
  <?php include("tailwindcss.php") ?>
</head>

<body class="font-nunito bg-gray-200">
  <div class="relative">
    <header>
    <?php include'header.php'; ?> 
    </header>
    <h4 class="text-4xl text-gray-300 font-bold p-6">CURRENT CAPTURED</h4>

    <div class="px-6 grid grid-cols-2 gap-10 auto-rows-auto">
      <div>

        <div class="relative h-[28rem] w-[50rem] rounded-[2rem] shadow-2xl overflow-hidden grid place-items-center">
          <?php if (sizeof(scandir($dir)) > 2) : ?>
            <img src="<?php echo $dir . $files[count($files) - 1] ?>" alt="" loading="lazy" class="h-full w-full object-cover">
          <?php else : ?>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-64 h-64 stroke-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
          <?php endif ?>
        </div>
      </div>
      <div class="flex flex-col">
        <?php for ($i = 0; $i < $temp_length; $i++) : ?>
          <div class="grid grid-cols-2 py-6">
            <!-- <p class="text-md text-gray-400">None</p>
            <p class="text-md">None</p> -->
          </div>
        <?php endfor ?>
      </div>
    </div>
    <h4 class="text-4xl text-gray-300 font-semibold m-6">PREVIOUS CAPTURED</h4>
    <div class="h-auto gap-8 mb-4 mx-6 flex flex-wrap">
      <?php foreach ($files as $file) : ?>
        <div class="relative h-[18rem] w-64 rounded-[2rem] shadow-2xl overflow-hidden">
          <img src="<?php echo $dir . $file ?>" alt="" loading="lazy" class="h-full w-full object-cover">
        </div>
      <?php endforeach ?>
    </div>
  </div>

</body>

</html>