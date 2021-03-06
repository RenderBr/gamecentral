<?php
// If session doesn't exist, create one.
if(session_status() == PHP_SESSION_NONE){
    //session has not started
    session_start();
}
$blacklist = array("dick", "fuck", "shit", "asshole", "penis", "vagina", "nigger", "dickhead", "bitch");

// Check LFG posts and see if expired ones should be dealt with
include_once ($_SERVER['DOCUMENT_ROOT'] . '/func/checkLFG.php');
 ?>

 <!-- meta & link tags for favicon/branding -->
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!-- Bootstrap 5.0.2 min -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2XQERWM7KW"></script>

<!-- Bootstrap 5.0.2 JS bundle min -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- GSAP, GreenSock 3.7.0 min -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.0/gsap.min.js"></script>

<!-- Jquery 3.6.0 min -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Jquery UI 1.12.1 min -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<!-- Definition of hide(element) function, removes the function -->
<script>
  function hide(hideThis){
    $(hideThis).remove();
  }
</script>

<?php
//Definition of time_elapsed_string(timestamp) function, ex. outputs "1 month ago..."
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

//Function to check if user is on mobile device, returns true if
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

//Checks if user is guest or logged in.
if(isset($_SESSION['username'])){
	$loggedUser = $_SESSION['username'];
}else{
	$loggedUser = "Guest";
}
//Gets user IP
$loggedIp = $_SERVER['REMOTE_ADDR'];
//Gets user visited page
$loggedPage = $_SERVER['REQUEST_URI'];
//Global admin password for various things
$adminPassword = "admin420";

//Include conn.php, the mysqldb passthrough
include_once('conn.php');

// Check if is admin, returns true or false. Requires MysqlDB $conn var and user var as $self
function isAdmin($conn, $self){
  $isAdmin = $conn->query("SELECT * from users WHERE username = '$self' AND role > 1");
  if($isAdmin->num_rows > 0 && $isAdmin->num_rows != 12){
    $_SESSION['isAdmin'] = true;
    return true;
  }else{
    $_SESSION['isAdmin'] = false;
    return false;
  }
}

//DELETE EMPTY GROUPS
$conn->query("DELETE FROM lfgPosts where currentUsers = 0");
//DELETE EMPTY COMMUNITIES
$conn->query("DELETE FROM communities where communityMembers = 0");

//Retrieve unseen notifications for logged User
$notifs = $conn->query("SELECT * from notifications WHERE user = '$loggedUser' AND seen = 0");
//Get number of notifications for user, and put it into session variable, so it is globally available.
$_SESSION['notifs'] = $notifs->num_rows;

//Log user action, what page, ip, which user into mysqldb
$conn->query("INSERT INTO views (user, ip, page) VALUES
('$loggedUser', '$loggedIp', '$loggedPage')");

//Echo proper viewport scaling for mobile, pc, all platforms
echo '<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">';

//Echo custom styling, uncached.
echo '
<style>
@font-face{
  font-family: "Dela Gothic One";
  src: url(/css/DelaGothicOne-Regular.ttf);
}

@font-face{
  font-family: "Raleway";
  src: url(/css/Raleway-Light.ttf);
}

.no-border{
  border:none !important;
}
.no-bs{
	box-shadow:none !important;
}
.codebox{
	background: #2C2F33;
	overflow: hidden;
	max-width: 100px;
	border: 1px solid #2C2F33;
}
.nd{
	text-decoration:none !important;
}

.icon-sm{
	width:32px;
	height:32px;
}

.icon-md{
	width:64px;
	height:64px;
}

.img-thumbnail{
	padding: .25rem;
	background-color: #212529 !important;
	border: 1px solid #2f3133 !important;
	border-radius: .25rem;
	max-width: 100%;
	height: auto;
}

.pane{
	max-width:98%;
	height:max-content;
	margin-top:10px;
	padding:15px 0 15px 0px;
	border-radius: 10px;
}

.user{
  padding-bottom:10px !important;
	max-width: 35rem !important;
	height: max-content !important;
	box-shadow: bax !important;
	-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72) !important;
	box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72) !important;
}

.news{
	padding-bottom: 5px !important;
	max-width: 50rem !important;
	height: max-content !important;
	box-shadow: bax !important;
	-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72) !important;
	box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72) !important;
}

.alert-danger{
	background-color:#f04747 !important;
	color: white !important;
	border: 0px !important;
	border-radius: 0px !important;
	text-align:center;
	box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72) !important;
	border-left: 6px solid #823535 !important;
}

.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
}


.gray{
	color:#8b8e93 !important;
	text-decoration:none;
}

.sm{
	margin-bottom: 11.5px;
}

.sm-text{
	font-size:12px;
	color:#8b8e93 !important;
	margin-bottom: 0.25rem;
	text-decoration:none !important;
}
.nav-break{
	margin:0 !important;
	background-color: #34393e !important;
	opacity:1 !important;

}
.bg-dark1{
	background-color:#2f3133 !important;
	color:white;
}
.bg-dark2{
	background-color: #353739 !important;
	color:white;
}
.bg-dark3{
	background-color: #3d3e40 !important;
	color:white;
}
.bg-darkest{
	background-color: #212529 !important;
	color:white;
}
.dark-box{
	outline:none !important;
	box-shadow: none !important;
	background-color: #353739 !important;
	border-color:#2d3033 !important;
	color:white !important;
}
.dark-box:focus{
	outline:0 !important;
	webkit-box-shadow: none !important;
	box-shadow: none !important;
}
.bold {
    font-family: "Dela Gothic One", cursive;
}
.light {
	font-family: "Raleway", sans-serif;
}
.discord{
	color: #7289DA !important;
}
a {
	text-decoration:none !important;
	color:currentColor !important;
}
.nav-link{
	color: #999 !important;
}
.active{
	color: #e1e1e1 !important;
}
</style>

';

//Website name, motto, and URL globally available through CDNS.php
$websitename = "GameCentral";
$websitemotto = "Never play solo again! Find other gamers, instantly.";
$websitedir = "https://gamecentral.online";
?>
