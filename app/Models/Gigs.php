<?php
namespace App\Models;

class Gigs {
    public static function all() {
        return [
            [
                'id' => 1,
                'title' => 'Gig One',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                 Fugiat facere sit, perferendis ullam corrupti nostrum reiciendis ipsum ducimus dicta porro placeat,
                                 impedit eos molestias amet quod provident atque commodi odio?'
            ],
            [
                'id' => 2,
                'title' => 'Gig Two',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                 Fugiat facere sit, perferendis ullam corrupti nostrum reiciendis ipsum ducimus dicta porro placeat,
                                 impedit eos molestias amet quod provident atque commodi odio?'
            ]
            ];
    }

    public static function find($id) {
        $gigs = self::all();

        foreach($gigs as $gig) {
            if($gig['id'] == $id) {
                return $gig;
            }
        }
    }
}