<?php

declare(strict_types=1);

namespace App\Command;

use App\Enum\Source;
use App\Message\GetWeather as Message;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'app:get-weather')]
class GetWeather extends Command
{
    protected static $defaultDescription = 'Fetches weather data from source';

    public function __construct(private MessageBusInterface $bus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('source', InputArgument::REQUIRED, 'weather source.')
            ->addArgument('city', InputArgument::REQUIRED, 'weather city.')
            ->addArgument('dates', InputArgument::REQUIRED, 'weather dates.');
        $this->setHelp('This command allows you to fetch weather from source...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(new Message(
            Source::tryFrom($input->getArgument('source')),
            $input->getArgument('city'),
            $input->getArgument('dates'),
        ));

        $output->writeln('All done!');
        return Command::SUCCESS;
    }
}
