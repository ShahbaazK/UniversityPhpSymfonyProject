<?php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookReview
 *
 * @ORM\Table(name="book_review")
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Repository\BookReviewRepository")
 */
class BookReview
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

    /**
     * @var string
     *
     * @ORM\Column(name="blog", type="text")
     */
    private $blog;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text")
     */
    private $comments;


    /**
     * Get id.
     *
     * @return int
     */

    /**
     * @var \Blogger\BlogBundle\Entity\BookReview
     * @ORM\ManyToOne(targetEntity="Blogger\BlogBundle\Entity\BookReview",
    inversedBy="entries")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    private $author;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return BookReview
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
     * Set blog.
     *
     * @param string $blog
     *
     * @return BookReview
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * Get blog.
     *
     * @return string
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * Set comments.
     *
     * @param string $comments
     *
     * @return BookReview
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments.
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Blogger\BlogBundle\Entity\BookReview",
    mappedBy="author")
     */
    protected $entries;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add entry.
     *
     * @param \Blogger\BlogBundle\Entity\BookReview $entry
     *
     * @return BookReview
     */
    public function addEntry(\Blogger\BlogBundle\Entity\BookReview $entry)
    {
        $this->entries[] = $entry;

        return $this;
    }

    /**
     * Remove entry.
     *
     * @param \Blogger\BlogBundle\Entity\BookReview $entry
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEntry(\Blogger\BlogBundle\Entity\BookReview $entry)
    {
        return $this->entries->removeElement($entry);
    }

    /**
     * Get entries.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Set author.
     *
     * @param \Blogger\BlogBundle\Entity\BookReview|null $author
     *
     * @return BookReview
     */
    public function setAuthor(\Blogger\BlogBundle\Entity\BookReview $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return \Blogger\BlogBundle\Entity\BookReview|null
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
