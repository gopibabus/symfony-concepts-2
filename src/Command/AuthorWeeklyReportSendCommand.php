<?php

namespace App\Command;

use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class AuthorWeeklyReportSendCommand extends Command
{
    protected static $defaultName = 'app:author-weekly-report:send';
    private $userRepository;
    private $articleRepository;
    private $mailer;

    public function __construct(
        UserRepository $userRepository,
        ArticleRepository $articleRepository,
        MailerInterface $mailer
    )
    {
        parent::__construct(null);
        $this->userRepository = $userRepository;
        $this->articleRepository = $articleRepository;
        $this->mailer = $mailer;
    }

    protected function configure()
    {
        $this->setDescription('Send Weekly Reports to Authors');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $authors = $this->userRepository->findAllSubscribedToNewsLetter();
        $io->progressStart(count($authors));
        foreach ($authors as $author){
            $io->progressAdvance();
            $articles = $this->articleRepository->findAll();
            if(count($articles) === 0){
                continue;
            }

            $email = (new TemplatedEmail())
                ->from(new Address('s.gopibabu@gmail.com', 'Gopibabu'))
                ->to(new Address($author->getEmail(), 'Wonderful User'))
                ->subject('Your weekly Report on Spacebar')
                ->htmlTemplate('email/author-weekly-report.html.twig')
                ->context([
                    'author' =>$author,
                    'articles' => $articles
                ]);
            $this->mailer->send($email);
        }
        $io->progressFinish();
        $io->success('Weekly Reports were sent to authors');
    }
}