<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\Document
 */
class Game
{
    /**
     * @MongoDB\Id  
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Editor", inversedBy="games")
     */
    protected $editor;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Developer", inversedBy="games")
     */
    protected $developer;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Platform", mappedBy="plateforms")
     */
    protected $platforms;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Type", mappedBy="types")
     */
    protected $types;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $release_date;


    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->platforms = new ArrayCollection();
    }

    public function addType(Type $type)
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }
    }

    public function removeType(Genre $type)
    {
        if ($this->types->contains($type)) {
            $this->types->removeElement($type);
        }
    }

    public function geTypes()
    {
        return $this->types;
    }

    public function addPlatform(Platform $platform)
    {
        if (!$this->platforms->contains($platform)) {
            $this->platforms->add($platform);
        }
    }

    public function removePlatform(Platform $platform)
    {
        if ($this->platforms->contains($platform)) {
            $this->platforms->removeElement($platform);
        }
    }

    public function gePlatforms()
    {
        return $this->platforms;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEditor($editor): void
    {
        $this->editor = $editor;
    }

    public function getEditor()
    {
        return $this->editor;
    }

    public function setDeveloper($developer): void
    {
        $this->developer = $developer;
    }

    public function getDeveloper()
    {
        return $this->developer;
    }
}