<?php

use \Ayaml\Fixture\YamlData;

describe('\\Ayaml\\Fixture\\YamlData', function() {
    context('getSchema', function() {
        context('normal case', function() {
            beforeEach(function() {
                $this->yamlData = new YamlData(__DIR__ . '/../../SampleYaml/', 'user.yml');
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
                  new YamlData('invalid path', 'invalid file');
              })->to->throw('\\Ayaml\\Fixture\\AyamlFixtureFileNotFoundException');
            });

            it('should throw when schema not found', function() {
                expect(function() {
                    $yamlData = new YamlData(__DIR__ . '/../../SampleYaml/', 'user.yml');
                    $yamlData->getSchema('no existing schema');
                })->to->throw('\\Ayaml\\Fixture\\AyamlSchemaNotFoundException');
            });
        });
    });
});
