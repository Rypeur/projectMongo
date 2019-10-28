<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
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
     * @MongoDB\ReferenceMany(targetDocument="Editor", mappedBy="editor")
     */
    protected $editor;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Developer", mappedBy="developer")
     */
    protected $developer;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Platform", mappedBy="plateform")
     */
    protected $platform;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Type", mappedBy="type")
     */
    protected $type;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $release_date;


}