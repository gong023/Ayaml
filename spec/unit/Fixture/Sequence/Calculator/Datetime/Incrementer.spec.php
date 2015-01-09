<?php

use Ayaml\Ayaml;

describe('\\Ayaml\\Sequence\\Calculator\\Datetime\\Incrementer', function() {
    beforeEach(function() {
        Ayaml::registerBasePath(__DIR__ . '/../../../../../SampleYaml');
        $container = Ayaml::file('user')->schema('valid_user');
        $this->subject = Ayaml::seq($container);
    });

    context('normal case', function() {
        it('should be specified duration by Day', function() {
            $days = $this->subject->between('created', '2014-01-01 00:00:00', '2014-01-03 00:00:00')->byDay()->getAll();

            expect($days)
                ->to->an('array')
                ->to->length(3);
        });

        it('should be specified duration by Week', function() {
            $weeks = $this->subject->between('created', '2014-01-01 00:00:00', '2014-01-21 00:00:00')->byWeek()->getAll();

            expect($weeks)
                ->to->an('array')
                ->to->length(3);
        });

        it('should be specified duration by Month', function() {
            $months = $this->subject->between('created', '2014-01-01 00:00:00', '2014-03-01 00:00:00')->byMonth()->getAll();

            expect($months)
                ->to->an('array')
                ->to->length(3);
        });

        it('should be specified duration by Year', function() {
            $years = $this->subject->between('created', '2016-01-01 00:00:00', '2014-01-01 00:00:00')->byYear()->getAll();

            expect($years)
                ->to->an('array')
                ->to->length(3);
        });

        it('should be specified date format', function() {
            $days = $this->subject->between('created', '2014-01-01 00:00:00', '2014-01-03 00:00:00')->byDay('Y-m-d')->dump();

            $expected = [
                ['id' => 1, 'name' => 'Taro', 'created' => '2014-01-01'],
                ['id' => 1, 'name' => 'Taro', 'created' => '2014-01-02'],
                ['id' => 1, 'name' => 'Taro', 'created' => '2014-01-03'],
            ];

            expect($days)->to->equal($expected);
        });
    });
});
