<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Feed;
use App\Entity\FeedItem;

/**
 * @method Feed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feed[]    findAll()
 * @method Feed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedItem::class);
    }

    public function save(Feed $feed, array $data)
    {
        $feedItem = $this->findBy(['guid' => $data['guid']]);

        if($feedItem){
            return;
        }

        $feedItem = new FeedItem();
        $feedItem
            ->setGuid($data['guid'])
            ->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setLink($data['link'])
            ->setFeed($feed)
            //->setUpdatedAt($item->pubDate)
        ;

        $this->_em->persist($feedItem);
        $this->_em->flush();
    }
}