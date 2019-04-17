<div class='body-center-left'>
				
	<div class="body-posts">
		<?php 
		// Condition : assign the value of a modificattion or creation of title to the variable title
		if(isset($_GET['title_new'])){
			$title = $_GET['title_new'];
		} else {
			$title = $_GET['title_modif'];
		}
				
		// Title		
		$mess_titre = stripslashes($title);
		$mess_titre = preg_replace('#\[i\]#','<i>', $mess_titre);
		$mess_titre = preg_replace('#\[\/i\]#','</i>', $mess_titre);
		$mess_titre = preg_replace('#\[s\]#','<u>', $mess_titre);
		$mess_titre = preg_replace('#\[\/s\]#','</u>', $mess_titre);
		$mess_titre = preg_replace('#\[strike\]#','<strike>', $mess_titre);
		$mess_titre = preg_replace('#\[\/strike\]#','</strike>', $mess_titre);
		$mess_titre = preg_replace('#&lt;#','<', $mess_titre);
		mess_titre = preg_replace('#&quot;#','"', $mess_titre);
		$mess_titre = preg_replace('#&gt;#','>', $mess_titre);
		echo "<div class='body-title'>
		<p>". $mess_titre ."</p>
		</div>";
		?>
					
		<!-- The date of creation and modification -->
		<div class='date-post'>
			<p>Created the
			<?php echo date('d/m/Y ', time()); ?> at
			<?php echo date('H\hi', time());  ?></p>
		</div>
					
		<?php
		// Condition : assign the value of a modificattion or creation of corpus to the variable corpus
		if(isset($_GET['corpus_new'])){
			$corpus = $_GET['corpus_new'];
		} else {
			$corpus = $_GET['corpus_modif'];//base64_encode($_GET['corpus_modif']);
		}
		
		// 	Corpus of the post	
		$mess = nl2br($corpus);
		echo "<div class='body-post-corpus'>". htmlspecialchars_decode($mess)."</div>";
		?>
	</div>			
</div>

				
																																																			