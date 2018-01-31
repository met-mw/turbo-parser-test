<?php
namespace Text\Helper;

class Processor
{
    protected $availableFilters = [
        'stripTags' => true,
        'removeSpaces' => true,
        'replaceSpacesToEol' => true,
        'htmlspecialchars' => true,
        'removeSymbols' => true,
        'toNumber' => true
    ];

    public function stripTags(string $text): string
    {
        return strip_tags($text);
    }

    public function removeSpaces(string $text): string
    {
        return preg_replace('/\s+/', '', $text);
    }

    public function replaceSpacesToEol(string $text): string
    {
        return preg_replace('/\s+/', PHP_EOL, $text);
    }

    public function htmlspecialchars(string $text): string
    {
        return htmlspecialchars($text);
    }

    public function removeSymbols(string $text): string
    {
        return preg_replace('/\[|\.|,|\/|\!|\@|\#|\$|\%|\&|\*|\(|\)|\]/', '', $text);
    }

    /**
     * TODO: Странная функция, т.к. чисел в строке может быть несколько. Следовательно было бы логично отдавать массив чисел
     * TODO: А это значит, что данный метод можно использовать строго последним. Но сейчас реализовано только получкние первого вхождения, в соотвествии с ТЗ
     *
     * @param string $text
     * @return string
     */
    public function toNumber(string $text): string
    {
        $matches = [];
        preg_match_all('/\d+/',$text, $matches);

        return isset($matches[0]) && isset($matches[0][0]) ? $matches[0][0] : $text;
    }

    public function process(string $text, array $filtersMap = []): string
    {
        foreach ($filtersMap as $filter) {
            if (!$this->isFilterAvailable($filter)) {
                continue;
            }

            $text = $this->{$filter}($text);
        }

        return $text;
    }

    protected function isFilterAvailable(string $filter): bool
    {
        return isset($this->availableFilters[$filter]) && method_exists($this, $filter);
    }
}