<?php

declare(strict_types=1);

namespace Aeon\Twig\Tests\Unit;

use Aeon\Calendar\Gregorian\DateTime;
use Aeon\Calendar\Gregorian\Day;
use Aeon\Calendar\Gregorian\GregorianCalendarStub;
use Aeon\Calendar\Gregorian\Interval;
use Aeon\Calendar\Gregorian\TimeZone;
use Aeon\Calendar\TimeUnit;
use Aeon\Twig\CalendarExtension;
use PHPUnit\Framework\TestCase;

final class CalendarExtensionTest extends TestCase
{
    public function test_aeon_now() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $calendar->setNow($now = DateTime::fromString('2002-01-01 00:00:00 UTC'));

        $this->assertEquals($now, $extension->aeon_now());
        $this->assertEquals(TimeZone::europeWarsaw(), $extension->aeon_now(TimeZone::EUROPE_WARSAW)->timeZone());
    }

    public function test_aeon_in_seconds_precise() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertEquals('10.000000', $extension->aeon_in_seconds_precise(TimeUnit::seconds(10)));
    }

    public function test_aeon_interval() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertEquals(Interval::closed(), $extension->aeon_interval('closed'));
    }

    public function test_aeon_in_seconds() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertEquals(10, $extension->aeon_in_seconds(TimeUnit::seconds(10)));
    }

    public function test_aeon_second() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertEquals(TimeUnit::seconds(15), $extension->aeon_second(15));
    }

    public function test_aeon_minute() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertEquals(TimeUnit::minutes(15), $extension->aeon_minute(15));
    }

    public function test_aeon_hour() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertEquals(TimeUnit::hours(15), $extension->aeon_hour(15));
    }

    public function test_aeon_day() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertEquals(TimeUnit::days(15), $extension->aeon_day(15));
    }

    public function test_aeon_date_format() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertSame('2020-01-01 00', $extension->aeon_date_format(DateTime::fromString('2020-01-01 00:00:00 UTC'), 'Y-m-d H'));
    }

    public function test_aeon_day_format() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $this->assertSame('2020 01 01', $extension->aeon_day_format(Day::fromString('2020-01-01'), 'Y m d'));
    }

    public function test_aeon_current_day() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $calendar->setNow($now = DateTime::fromString('2002-01-01 00:00:00 UTC'));

        $this->assertEquals($now->day(), $extension->aeon_current_day());
    }

    public function test_aeon_current_month() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $calendar->setNow($now = DateTime::fromString('2002-01-01 00:00:00 UTC'));

        $this->assertEquals($now->month(), $extension->aeon_current_month());
    }

    public function test_aeon_current_year() : void
    {
        $extension = new CalendarExtension($calendar = new GregorianCalendarStub());

        $calendar->setNow($now = DateTime::fromString('2002-01-01 00:00:00 UTC'));

        $this->assertEquals($now->year(), $extension->aeon_current_year());
    }
}
