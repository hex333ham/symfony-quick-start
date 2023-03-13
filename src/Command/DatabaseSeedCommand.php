<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'database:seed',
    description: 'Seeds the database with a test user; test: p@ssword.',
)]
class DatabaseSeedCommand extends Command
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // seed the test user
        $teachUsr = new User();
        $teachUsr->setUsername('test');
        // hash the password (based on the security.yaml config for the $user class)
        $teachPass = 'p@ssword';
        $hashedPassword = $this->passwordHasher->hashPassword(
            $teachUsr,
            $teachPass
        );
        $teachUsr->setPassword($hashedPassword);
        // persist the user
        $this->em->persist($teachUsr);
        $this->em->flush();

        $io->success('Successfully seeded database with user; test: p@ssword');

        return Command::SUCCESS;
    }
}
