<?php

/**
 * Description of PostsTableSeeder
 *
 * @author Hichem MHAMED
 */

use Slug\Slugifier;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
		$userAhmed = User::whereUsername('ahmed')->first();
        $communityDesign = Community::whereSlug('design')->first();
	
		for($i = 51; $i<100;$i++)
		{
			$title = "موضوع رقم ".$i;
			$content = "محتوى الموضوع رقم ".$i;
			$data = array(
				'title' => $title,
				'content' => $content,
				'link' => 'http://www.youtube.com/watch?v=YrWAK4ny0F8',
				'user_id' =>  $userAhmed->id,
				'community_id' => $communityDesign->id
			);
			
			$slugifier = new Slugifier;
			$slug = $slugifier->slugify($data['title']);
			$post =  Post::create(array(
					'title' => $data['title'],
					'slug' => $slug,
					'link' => $data['link'],
					'content'=>$data['content'],
					'user_id' => $data['user_id'],
					'community_id' => $data['community_id']
					
				));

		}
	
        $userHichem = User::whereUsername('hichem')->first();
        $communityWebDev = Community::whereSlug('webdev')->first();

		for($i = 0; $i<50;$i++)
		{
			$title = " موضوع رقم".$i;
			$content = " محتوى الموضوع رقم".$i;
			$data = array(
				'title' => $title,
				'content' => $content,
				'link' => '',
				'user_id' =>  $userHichem->id,
				'community_id' => $communityWebDev->id
			);
			
			$slugifier = new Slugifier;
			$slug = $slugifier->slugify($data['title']);
			$post =  Post::create(array(
					'title' => $data['title'],
					'slug' => $slug,
					'link' => $data['link'],
					'content'=>$data['content'],
					'user_id' => $data['user_id'],
					'community_id' => $data['community_id']
					
				));

		}
        
        
        
    }
}

?>
