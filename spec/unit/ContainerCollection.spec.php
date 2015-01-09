<?php

use Ayaml\Ayaml;
use Ayaml\ContainerCollection;

describe('\\Ayaml\\ContainerCollection', function() {
    beforeEach(function() {
        Ayaml::registerBasePath(__DIR__ . '/../SampleYaml');
        $container = Ayaml::file('user')->schema('valid_user');
        $this->containerCollection = new ContainerCollection($container);
    });

    context('range', function() {
        context('abnormal case', function() {
            it('should throw with invalid type', function() {
                expect(function() {
                    $this->containerCollection->range('foo', 'string', 'string');
                })->to->throw('\\Ayaml\\AyamlSeqInvalidTypeException');
            });
        });
    });

    context('between', function() {
        context('abnormal case', function() {
            it('should throw with invalid type', function() {
                expect(function() {
                    $this->containerCollection->between('foo', 'invalid string', 'invalid string');
                })->to->throw('\\Ayaml\\AyamlSeqInvalidTypeException');
            });
        });
    });
});