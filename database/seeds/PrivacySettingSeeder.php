<?php

use Illuminate\Database\Seeder;

class PrivacySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privacy_settings')->insert([
            'id' => 0,
            'name' => 'Only God',
            'description' => 'This prayer will be submitted up to God and then removed from the SocialPrayer.',
        ]);
        DB::table('privacy_settings')->insert([
            'id' => 1,
            'name' => 'Only Me and God',
            'description' => 'Only you and God will be allowed to view this prayer after submitting it',
        ]);
        DB::table('privacy_settings')->insert([
            'id' => 2,
            'name' => 'God, Me and My Friends',
            'description' => 'You, God and anyone who is a member of prayer groups you have joined will be able to see this prayer.',
        ]);
        DB::table('privacy_settings')->insert([
            'id' => 3,
            'name' => 'Everyone',
            'description' => 'Everyone on SocialPrayer will be able to see this prayer as well as who did the praying (you).',
        ]);
        DB::table('privacy_settings')->insert([
            'id' => 4,
            'name' => 'Everyone (Anonymous)',
            'description' => 'Everyone on SocialPrayer will be able to see this prayer but the prayer will be labeled as anonymous.',
        ]);
    }
}
