<?php

namespace Generated\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class BeerNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Generated\\Model\\Beer';
    }
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Generated\Model\Beer;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Generated\Model\Beer();
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (\array_key_exists('brewer', $data)) {
            $object->setBrewer($data['brewer']);
        }
        if (\array_key_exists('style', $data)) {
            $object->setStyle($data['style']);
        }
        if (\array_key_exists('volume', $data)) {
            $object->setVolume($data['volume']);
        }
        if (\array_key_exists('alcohol', $data)) {
            $object->setAlcohol($data['alcohol']);
        }
        if (\array_key_exists('country', $data)) {
            $object->setCountry($data['country']);
        }
        if (\array_key_exists('color', $data)) {
            $object->setColor($data['color']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getBrewer()) {
            $data['brewer'] = $object->getBrewer();
        }
        if (null !== $object->getStyle()) {
            $data['style'] = $object->getStyle();
        }
        if (null !== $object->getVolume()) {
            $data['volume'] = $object->getVolume();
        }
        if (null !== $object->getAlcohol()) {
            $data['alcohol'] = $object->getAlcohol();
        }
        if (null !== $object->getCountry()) {
            $data['country'] = $object->getCountry();
        }
        if (null !== $object->getColor()) {
            $data['color'] = $object->getColor();
        }
        return $data;
    }
}