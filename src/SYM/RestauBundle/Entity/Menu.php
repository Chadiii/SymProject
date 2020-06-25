<?php

namespace SYM\RestauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="SYM\RestauBundle\Repository\MenuRepository")
 */
class Menu
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
     * @ORM\Column(name="nom_menu", type="string", length=255)
     */
    private $nomMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="description_menu", type="text")
     */
    private $descriptionMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="image_menu", type="string", length=255)
     */
    private $imageMenu;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_menu", type="float")
     */
    private $prixMenu;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomMenu
     *
     * @param string $nomMenu
     *
     * @return Menu
     */
    public function setNomMenu($nomMenu)
    {
        $this->nomMenu = $nomMenu;

        return $this;
    }

    /**
     * Get nomMenu
     *
     * @return string
     */
    public function getNomMenu()
    {
        return $this->nomMenu;
    }

    /**
     * Set descriptionMenu
     *
     * @param string $descriptionMenu
     *
     * @return Menu
     */
    public function setDescriptionMenu($descriptionMenu)
    {
        $this->descriptionMenu = $descriptionMenu;

        return $this;
    }

    /**
     * Get descriptionMenu
     *
     * @return string
     */
    public function getDescriptionMenu()
    {
        return $this->descriptionMenu;
    }

    /**
     * Set imageMenu
     *
     * @param string $imageMenu
     *
     * @return Menu
     */
    public function setImageMenu($imageMenu)
    {
        $this->imageMenu = $imageMenu;

        return $this;
    }

    /**
     * Get imageMenu
     *
     * @return string
     */
    public function getImageMenu()
    {
        return $this->imageMenu;
    }

    /**
     * Set prixMenu
     *
     * @param float $prixMenu
     *
     * @return Menu
     */
    public function setPrixMenu($prixMenu)
    {
        $this->prixMenu = $prixMenu;

        return $this;
    }

    /**
     * Get prixMenu
     *
     * @return float
     */
    public function getPrixMenu()
    {
        return $this->prixMenu;
    }
}

