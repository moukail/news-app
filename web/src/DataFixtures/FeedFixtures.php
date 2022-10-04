<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Feed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Website;

class FeedFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $feed = new Feed();
        $feed->setName('Nu Algemeen nieuws');
        $feed->setType('RSS');
        $feed->setLanguage('nl');
        $feed->setLink('https://www.nu.nl/rss/Algemeen');

        $manager->persist($feed);

        $feed = new Feed();
        $feed->setName('Nu Economie');
        $feed->setType('RSS');
        $feed->setLanguage('nl');
        $feed->setLink('https://www.nu.nl/rss/Economie');

        $manager->persist($feed);

        $feed = new Feed();
        $feed->setName('Nu Sport');
        $feed->setType('RSS');
        $feed->setLanguage('nl');
        $feed->setLink('https://www.nu.nl/rss/Sport');

        $manager->persist($feed);

        $feed = new Feed();
        $feed->setName('NOS Nieuws Algemeen');
        $feed->setType('RSS');
        $feed->setLanguage('nl');
        $feed->setLink('https://feeds.nos.nl/nosnieuwsalgemeen');

        $manager->persist($feed);

        $manager->flush();
    }
}
