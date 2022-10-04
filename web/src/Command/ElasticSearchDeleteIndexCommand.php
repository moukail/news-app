<?php

namespace App\Command;

use App\Service\ElasticsearchClientFactory;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:elastic-search-delete-index',
    description: 'Add a short description for your command',
)]
class ElasticSearchDeleteIndexCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $client = ElasticsearchClientFactory::create();

        $params = [
            'index' => $_ENV['ELASTIC_SEARCH_INDEX'],
        ];

        try{
            $client->indices()->delete($params);
        }catch (ClientResponseException $exception) {
            $error = $exception->getResponse()->getBody();
            $error = json_decode($error, true);
            $io->error($error['error']['reason']);
            return 0;
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
