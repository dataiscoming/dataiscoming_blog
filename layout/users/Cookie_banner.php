<?php // Banner that will be shaow only if  the cookie bottom banner exists to inform about cookies
	if(!isset($_COOKIE['bottom_banner'])){
		echo('
		<div id="js-cookie-box" class="cookie-box cookie-box--hide">
			<div id="leftbox-banner">
				<p id="footer-banner">Hello,<br>
				Data is coming does not collect any data from you. We juste get the visits number. Presently, there is not any profil of you registered from our side.<br>
				There are no tiers-cookie used.<br>
				Your rights are <a href="https://eur-lex.europa.eu/legal-content/EN/TXT/HTML/?uri=CELEX:32016R0679&from=FR">here</a>! <br>
				Have a good reading.
				</p>
			</div>
			<div id="rightbox-banner">
				<img id="js-cookie-button" class="cookie-button" onclick="fade_banner()" src="../pictures/iconfinder_close_476323.svg" width="50" height="50">
			</div>
		</div>');
	}
?>