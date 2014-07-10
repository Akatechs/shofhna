<?php

/*

 */

/**
 * Description of CommunitiesTableSeeder
 *
 * @author Hichem MHAMED
 */
class CommunitiesTableSeeder extends Seeder {

    public function run() 
    {
        $creatorUser = User::whereUsername('hichem')->first();
        
        $communitiesArray = array(
            array(
                'name' => 'تطوير الويب',
                'slug' => "webdev",
                'description' => 'مجتمع خاص بمناقشة وطرح المواضيع والقضايا العامة المتعلقة بتطوير الويب ولغاتها المختلفة',
                'creator_id'=>$creatorUser->id
                
            ),
            array(
                'name' => 'برمجة عامة',
                'slug' => "programming",
                'description' => 'بإمكانك طرح المواضيع والنقاشات المتعلقة بالبرمجة بشكل عام او لغات البرمجة التي لايوجد لها مجتمعات فرعية.',
                'creator_id'=>$creatorUser->id
            ),
            array(
                'name' => 'التصميم وقابلية الاستخدام',
                'slug' => "design",
                'description' => 'بإمكانك طرح المواضيع والنقاشات المتعلقة بالبرمجة بشكل عام او لغات البرمجة التي لايوجد لها مجتمعات فرعية.',
                'creator_id'=>$creatorUser->id
            )
        );
        foreach ($communitiesArray as $entry) {
            Community::create($entry);
        }
    }

}

?>
