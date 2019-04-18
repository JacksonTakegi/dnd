<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $guarded = ['roll'];

    public static function getMonsterData($monsterName)
    {
        /*
         * The way this DND api works is it gives you a list of monster
         * names and a url for each of them, like this:
         *
         *  {
         *        "name": "Aboleth",
         *        "url": "http://www.dnd5eapi.co/api/monsters/1"
         *    },
         *
         * We need to search through
         * the initial response to find the right URL, then send a
         * request to that URL in order to get more detailed data.
         *
         * For example, check out http://www.dnd5eapi.co/api/monsters
         * then click on the URL on any of those returned monsters, and
         * you can see the full monster data. This is what we're going
         * to tell the code to do.
         *
         * This is a relatively slow process, since we have to access an
         * external website twice in order to get the info we want.
         * In the future we should download the entire database, since
         * its open source. That'll let us do database queries on it
         * to return things instantly.
         */

        // Prepare the link to the API (http://www.dnd5eapi.co/api/monsters)
        $client = new Client();
        $apiUrl = "http://dnd5eapi.co/api/";
        $monsterEndpoint = "monsters/";

        // Send a web request to the link and save the response
        $res = $client->get($apiUrl . $monsterEndpoint);
        $list = json_decode($res->getBody()); // json_decode converts the string to an object that we can loop through

        // Loop through every monster in the list, and look for the one we're requesting
        // Break out of the loop when we find it and continue to the next chunk of code
        foreach ($list->results as $monsterToSearch) {
            if ($monsterToSearch->name == $monsterName) {
                // Save the URL attribute
                $monsterURL = $monsterToSearch->url;
                break;
            }
        }

        // If the monster wasn't found, just return false. If it was found, send another
        // request to the API
        if (isset($monsterURL)) {
            // Use the URL attribute from earlier to get more info
            $res = $client->get($monsterURL);
            $finalMonster = json_decode($res->getBody(), true);

            // Return all the data
            return $finalMonster;
        } else {
            return false;
        }
    }
}
