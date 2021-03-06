<?php

namespace Test\TwitterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tweets.
 *
 * @ORM\Table(name="tweets")
 * @ORM\Entity(repositoryClass="Test\TwitterBundle\Repository\TweetsRepository")
 */
class Tweets
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
     * @ORM\Column(name="id_twitter", type="bigint")
     */
    private $idTwitter;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="TwitterUser", inversedBy="tweets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * @return Tweets
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
     * Set text.
     *
     * @param string $text
     *
     * @return Tweets
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set user.
     *
     * @param \Test\TwitterBundle\Entity\TwitterUser $user
     *
     * @return Tweets
     */
    public function setUser(\Test\TwitterBundle\Entity\TwitterUser $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Test\TwitterBundle\Entity\TwitterUser
     */
    public function getUser()
    {
        return $this->user;
    }
}
