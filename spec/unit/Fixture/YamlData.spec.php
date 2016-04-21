<?php

use Ayaml\Ayaml;
use \Ayaml\Fixture\YamlData;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

describe('\\Ayaml\\Fixture\\YamlData', function() {
    context('load', function() {
        beforeEach(function() {
            Ayaml::registerBasePath(__DIR__ . '/../../SampleYaml');
            Ayaml::registerBasePath(__DIR__ . '/../../SampleYaml/AnotherPath');
        });
        it('should load multiple paths', function() {
            expect(Ayaml::file('another_path'))->to->be->instanceof('\\Ayaml\\Container');
        });

        afterEach(function() {
            $reflection = new \ReflectionProperty('\\Ayaml\\Ayaml', 'basePaths');
            $reflection->setAccessible(true);
            $reflection->setValue([]);
        });
    });

    context('getSchema', function() {
        context('normal case', function() {
            beforeEach(function() {
                $data = SymfonyYaml::parse(__DIR__ . '/../../SampleYaml/user.yml', true);
                $this->yamlData = new YamlData($data);
            });

            it('should get schema correctly', function() {
                $validUser = $this->yamlData->getSchema('valid_user');
                $expected = [
                    'id'      => 1,
                    'name'    => 'Taro',
                    'created' => '2014-01-01 00:00:00',
                ];

                expect($validUser)->to->equal($expected);
            });

            it('should get nested data', function() {
                $nested = $this->yamlData->getSchema('nested.1.2.3.4.data');
                $expected = [
                    'id'      => 2,
                    'name'    => 'Jiro',
                    'created' => '2014-01-01 00:00:00',
                ];

                expect($nested)->to->equal($expected);
            });
        });

        context('abnormal case', function() {
            it('should throw when file not found', function() {
              expect(function() {
                  YamlData::load(['invalid path'], 'invalid file');
              })->to->throw('\\Ayaml\\Fixture\\AyamlFixtureFileNotFoundException');
            });

            it('should throw when schema not found', function() {
                expect(function() {
                    $data = SymfonyYaml::parse(__DIR__ . '/../../SampleYaml/user.yml', true);
                    $yamlData = new YamlData($data);
                    $yamlData->getSchema('no existing schema');
                })->to->throw('\\Ayaml\\Fixture\\AyamlSchemaNotFoundException');
            });
        });
    });
});
