<?php

namespace App\Command;

use App\Repository\BeerRepository;
use Elastica\Document;
use Generated\Model\Beer;
use Jane\AutoMapper\AutoMapperInterface;
use JoliCode\Elastically\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IndexCommand extends Command
{
    const BEERS_INDEX = 'beers';

    private $elasticallyClient;
    private $beerRepository;
    private $autoMapper;

    public function __construct(Client $elasticallyClient, BeerRepository $beerRepository, AutoMapperInterface $autoMapper)
    {
        parent::__construct(null);
        $this->elasticallyClient = $elasticallyClient;
        $this->beerRepository = $beerRepository;
        $this->autoMapper = $autoMapper;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:index')
            ->setDescription('Index entities in Elasticsearch');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $indexBuilder = $this->elasticallyClient->getIndexBuilder();
        $index = $indexBuilder->createIndex(self::BEERS_INDEX);
        $indexBuilder->markAsLive($index, self::BEERS_INDEX);

        $indexer = $this->elasticallyClient->getIndexer();

        $beers = $this->beerRepository->findAll();
        foreach ($beers as $beer) {
            $document = new Document($beer->getId(), $this->autoMapper->map($beer, Beer::class));
            $indexer->scheduleIndex(self::BEERS_INDEX, $document);
        }
        $indexer->flush();
        $indexer->refresh(self::BEERS_INDEX);

        $io->success(sprintf('%d beers indexed.', \count($beers)));

        return 0;
    }
}
