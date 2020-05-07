# Jane with Elasticsearch using a Symfony application

Here is a demo Symfony application of Jane with Elasticsearch integration.

This README is a quick *Getting started* guide about this application.

## Requirements

To make this application works you need:
- [docker](https://docs.docker.com/engine/install/)
- python >= 3.6
- [pipenv](https://pipenv.pypa.io/en/latest/install/#installing-pipenv)

## Bash environment

We are using pipenv to avoid installing libraries on your local machine.
To run your bash env you have to install it first: `pipenv install`.
Then you can use it either by doing `pipenv run {command}` or `pipenv shell` 
(first command will only run a given command while second will prompt you in a new shell).

## Start docker

To have all needed services (postgres, elasticsearch or kibana), we use docker. 
To make it start you can use `inv start` command.

Then you will need to have the demo app domain to your `/etc/hosts` as following:
```
127.0.0.1 elasticsearch-jane.test kibana.elasticsearch-jane.test
```

## Running the application

Now you need to install dependencies, setup database and index data in Elasticsearch.
To do all this you have to run:

```bash
inv install # install dependencies (composer only for this app)
inv migrate fixtures # setup database and load fixtures
inv index # load data in elasticsearch
```

Now you can see all our data from Elasticsearch on https://elasticsearch-jane.test/beers 🎉

## And how Jane and Elasticsearch works together ?

First, we need to index entities into Elasticsearch, to do that I made a command you can find in 
`project/src/Command/IndexCommand.php`. Here is the same code, decomposed to explain each steps: 

```php
// Here, $client is an instance of JoliCode\Elastically\Client, we use this library on top of Elastica to create 
// indexes, send documents, send requests and read results.
// With that `getIndexBuilder` method, we get a class to build indexes.
$indexBuilder = $client->getIndexBuilder();
// We create an index called "beers" (with date suffix)
$index = $indexBuilder->createIndex(self::BEERS_INDEX);
// We update the "beers" alias with this new index
$indexBuilder->markAsLive($index, self::BEERS_INDEX);

// Class to index our documents
$indexer = $client->getIndexer();

// We fetch all beers from database
$beers = $this->beerRepository->findAll();
foreach ($beers as $beer) {
    // For each entity, we convert it to a Generated\Model\Beer DTO
    $model = $this->autoMapper->map($beer, \Generated\Model\Beer::class);
    // We put it in a Document in order to index it
    $document = new \Elastica\Document($beer->getId(), $model);
    // And we schedule the Document to "beers" index
    $indexer->scheduleIndex(self::BEERS_INDEX, $document);
}

// Flush all schedule documents & refresh "beers" index
$indexer->flush();
$indexer->refresh(self::BEERS_INDEX);
```

Then you can see in `project/src/Controller/BeerController.php` file some interaction to show Elasticsearch results.
Same as before, decomposed code to explan each steps:

```php
// With the `getIndex` method, we get a reference of the index we want (here I'm asking for 'beers' index)
$index = $client->getIndex(self::BEERS_INDEX);
// And we make a search query on the index (no arguments means we search for any result)
$resultSet = $index->search();
// We get the results for given $resultSet
$results = $resultSet->getResults();

$output = ['beers' => []];
foreach ($results as $result) {
    // Then we get the model for each result
    // Here, thanks to Elastically and the Symfony serializer, the `getModel` 
    // method will return a Generated\Model\Beer instance
    $output['beers'][] = $result->getModel();
}

return $this->json($output);
```
