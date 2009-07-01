			<!--
				COLUMN LEFT
			-->
			<div id="left">
				<div class="blueBox">
					<?php
					// If a user is logged, we show him his account
					if(isLogged()){
					?>
						<span class="head">Mon compte&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?page=home&amp;disconnect=1" title="Déconnectez-vous !"><img src="views/images/icones/lock.png" alt="" /></a></span>
						<div>
							<p class="sousTitre">
								Mes images
							</p>
							<p>
								<a href="userFolder.html"><img src="views/images/folderImages.png" alt="" /></a>
							</p>
							<p class="sousTitre">
								Configuration
							</p>
							<p>
								<a href="configurationAccount.html"><img src="views/images/configuration.png" alt="" /></a><br />
							</p>
						</div>
					<?php
					}
					// Else, the connection form
					else{
					?>
						<span class="head">Connexion</span>
						<div>
							<form action="home.html" method="post">
								<p><input type="text" name="loginConnection" onfocus="this.value='';" onblur="if(this.value==''){this.value='Login';}" id="loginConnection" value="Login" /></p>
								<p><input type="password" id="passwordConnection" name="passwordConnection" onfocus="this.value='';" onblur="if(this.value==''){this.value='123456';}" value="123456" /></p>
								<p><input class="button"  type="submit" value="Connexion" /></p>
							</form>
							<span class="help"><a href="passwordLost.html">Password oublié?</a></span>
						</div>
					<?php
					}
					?>
				</div><br /><br />
				<div class="greenBox">
					<span>Partenaires</span>
					<div>
						<?php include_once('views/includes/partners.html'); ?>
					</div>
				</div>
			</div>