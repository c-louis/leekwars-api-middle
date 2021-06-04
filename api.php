<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-type: application/json");

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    switch($type) {
        case "fightLeek":
            if (!isset($_GET['leek_id'])) {
                echo ('{"error": "must provide leek_id"}');
                return;
            }
            if (!isset($_GET['target_id'])) {
                echo ('{"error": "must provide target_id"}');
                return;
            }
            if (!isset($_GET['token'])) {
                echo ('{"error": "must provide token"}');
                return;
            }
            $leek_id = $_GET['leek_id'];
            $target_id = $_GET['target_id'];
            $token = $_GET['token'];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://leekwars.com/api/garden/get-leek-opponents/" . $leek_id);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Cookie: PHPSESSID=8abfd8eeef9b98ddd87abcdef',
                'Authorization: Bearer ' . $token,
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $chdata = curl_exec($ch);
            $jdata = json_decode($chdata);
            $opponents = $jdata->opponents;
            curl_close($ch);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://leekwars.com/api/garden/start-solo-fight/" . $leek_id . "/" . $target_id);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Cookie: PHPSESSID=8abfd8eeef9b98ddd87abcdef',
                'Authorization: Bearer ' . $token,
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $chdata = curl_exec($ch);
            $jdata = json_decode($chdata);
            curl_close($ch);
            echo $chdata;
            break;
        case 'fightFarmer';
            if (!isset($_GET['target_id'])) {
                echo ('{"error": "must provide target_id"}');
                return;
            }
            if (!isset($_GET['token'])) {
                echo ('{"error": "must provide token"}');
                return;
            }
            $target_id = $_GET['target_id'];
            $token = $_GET['token'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://leekwars.com/api/garden/get-farmer-opponents");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Cookie: PHPSESSID=8abfd8eeef9b98ddd87abcdef',
                'Authorization: Bearer ' . $token,
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $chdata = curl_exec($ch);
            $jdata = json_decode($chdata);
            $opponents = $jdata->opponents;
            curl_close($ch);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://leekwars.com/api/garden/start-farmer-fight/" . $target_id);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Cookie: PHPSESSID=8abfd8eeef9b98ddd87abcdef',
                'Authorization: Bearer ' . $token,
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $chdata = curl_exec($ch);
            $jdata = json_decode($chdata);
            curl_close($ch);
            echo $chdata;
            break;
        default:
            echo '{"error": "Unknown request"}';
    }
} else {
    echo "This api don't have a lot of endpoint be careful when using it";
}

?>