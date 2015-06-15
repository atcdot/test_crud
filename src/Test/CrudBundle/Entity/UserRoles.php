<?php

namespace Test\CrudBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * UserRoles
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserRoles implements RoleInterface
{

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="userRoles")
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="userId", type="integer")
//     */
//    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="roleName", type="string", length=50)
     */
    private $roleName;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

//    /**
//     * Set userId
//     *
//     * @param integer $userId
//     * @return UserRoles
//     */
//    public function setUserId($userId)
//    {
//        $this->userId = $userId;
//
//        return $this;
//    }
//
//    /**
//     * Get userId
//     *
//     * @return integer
//     */
//    public function getUserId()
//    {
//        return $this->userId;
//    }

    /**
     * Set roleName
     *
     * @param string $roleName
     * @return UserRoles
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Реализация метода, требуемого интерфейсом RoleInterface.
     *
     * @return string The role.
     */

    public function getRole(){
        return $this->getRoleName();
    }

    /**
     * Add users
     *
     * @param \Test\CrudBundle\Entity\User $users
     * @return UserRoles
     */
    public function addUser(User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Test\CrudBundle\Entity\User $users
     */
    public function removeUser(User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
