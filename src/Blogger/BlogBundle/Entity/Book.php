<?php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Repository\BookRepository")
 */
class Book
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
//    /**
//     * @var string
//     *
//     * @ORM|Column(name="image", type="string", length=500)
//     */
//    private $image;
    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="ISBN", type="string", length=255)
     */
    private $iSBN;
    /**
     * @var \Blogger\BlogBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Blogger\BlogBundle\Entity\User",inversedBy="books")
     * @ORM\JoinColumn(name="bookowner", referencedColumnName="id")
     */
    private $bookowner;



//    /**
//     * Set image
//     *
//     * @param string $image
//     *
//     * @return Book
//     */
//    public function setImage($image)
//    {
//        $this->image = $image;
//
//        return $this;
//    }
//
//    /**
//     * Get image
//     *
//     * @return string
//     */
//    public function getImage()
//    {
//        return $this->image;
//    }
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
     * Set title.
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author.
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set summary.
     *
     * @param string $summary
     *
     * @return Book
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary.
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set iSBN.
     *
     * @param string $iSBN
     *
     * @return Book
     */
    public function setISBN($iSBN)
    {
        $this->iSBN = $iSBN;

        return $this;
    }

    /**
     * Get iSBN.
     *
     * @return string
     */
    public function getISBN()
    {
        return $this->iSBN;
    }

    /**
     * Set bookowner.
     *
     * @param \Blogger\BlogBundle\Entity\User|null $bookowner
     *
     * @return Book
     */
    public function setBookowner(\Blogger\BlogBundle\Entity\User $bookowner = null)
    {
        $this->bookowner = $bookowner;

        return $this;
    }

    /**
     * Get bookowner.
     *
     * @return \Blogger\BlogBundle\Entity\User|null
     */
    public function getBookowner()
    {
        return $this->bookowner;
    }
}