<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emails = array('tes1@mail.com', 'tes2@mail.com', 'tes3@mail.com', 'tes4@mail.com', 'tes5@mail.com', 'tes6@mail.com');
        $blogs = array('blog1.com', 'blog2.com', 'blog3.com', 'blog4.com', 'blog5.com', 'blog6.com');
        $names = array('Ariana', 'Bendy', 'Charlie', 'Debby', 'Farouq', 'Evelyn');
        $comments = array('Hello', 'Its me!', 'I was wondering', 'if after all these years', 'you would like to meet', 'Best regards, Loki');
        $comment_replies = array('Hi', 'Wonderful!', 'Great to hear that', '', '', '');

        for ($i=0; $i < sizeof($emails); $i++) {
            DB::table('comments')->insert([
                'post_id' => 1,
                'email' => $emails[$i],
                'blog' => $blogs[$i],
                'full_name' => $names[$i],
                'comment' => $comments[$i],
                'comment_reply' => $comment_replies[$i],
                'created_by' => ($i < 1) ? $i+1 : $i,
            ]);
        }
    }
}
