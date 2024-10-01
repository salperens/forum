<?php

namespace App\Repository;

use App\Entity\User;
use App\Enum\LoginTypeEnum;
use App\Schema\UserSchema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        protected UserPasswordHasherInterface $passwordHasher,
    )
    {
        parent::__construct($registry, User::class);
    }

    public function getByMail(string $mailAddress): ?User
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $mailAddress)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function isEmailExists(string $mailAddress): bool
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.email = :email')
            ->setParameter('email', $mailAddress)
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }

    public function create(UserSchema $userSchema): User
    {
        $user = new User();

        $userName = $userSchema->getName() . rand(1000, 9999);

        $password = $this->passwordHasher->hashPassword($user, $userSchema->getPassword());

        $user->setEmail($userSchema->getEmail())
            ->setPassword($password)
            ->setName($userSchema->getName())
            ->setSurname($userSchema->getSurname())
            ->setUserName($userName)
            ->setLoginType(LoginTypeEnum::EMAIL);

        $this->getEntityManager()->persist($user);

        $this->getEntityManager()->flush();

        return $user;
    }
}
