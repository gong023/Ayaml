<?php

use Ayaml\Fixture\YamlData;
use Ayaml\Container;

describe('\\Ayaml\\Container', function() {
    beforeEach(function() {
        $yamlData = new YamlData(__DIR__ . '/../SampleYaml', 'user');
        $this->subject = new Container($yamlData);
    });

    context('normal case', function() {
        it('should return correct array', function() {
            $actual = $this->subject->schema('valid_user')->dump();
            $expected = [
                'id'      => 1,
                'name'    => 'Taro',
                'created' => '2014-01-01 00:00:00',
            ];

            expect($actual)->to->equal($expected);
        });

        context('calling "with"', function() {
            it('should return overwritten array', function() {
                $actual = $this->subject->schema('valid_user')->with(['name' => 'John'])->dump();
                $expected = [
                    'id'      => 1,
                    'name'    => 'John',
                    'created' => '2014-01-01 00:00:00',
                ];

                expect($actual)->to->equal($expected);
            });
        });
    });

    context('abnormal case', function() {
        it('should throw when you call methods with invalid order', function() {
            expect(function() {
                $this->subject->with(['name' => 'John'])->dump();
            })->to->throw('\\Ayaml\\AyamlSchemaNotSpecifiedException');
        });
    });
});
