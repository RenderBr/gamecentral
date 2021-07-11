<?php
session_start();
$key = $_GET['inv'];

if(isset($_SESSION['username'])){
	header("Location: /");
}else{
	session_destroy();
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php');

			if(!$key){
				header("Location: /woah");
			}else{

				$sql = "SELECT * from regTokens WHERE token = '$key' AND used = 0";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				// output data of each row

				}else{
					header("Location: /woah");
				}

			}




		?>
		<meta name="description" content="GameCentral registration page, you may sign up to use our website here.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc register">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - register for an account!"; ?></title>
		<meta name="title" content="GameCentral - register for an account!">
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body style='background: url(/images/generate.png)'>
	<?php include_once('modules/navbar.php'); ?>

		<br>
		<div class='bg-dark1 container pb-3 mb-4 rounded' style="max-width: 27rem;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);"><div class='text-center'>
		<h4 style='padding-top: 18.5px;'>Register for an account!</h4></div>
		<form action='/func/registerUser.php' method='POST'>
		<label for='email'><p class="sm-text">EMAIL</p></label>
		<div class="input-group input-group-md sm"><input id='email' name="email" type="text" class="dark-box form-control" placeholder="john.doe@gmail.com..." aria-label="Enter your email..." aria-describedby="button-submit" /></div>
		<label for='username'><p class="sm-text">USERNAME</p></label>
		<div class="input-group input-group-md sm"><input id='username' name="username" type="text" class="dark-box form-control" placeholder="johndoe12..." aria-label="Enter your username..." aria-describedby="button-submit" /></div>
		<label for='password'><p class="sm-text">PASSWORD</p></label>
		<div class="input-group input-group-md sm"><input id='password' name="password" type="password" class="dark-box form-control" placeholder="ILuvJaneDoe06022002..." aria-label="Enter your password..." aria-describedby="button-submit" /></div>
		<label for='dob'><p class="sm-text">DATE OF BIRTH</p></label>
		<div class="row">
			<div class="col">
				<select class="form-select dark-box" id='dob' name='month' aria-label="Month selector">
					<option selected>Month</option>
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</div>
			<div class="col">
			<select class="form-select dark-box" id='dob' name='day' aria-label="Day selector">
				<option selected>Day</option>
				<option value="1">01</option>
				<option value="2">02</option>
				<option value="3">03</option>
				<option value="4">04</option>
				<option value="5">05</option>
				<option value="6">06</option>
				<option value="7">07</option>
				<option value="8">08</option>
				<option value="9">09</option>
				<option value="10">10</option>
				<option value="1">11</option>
				<option value="2">12</option>
				<option value="3">13</option>
				<option value="4">14</option>
				<option value="5">15</option>
				<option value="6">16</option>
				<option value="7">17</option>
				<option value="8">18</option>
				<option value="9">19</option>
				<option value="10">20</option>
				<option value="1">21</option>
				<option value="2">22</option>
				<option value="3">23</option>
				<option value="4">24</option>
				<option value="5">25</option>
				<option value="6">26</option>
				<option value="7">27</option>
				<option value="8">28</option>
				<option value="9">29</option>
				<option value="10">30</option>
				<option value="10">31</option>
			</select>
		</div>
		<div class="col">
			<select class="form-select dark-box" id='dob' name='year' aria-label="Year selector">
				<option selected>Year</option>
				<option value="1910">1910</option>
				<option value="1911">1911</option>
				<option value="1912">1912</option>
				<option value="1913">1913</option>
				<option value="1914">1914</option>
				<option value="1915">1915</option>
				<option value="1916">1916</option>
				<option value="1917">1917</option>
				<option value="1918">1918</option>
				<option value="1919">1919</option>
				<option value="1920">1920</option>
				<option value="1921">1921</option>
				<option value="1922">1922</option>
				<option value="1923">1923</option>
				<option value="1924">1924</option>
				<option value="1925">1925</option>
				<option value="1926">1926</option>
				<option value="1927">1927</option>
				<option value="1928">1928</option>
				<option value="1929">1929</option>
				<option value="1930">1930</option>
				<option value="1931">1931</option>
				<option value="1932">1932</option>
				<option value="1933">1933</option>
				<option value="1934">1934</option>
				<option value="1935">1935</option>
				<option value="1936">1936</option>
				<option value="1937">1937</option>
				<option value="1938">1938</option>
				<option value="1939">1939</option>
				<option value="1940">1940</option>
				<option value="1941">1941</option>
				<option value="1942">1942</option>
				<option value="1943">1943</option>
				<option value="1944">1944</option>
				<option value="1945">1945</option>
				<option value="1946">1946</option>
				<option value="1947">1947</option>
				<option value="1948">1948</option>
				<option value="1949">1949</option>
				<option value="1950">1950</option>
				<option value="1951">1951</option>
				<option value="1952">1952</option>
				<option value="1953">1953</option>
				<option value="1954">1954</option>
				<option value="1955">1955</option>
				<option value="1956">1956</option>
				<option value="1957">1957</option>
				<option value="1958">1958</option>
				<option value="1959">1959</option>
				<option value="1960">1960</option>
				<option value="1961">1961</option>
				<option value="1962">1962</option>
				<option value="1963">1963</option>
				<option value="1964">1964</option>
				<option value="1965">1965</option>
				<option value="1966">1966</option>
				<option value="1967">1967</option>
				<option value="1968">1968</option>
				<option value="1969">1969</option>
				<option value="1970">1970</option>
				<option value="1971">1971</option>
				<option value="1972">1972</option>
				<option value="1973">1973</option>
				<option value="1974">1974</option>
				<option value="1975">1975</option>
				<option value="1976">1976</option>
				<option value="1977">1977</option>
				<option value="1978">1978</option>
				<option value="1979">1979</option>
				<option value="1980">1980</option>
				<option value="1981">1981</option>
				<option value="1982">1982</option>
				<option value="1983">1983</option>
				<option value="1984">1984</option>
				<option value="1985">1985</option>
				<option value="1986">1986</option>
				<option value="1987">1987</option>
				<option value="1988">1988</option>
				<option value="1989">1989</option>
				<option value="1990">1990</option>
				<option value="1991">1991</option>
				<option value="1992">1992</option>
				<option value="1993">1993</option>
				<option value="1994">1994</option>
				<option value="1995">1995</option>
				<option value="1996">1996</option>
				<option value="1997">1997</option>
				<option value="1998">1998</option>
				<option value="1999">1999</option>
				<option value="2000">2000</option>
				<option value="2001">2001</option>
				<option value="2002">2002</option>
				<option value="2003">2003</option>
				<option value="2004">2004</option>
				<option value="2005">2005</option>
				<option value="2006">2006</option>
				<option value="2007">2007</option>
				<option value="2008">2008</option>
				<option value="2009">2009</option>
				<option value="2010">2010</option>
				<option value="2011">2011</option>
				<option value="2012">2012</option>
				<option value="2013">2013</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				<option value="2021">2021</option>
				<option value="2022">2022</option>
		</select>
		</div>
		</div><br>
		<div class='text-center'>
		<input name='regToken' value='<?php echo $key; ?>' style='display:none;'>
		<button class="btn btn-primary" style='width:100%;' id="button-submit" type="submit">Continue</button>
		</div>
		</form>
		<a style='text-decoration:none;color: #0d6efd;' href='/login'><p style='font-size: 12px;'>Already have an account?</p></a>
		<p style='font-size:12px;' class='sm-text'>By registering, you agree to our Terms of Service and Privacy Policy.</p>
		</div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
<?php
$conn->close();
?>
