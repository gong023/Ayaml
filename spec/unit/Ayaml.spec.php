<?php

use Ayaml\Ayaml;

describe('\\Ayaml\\Ayaml', function() {
    context('file', function() {
        context('normal case', function() {
            beforeEach(function() {
                Ayaml::registerBasePath(__DIR__ . '/../SampleYaml');
            });

            it('should return Container class', function() {
                expect(Ayaml::file('user.yml'))->to->instanceof('\\Ayaml\\Container');
            });

            it('should return Container class with adding file extension', function() {
                expect(Ayaml::file('user'))->to->instanceof('\\Ayaml\\Container');
            });

            it('should return Container class with detecting .yaml extension', function() {
                expect(Ayaml::file('a.yaml'))->to->instanceof('\\Ayaml\\Container');
            });
        });

        context('abnormal case', function() {
            it('should throw when base path is not registered', function() {
                expect(function() {
                    Ayaml::registerBasePath(null);
                    Ayaml::file('user');
                })->to->throw('\\Ayaml\\AyamlBasePathNotFoundException');
            });
        });
    });
});
