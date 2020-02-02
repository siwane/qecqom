<?php


namespace App\Entity;


class MealByDay implements \JsonSerializable
{
    const NOON = 'Midi';
    const EVENING = 'Soir';

    protected $noon;
    protected $evening;
    /**
     * @var \DateTime
     */
    protected $datetime;

    public function __construct(\DateTime $datetime)
    {
        $this->datetime = $datetime;
    }

    public function jsonSerialize()
    {
        return [
            self::NOON => $this->getNoon(),
            self::EVENING => $this->getEvening(),
        ];
    }

    /**
     * @return Recipe|void
     */
    public function getNoon()
    {
        return $this->noon;
    }

    /**
     * @param Recipe|void $noon
     */
    public function setNoon($noon): MealByDay
    {
        $this->noon = $noon;
        return $this;
    }

    /**
     * @return Recipe|void
     */
    public function getEvening()
    {
        return $this->evening;
    }

    /**
     * @param Recipe|void $evening
     */
    public function setEvening($evening): MealByDay
    {
        $this->evening = $evening;
        return $this;
    }

    public function getDatetime(): \DateTime
    {
        return $this->datetime;
    }

    public function getFormattedDatetime()
    {
//        $day = strtotime('+' . $dayNumber . ' day', $this->startDay->format('U'));
//
//        protected function formatDate($day) : string
//    {
        return $this->datetime->format('d M B');
//        setlocale(LC_TIME, 'fr_FR.utf8','fra');
//        return ucfirst(strftime("%A %d %B", $this));
//        return strftime("%A %d %B %Y", $day);
//    }
    }

}