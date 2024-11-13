<?php
require_once 'functions.php';
$ipAddress = getIp();
$ipLocation = ipLocate($ipAddress); // On essaie toujours de localiser l'IP, peu importe si elle est locale ou publique

// Si l'IP est 127.0.0.1, on la remplace par une IP publique (par exemple 77.127.176.67)
if ($ipAddress === '127.0.0.1') {
    $ipAddress = '77.127.176.67';  // Remplacer par l'IP publique que tu souhaites
}

$ipLocation = ipLocate($ipAddress);

// La localisation a réussi, récupère la latitude et la longitude
if (is_array($ipLocation)) {
    $latitude = $ipLocation['latitude'];
    $longitude = $ipLocation['longitude'];
    $errorMessage = null;
} else {
    // La localisation a échoué, on retourne un message d'erreur
    $latitude = null;
    $longitude = null;
    $errorMessage = "Erreur lors de la localisation de l'adresse IP : $ipAddress";
}
?>

<!DOCTYPE html>
<html>
  
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

<div class="bg-white">
  <div class="relative isolate overflow-hidden bg-gradient-to-b from-indigo-100/20">
    <div class="mx-auto max-w-7xl pb-24 pt-10 sm:pb-32 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-8 lg:py-40">
      <div class="px-6 lg:px-0 lg:pt-4">
        <div class="mx-auto max-w-2xl">
          <div class="max-w-lg">

            <h1 class="mt-10 text-pretty text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Votre IP : <?php echo $ipAddress; ?></h1>
            <p class="mt-6 text-lg text-gray-500">Votre localisation est : <?php echo $latitude; ?>, <?php echo $longitude; ?></p>
            <p class="mt-6 text-lg text-gray-500">Message d'erreur : <?php echo $errorMessage; ?></p>
            <div class="mt-10 flex items-center gap-x-6">

              <a href="#index.php" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Recharger</a>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-20 sm:mt-24 md:mx-auto md:max-w-2xl lg:mx-0 lg:mt-0 lg:w-screen">
        <div class="absolute inset-y-0 right-1/2 -z-10 -mr-10 w-[200%] skew-x-[-30deg] bg-white shadow-xl shadow-indigo-600/10 ring-1 ring-indigo-50 md:-mr-20 lg:-mr-36" aria-hidden="true"></div>
        <div class="shadow-lg md:rounded-3xl">
          <div class="bg-indigo-500 [clip-path:inset(0)] md:[clip-path:inset(0_round_theme(borderRadius.3xl))]">
            <div class="absolute -inset-y-px left-1/2 -z-10 ml-10 w-[200%] skew-x-[-30deg] bg-indigo-100 opacity-20 ring-1 ring-inset ring-white md:ml-20 lg:ml-36" aria-hidden="true"></div>
            <div class="relative px-6 pt-8 sm:pt-16 md:pl-16 md:pr-0">
              <div class="mx-auto max-w-2xl md:mx-0 md:max-w-none">
                <div class="w-screen overflow-hidden rounded-tl-xl bg-gray-900">
                  <div class="flex bg-gray-800/40 ring-1 ring-white/5">
                    <div class="-mb-px flex text-sm/6 font-medium text-gray-400">
                      <div class="border-b border-r border-b-white/20 border-r-white/10 bg-white/5 px-4 py-2 text-white">NotificationSetting.jsx</div>
                      <div class="border-r border-gray-600/10 px-4 py-2">App.jsx</div>
                    </div>
                  </div>
                  <div class="px-6 pb-14 pt-6">
                    <!-- Your code example -->
                  </div>
                </div>
              </div>
              <div class="pointer-events-none absolute inset-0 ring-1 ring-inset ring-black/10 md:rounded-3xl" aria-hidden="true"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="absolute inset-x-0 bottom-0 -z-10 h-24 bg-gradient-to-t from-white sm:h-32"></div>
  </div>
</div>

