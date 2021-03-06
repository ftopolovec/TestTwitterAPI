<?php

namespace Test\TwitterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TwitterUser.
 *
 * @ORM\Table(name="twitter_user")
 * @ORM\Entity(repositoryClass="Test\TwitterBundle\Repository\TwitterUserRepository")
 */
class TwitterUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_twitter", type="bigint")
     */
    private $idTwitter;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity="Tweets", mappedBy="user", cascade={"persist"})
     */
    private $tweets;

    public function __construct()
    {
        $this->tweets = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idTwitter.
     *
     * @param int $idTwitter
     *
     * @return TwitterUser
     */
    public function setIdTwitter($idTwitter)
    {
        $this->idTwitter = $idTwitter;

        return $this;
    }

    /**
     * Get idTwitter.
     *
     * @return int
     */
    public function getIdTwitter()
    {
        return $this->idTwitter;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return TwitterUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Add tweet.
     *
     * @param \Test\TwitterBundle\Entity\Tweets $tweet
     *
     * @return TwitterUser
     */
    public function addTweet(\Test\TwitterBundle\Entity\Tweets $tweet)
    {
        $this->tweets[] = $tweet;

        return $this;
    }

    /**
     * Remove tweet.
     *
     * @param \Test\TwitterBundle\Entity\Tweets $tweet
     */
    public function removeTweet(\Test\TwitterBundle\Entity\Tweets $tweet)
    {
        $this->tweets->removeElement($tweet);
    }

    /**
     * Get tweets.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTweets()
    {
        return $this->tweets;
    }
}
