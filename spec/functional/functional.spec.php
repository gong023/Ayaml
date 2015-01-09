<?php

use Ayaml\Ayaml;

describe('Ayaml readme spec', function() {
    beforeEach(function() {
        Ayaml::registerBasePath(__DIR__ . '/../SampleYaml');
        $this->container = Ayaml::file('user')->schema('valid_user');
    });

    context('numeric sequence', function() {
        it('increment', function() {
            $actual = Ayaml::seq($this->container)->range('id', 10, 12)->byOne()->dump();

            $expected = [
                ['id' => 10, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
                ['id' => 11, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
                ['id' => 12, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
            ];

            expect($actual)->to->equal($expected);
        });

        it('decrement', function() {
            $actual = Ayaml::seq($this->container)->range('id', 10, 8)->byOne()->dump();

            $expected = [
                ['id' => 10, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
                ['id' => 9, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
                ['id' => 8, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
            ];

            expect($actual)->to->equal($expected);
        });

        it('should be enable you to specify logic', function() {
            $actual = Ayaml::seq($this->container)->range('id', 10, 13)->by(function ($id) { return $id + 2; })->dump();

            $expected = [
                ['id' => 10, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
                ['id' => 12, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
            ];

            expect($actual)->to->equal($expected);
        });
    });

    context('date sequence', function() {
        it('increment', function() {
            $actual = Ayaml::seq($this->container)->between('created', '2014-01', '2014-03')->byMonth()->dump();

            $expected = [
                ['id' => 1, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
                ['id' => 1, 'name' => 'Taro', 'created' => '2014-02-01 00:00:00'],
                ['id' => 1, 'name' => 'Taro', 'created' => '2014-03-01 00:00:00'],
            ];

            expect($actual)->to->equal($expected);
        });

        it('decrement', function() {
            $actual = Ayaml::seq($this->container)->between('created', '2014-01', '2013-11')->byMonth()->dump();

            $expected = [
                ['id' => 1, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
                ['id' => 1, 'name' => 'Taro', 'created' => '2013-12-01 00:00:00'],
                ['id' => 1, 'name' => 'Taro', 'created' => '2013-11-01 00:00:00'],
            ];

            expect($actual)->to->equal($expected);
        });
    });

    context('complex', function() {
        it('changes num and date', function() {
            $actual = Ayaml::seq($this->container)
                ->range('id', 10, 12)->byOne()
                ->between('created', '2014-01', '2014-03')->byMonth()
                ->dump();

            $expected = [
                ['id' => 10, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
                ['id' => 11, 'name' => 'Taro', 'created' => '2014-02-01 00:00:00'],
                ['id' => 12, 'name' => 'Taro', 'created' => '2014-03-01 00:00:00'],
            ];

            expect($actual)->to->equal($expected);
        });
    });
});
