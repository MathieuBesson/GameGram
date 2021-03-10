<div class="starter-template text-center mt-5 px-3">
	<h1 class="mb-3"><?= 'Derniers actualités de ' . $_member->pseudo . ' !' ?></h1>
	<p class="text-center"><?= $html->button('+ Nouveau Post', ['dir' => 'posts', 'page' => 'create'], ['color' => SUCCESS]); ?></p>
</div>

<div class="row justify-content-center mt-5">
	<div class="col col-sm-8">

		<?php foreach ($_member->loadPostsAndComments() as $content) {
			if (get_class($content) === 'Post') {
				$post = $content;
				include('./views/Elements/post_seul.php');
			}
			if (get_class($content) === 'Comment') {
				$comment = $content;
				include('./views/Elements/comment_seul.php');
			}
		} ?>
	</div>
</div>
